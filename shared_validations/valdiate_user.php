<?php
  const PRZYCHODNIA_DOMAIN = "przychodnia.com";
  function validate_user(&$errors, $conn, $name, $surname, $email, $password) {
    if (!is_name_valid($name)) array_push($errors, "Imie nie moze byc puste.");
    if (!is_name_valid($surname)) array_push($errors, "Nazwisko nie moze byc puste");
    if (!is_email_valid($email, $conn)) array_push($errors, "Niepoprawny adres email.");
    if (!is_password_valid($password)) array_push($errors, "Niepoprawne hasło. Powinno składać się z min 5 znaków.");

    return $errors;
  }

  function is_name_valid($value) {
    return strlen($value) > 0;
  }

  // TODO: rozbij na 3 mniejsze
  function is_email_valid($email, $conn) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $query = "SELECT * FROM pacjenci WHERE email LIKE '$email';";
      $result = mysqli_query($conn, $query);

      return mysqli_num_rows($result) === 0 && explode('@', $email)[1] !== PRZYCHODNIA_DOMAIN;
    }
    return false;
  }

  function is_password_valid($password) {
    return strlen($password) >= 5;
  }
?>