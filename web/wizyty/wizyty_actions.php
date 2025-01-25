<?php

  $is_odwolaj_action = $_POST["odwolaj"] ?? '';
  $is_odwolaj_wizyte_action = $_POST["odwolaj_wizyte"] ?? '';

  if ($is_odwolaj_action) {
    header("Location: ../index/index.php?page=odwolaj_wizyte&wizyta_id=$is_odwolaj_action");
    exit();
  }

  if ($is_odwolaj_wizyte_action) {
    $wizyta_id = $_GET["wizyta_id"];
    $powod_odwolania = $_POST["powod_odwolania"];
    odwolaj_wizyte($wizyta_id, $powod_odwolania);
  }

  function get_wizyty() {
    $conn = get_conn();
    $query = "SELECT 
                wizyty.*, 
                lekarze.imie AS lekarz_imie, lekarze.nazwisko AS lekarz_nazwisko,
                pacjenci.imie AS pacjent_imie, pacjenci.nazwisko AS pacjent_nazwisko
              FROM wizyty 
              INNER JOIN lekarze ON wizyty.lekarz_id = lekarze.id
              INNER JOIN pacjenci ON wizyty.pacjent_id = pacjenci.id;";

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
?>