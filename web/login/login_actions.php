<?php
  require_once("../../config.php");

  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $action = $_POST['action'] ?? '';

  if ($action == 'zarejestruj') header('Location: ../register/register.php');
  if ($action == 'zaloguj') zaloguj($email, $password);

  function zaloguj($email, $password) {
    $conn = get_conn();
    $user_query = "SELECT * FROM pacjenci WHERE email = '$email';";
    $user_result = mysqli_query($conn, $user_query);

    if(mysqli_num_rows($user_result) === 1) {
      $user = mysqli_fetch_assoc($user_result);

      if(password_verify($password, $user["haslo"])) {
        start_session($user["imie"], $user["nazwisko"], $email);
        header("Location: ../index/index.php");
        exit;
      }
    }

    // TODO: wpp dodaj errory
  }
?>