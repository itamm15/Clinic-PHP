<?php
  require_once("../../config.php");
  require_once("../../shared_validations/valdiate_user.php");

  $errors = array();

  $name = $_POST["name"] ?? '';
  $surname = $_POST["surname"] ?? "";
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $action = $_POST['action'] ?? '';

  if ($action == 'zaloguj') header('Location: ../login/login.php');
  if ($action == 'zarejestruj') register($errors, $name, $surname, $email, $password);

  function register(&$errors, $name, $surname, $email, $password) {
    $conn = get_conn();
    validate_user($errors, $conn, $name, $surname, $email, $password);

    if (count($errors) === 0) {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO pacjenci (imie, nazwisko, email, haslo) 
                VALUES ('$name', '$surname', '$email', '$hashed_password');";

      if(mysqli_query($conn, $query)) {
        $user_id = mysqli_insert_id($conn);
        close_conn($conn);
        start_session($name, $surname, $email, $user_id, "pacjent");
        header('Location: ../index/index.php');
      } else {
        echo "Cos poszlo nie tak!".mysqli_error( $conn);
        close_conn($conn);
      }
    } 
  }

  function show_errors() {
    global $errors;
    if (count($errors) > 0) {
      echo '<div class="registration_errors">Ups! Coś poszło nie tak.';
      foreach ($errors as $error ) {
        echo '<p>'.$error.'</p>';
      }
      echo '</div>';
    }
  }
?>