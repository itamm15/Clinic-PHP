<?php
  // TODO: create consts file
  const PRZYCHODNIA_DOMAIN = "przychodnia.com";

  $lekarz_id_to_edit = $_POST['edit'] ?? '';
  $lekarz_id_to_delete = $_POST['delete'] ?? '';
  $is_create_lekarz_action = $_POST["create"] ?? '';

  if ($is_create_lekarz_action) {
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $email = $_POST["email"];
    $haslo = $_POST["haslo"];
    create_lekarz( $imie, $nazwisko, $email, $haslo);
  }

  if ($lekarz_id_to_edit) {
    // utworz edit pagea
  }

  if ($lekarz_id_to_delete) {
    $conn = get_conn();
    $query = "DELETE FROM lekarze WHERE id = $lekarz_id_to_delete";

    if (mysqli_query($conn, $query)) {
      close_conn($conn);
      header("Location: ../index/index.php?page=lekarze");
    } else {
      echo "Nie udało się usunąć lekarza!";
      close_conn($conn);
    }
  }

  function get_lekarze() {
    $conn = get_conn();
    $query = "SELECT * FROM lekarze;";
    $result = mysqli_query($conn, $query);

    while ($lekarz = mysqli_fetch_row($result)) {
      echo <<<WYPISZ_LEKARZA
        <tr>
          <td>$lekarz[0]</td>
          <td>$lekarz[1]</td>
          <td>$lekarz[2]</td>
          <td>$lekarz[3]</td>
          <td>
            <form method="POST">
              <button type="submit" name="delete" value="$lekarz[0]">Usuń</button>
              <button type="submit" name="edit" value="$lekarz[0]">Edytuj</button>
            </form>
          </td>
        </tr>
      WYPISZ_LEKARZA;
    }

    close_conn($conn);
  }

  function create_lekarz($imie, $nazwisko, $email, $haslo){
    $conn = get_conn();
    $lekarz_form_errors = array();
    validate_attrs($lekarz_form_errors, $conn, $imie, $nazwisko, $email, $haslo);

    // DODAJ PRZENIESIENIE
    if (count($lekarz_form_errors) > 0) {
      close_conn($conn);
      show_lekarz_form_errors($lekarz_form_errors);
    } else {
      $hashed_password = password_hash($haslo, PASSWORD_DEFAULT);
      $query = "INSERT INTO lekarze (imie, nazwisko, email, haslo)
                VALUES ('$imie', '$nazwisko', '$email', '$hashed_password');";

      if(mysqli_query($conn, $query)) {
        close_conn($conn);
        header("Location: ../index/index.php?page=lekarze");
      } else {
        close_conn($conn);
        echo "Nie udało się utworzyć lekarza!".mysqli_error($conn);
      }
    }
  }

  function validate_attrs(&$lekarz_form_errors, $conn, $name, $surname, $email, $password) {
    if (!is_name_valid($name)) array_push($lekarz_form_errors, "Imie nie moze byc puste.");
    if (!is_name_valid($surname)) array_push($lekarz_form_errors, "Nazwisko nie moze byc puste");
    if (!is_password_valid($password)) array_push($lekarz_form_errors, "Niepoprawne hasło. Powinno składać się z min 5 znaków.");
    validate_email($lekarz_form_errors, $email, $conn);

    return $lekarz_form_errors;
  }

  function is_name_valid($value) {
    return strlen($value) > 0;
  }

  function validate_email(&$lekarz_form_errors, $email, $conn) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return array_push($lekarz_form_errors, "Niepoprawny adres email");
    }

    $query = "SELECT * FROM lekarze WHERE email LIKE '$email';";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      return array_push($lekarz_form_errors, "Użytkownik z takim mailem już istnieje.");
    }

    if (explode('@', $email)[1] !== PRZYCHODNIA_DOMAIN) {
      return array_push($lekarz_form_errors, "Adres email lekarza powinnien kończyć się na ".PRZYCHODNIA_DOMAIN);
    }

    return $lekarz_form_errors;    
  }

  function is_password_valid($password) {
    return strlen($password) >= 5;
  }

  function show_lekarz_form_errors($lekarz_form_errors) {
    if (count($lekarz_form_errors) > 0) {
      echo '<div class="lekarz_form_errors">Ups! Coś poszło nie tak.';
      foreach ($lekarz_form_errors as $error ) {
        echo '<p>'.$error.'</p>';
      }
      echo '</div>';
    }
  }
?>