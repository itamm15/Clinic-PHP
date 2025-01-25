<?php

  $is_odwolaj_action = $_POST["odwolaj"] ?? '';
  $is_edit_action = $_POST["edit"] ?? '';
  $is_odwolaj_wizyte_action = $_POST["odwolaj_wizyte"] ?? '';
  $is_edit_wizyte_action = $_POST["edytuj_wizyte"] ?? '';
  $is_create_wizyte_action = $_POST["create_wizyte"] ?? '';

  if ($is_odwolaj_action) {
    header("Location: ../index/index.php?page=odwolaj_wizyte&wizyta_id=$is_odwolaj_action");
    exit();
  }

  if ($is_odwolaj_wizyte_action) {
    $wizyta_id = $_GET["wizyta_id"];
    $powod_odwolania = $_POST["powod_odwolania"];
    odwolaj_wizyte($wizyta_id, $powod_odwolania);
  }

  if ($is_edit_action) {
    header("Location: ../index/index.php?page=edit_wizyte&wizyta_id=$is_edit_action");
    exit();
  }

  if ($is_edit_wizyte_action) {
    $wizyta_id = $_GET["wizyta_id"];
    $lekarz_id = $_POST["lekarz"];
    $pacjent_id = $_POST["pacjent"];
    $opis = $_POST["opis"];
    edit_wizyta($wizyta_id, $lekarz_id, $pacjent_id, $opis);
  }

  if ($is_create_wizyte_action) {
    $lekarz_id = $_POST["lekarz"];
    $pacjent_id = $_POST["pacjent"];
    $opis = $_POST["opis"];
    $data_wizyty = $_POST["data_wizyty"];
    create_wizyta($lekarz_id, $pacjent_id, $opis, $data_wizyty);
  }


  function get_wizyty() {
    $conn = get_conn();
    $query = "SELECT 
                wizyty.*, 
                lekarze.imie AS lekarz_imie, lekarze.nazwisko AS lekarz_nazwisko,
                pacjenci.imie AS pacjent_imie, pacjenci.nazwisko AS pacjent_nazwisko
              FROM wizyty 
              INNER JOIN lekarze ON wizyty.lekarz_id = lekarze.id
              INNER JOIN pacjenci ON wizyty.pacjent_id = pacjenci.id";

    if (get_session_property('user_type') === 'lekarz') {
      $lekarz_id = get_session_property('user_id');
      $filter_by_lekarz_query = " WHERE lekarze.id = $lekarz_id";

      $query .= $filter_by_lekarz_query;
    }

    if (get_session_property('user_type') === 'pacjent') {
      $pacjent_id = get_session_property('user_id');
      $filter_by_pacjent_query = " WHERE pacjenci.id = $pacjent_id";

      $query .= $filter_by_pacjent_query;
    }

    $result = mysqli_query($conn, $query);

    while ($wizyta = mysqli_fetch_assoc($result)) {
      $powod_odwolania = format_powod_odwolania($wizyta['powod_odwolania']);
      $odwolaj_button = '';
      if ($powod_odwolania === 'Nie') $odwolaj_button = "<button type='submit' name='odwolaj' value='$wizyta[id]'>Odwołaj</button>";
      echo <<<WYPISZ_WIZYTY
        <tr data-wizyta-dane="$wizyta[opis]">
          <td>$wizyta[id]</td>
          <td>$wizyta[lekarz_imie] $wizyta[lekarz_nazwisko]</td>
          <td>$wizyta[pacjent_imie] $wizyta[pacjent_nazwisko]</td>
          <td>$wizyta[data_wizyty]</td>
          <td>$wizyta[opis]</td>
          <td>$powod_odwolania</td>
          <td>
            <form method="POST">
              $odwolaj_button
              <button type="submit" name="edit" value="$wizyta[id]">Edytuj</button>
            </form>
          </td>
        </tr>
      WYPISZ_WIZYTY;
    }

    close_conn($conn);
  }

  function format_powod_odwolania($powod_odwolania) {
    if(empty($powod_odwolania)) return "Nie";
    return "Tak, powód: ".$powod_odwolania;
  }

  function get_wizyta($wizyta_id) {
    $conn = get_conn();
    $query = "SELECT * FROM wizyty WHERE id = $wizyta_id";
    $result = mysqli_query($conn, $query);
    close_conn($conn);

    return mysqli_fetch_assoc($result);
  }

  function get_lekarze_for_select() {
    $conn = get_conn();
    $query = "SELECT * FROM lekarze";
    $result = mysqli_query($conn, $query);
    close_conn($conn);

    echo "<select name='lekarz' id='lekarz'>";
    while($lekarz = mysqli_fetch_assoc($result)) {
      echo "<option value='$lekarz[id]'>$lekarz[imie] $lekarz[nazwisko]</option>";
    }
    echo "</select>";
  }

  function get_pacjenci_for_select() {
    $conn = get_conn();
    $query = "SELECT * FROM pacjenci";
    $result = mysqli_query($conn, $query);
    close_conn($conn);

    echo "<select name='pacjent' id='pacjent'>";
    while($pacjent = mysqli_fetch_assoc($result)) {
      echo "<option value='$pacjent[id]'>$pacjent[imie] $pacjent[nazwisko]</option>";
    }
    echo "</select>";
  }

  function odwolaj_wizyte($wizyta_id, $powod_odwolania) {
    $conn = get_conn();
    $query = "UPDATE wizyty 
              SET powod_odwolania = '$powod_odwolania'
              WHERE id = $wizyta_id";

    if (mysqli_query($conn, $query)) {
      close_conn($conn);
      header('Location: ../index/index.php?page=wizyt');
      exit();
    } else {
      echo "Nie udało się dodać odwołania wizyty!".mysqli_error($conn);
      close_conn($conn);
    }
  }

  function edit_wizyta($wizyta_id, $lekarz_id, $pacjent_id, $opis) {
    $conn = get_conn();
    $query = "UPDATE wizyty SET
              lekarz_id = $lekarz_id,
              pacjent_id = $pacjent_id,
              opis = '$opis'
              WHERE id = $wizyta_id";

    if (mysqli_query($conn, $query)) {
      close_conn($conn);
      header("Location: ../index/index.php?page=wizyty");
      exit();
    } else {
      echo "Nie udało się zaktualizować wizyty, zobacz błędy!".mysqli_error($conn);
      close_conn($conn);
    }
  }

  function create_wizyta($lekarz_id, $pacjent_id, $opis, $data_wizyty) {
    $conn = get_conn();
    $query = "INSERT INTO wizyty (lekarz_id, pacjent_id, opis, data_wizyty, powod_odwolania) VALUES
              ($lekarz_id, $pacjent_id, '$opis', '$data_wizyty', '');";

    if (mysqli_query($conn, $query)) {
      close_conn($conn);
      header("Location: ../index/index.php?page=wizyty");
      exit();
    } else {
      echo "Nie udało się utworzyć wizyty!".mysqli_error($conn);
      close_conn($conn);
    }
  }
?>