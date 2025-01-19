<?php
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $action = $_POST['action'] ?? '';

  if ($action == 'zarejestruj') header('Location: ../register/register.php');
  if ($action == 'zaloguj') zaloguj($email, $password);


  function zaloguj($email, $password) {
    // validate $email/$password
    // handle DB connection
  }
?>