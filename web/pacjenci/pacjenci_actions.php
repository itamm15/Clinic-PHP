<?php
  require_once("../../shared_validations/valdiate_user.php");

  $pacjent_id_to_edit = $_POST["edit"] ?? '';
  $pacjent_id_to_delete = $_POST['delete'] ?? '';
  $is_edit_pacjent_action = $_POST["edit_pacjent"] ??'';
  $is_create_pacjent_action = $_POST["create"] ?? '';

  if ($pacjent_id_to_delete) delete_pacjent($pacjent_id_to_delete);

  if ($pacjent_id_to_edit) {
    header("Location: ../index/index.php?page=edit_pacjent&pacjent_id=$pacjent_id_to_edit");
    exit;
  }

  if ($is_edit_pacjent_action) {
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $pacjent_id = $_GET["pacjent_id"];
    edit_pacjent($imie, $nazwisko,  $pacjent_id);
  }

  if ($is_create_pacjent_action) {
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $email = $_POST["email"];
    $haslo = $_POST["haslo"];
    create_pacjent( $imie, $nazwisko, $email, $haslo);
  }

  function get_pacjent($pacjent_id) {
    $conn = get_conn();
    $query = "SELECT imie, nazwisko FROM pacjenci WHERE id = $pacjent_id";
    $result = mysqli_query($conn, $query);
    close_conn($conn);

    return mysqli_fetch_assoc( $result );
  }

  function get_pacjenci() {
    $conn = get_conn();
    $query = "SELECT * FROM pacjenci";
    $result = mysqli_query($conn, $query);

    while ($pacjent = mysqli_fetch_row($result)) {
      echo <<<WYPISZ_PACJENTA
        <tr data-pacjent-dane="$pacjent[0] $pacjent[1]">
          <td>$pacjent[0]</td>
          <td>$pacjent[1]</td>
          <td>$pacjent[2]</td>
          <td>$pacjent[3]</td>
          <td>
            <form method="POST">
              <button type="submit" name="delete" value="$pacjent[0]">Usuń</button>
              <button type="submit" name="edit" value="$pacjent[0]">Edytuj</button>
            </form>
          </td>
        </tr>  
      WYPISZ_PACJENTA;
    }

    close_conn($conn);
  }

  function delete_pacjent($pacjent_id_to_delete) {
    $conn = get_conn();
    $query = "DELETE FROM pacjenci WHERE id = $pacjent_id_to_delete";

    if (mysqli_query( $conn, $query)) {
      close_conn($conn);
      header("Location: ../index/index.php?page=pacjenci");
      exit();
    } else {
      close_conn($conn);
      echo "Nie udało się usunąć pacjenta!";
    }
  }

  function edit_pacjent($imie, $nazwisko, $pacjent_id) {
    $conn = get_conn();
    $query = "UPDATE pacjenci SET 
              imie = '$imie',
              nazwisko = '$nazwisko'
              WHERE id = $pacjent_id;";

    if (mysqli_query( $conn, $query)) {
      close_conn($conn);
      header("Location: ../index/index.php?page=pacjenci");
      exit();
    } else {
      echo "Nie udało się zedytować pacjenta!".mysqli_error($conn);
      close_conn($conn);
    }
  }

  function create_pacjent($imie, $nazwisko, $email, $haslo) {
    $conn = get_conn(); 
    $errors = array();
    validate_user($errors, $conn, $imie, $nazwisko, $email, $haslo);

    if (count($errors) === 0) {
      $hashed_password = password_hash($haslo, PASSWORD_DEFAULT);
      $query = "INSERT INTO pacjenci (imie, nazwisko, email, haslo) 
                VALUES ('$imie', '$nazwisko', '$email', '$hashed_password');";
  
      if(mysqli_query($conn, $query)) {
        close_conn($conn);
        header('Location: ../index/index.php?page=pacjenci');
        exit();
      } else {
        echo "Cos poszlo nie tak!".mysqli_error( $conn);
      }
    } else {
      close_conn($conn);
      show_pacjent_form_errors($errors);
    }
  }

  function show_pacjent_form_errors($errors) {
    if (count($errors) > 0) {
      echo '<div class="pacjent_form_errors">Ups! Coś poszło nie tak.';
      foreach ($errors as $error ) {
        echo '<p>'.$error.'</p>';
      }
      echo '</div>';
    }
  }
?>