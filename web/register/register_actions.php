<?php
  require_once("../../config.php");

  const PRZYCHODNIA_DOMAIN = "przychodnia.com";
  $errors = array();

  $name = $_POST["name"] ?? '';
  $surname = $_POST["surname"] ?? "";
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $action = $_POST['action'] ?? '';

  if ($action == 'zaloguj') header('Location: ../login/login.php');
  if ($action == 'zarejestruj') register($errors, $name, $surname, $email, $password);

  function register(&$errors, $name, $surname, $email, $password) {
    validate_attrs($errors, $name, $surname, $email, $password);

    if (count($errors) === 0) {
      $conn = get_conn();
      // TODO: hash_password
      $query = "INSERT INTO pacjenci (imie, nazwisko, email, haslo) 
                VALUES ('$name', '$surname', '$email', '$password');";
  
      if(mysqli_query($conn, $query)) {
        echo "Uzytkownik dodany do bazy";
        // TODO: dodaj przekierowanie do index pagea
        // tymczasowe
        header('Location: ./register.php');
      } else {
        echo "Cos poszlo nie tak!".mysqli_error( $conn);
      }
  
      close_conn($conn);
    } 
  }

  function validate_attrs(&$errors, $name, $surname, $email, $password) {
    if (!is_name_valid($name)) array_push($errors, "Imie nie moze byc puste.");
    if (!is_name_valid($surname)) array_push($errors, "Nazwisko nie moze byc puste");
    if (!is_email_valid($email)) array_push($errors, "Niepoprawny adres email.");
    if (!is_password_valid($password)) array_push($errors, "Niepoprawne hasło. Powinno składać się z min 5 znaków.");

    return $errors;
  }

  function is_name_valid($value) {
    return strlen($value) > 0;
  }

  function is_email_valid($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) && explode('@', $email)[1] !== PRZYCHODNIA_DOMAIN;
  }

  function is_password_valid($password) {
    return strlen($password) >= 5;
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