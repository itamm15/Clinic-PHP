<?php
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $action = $_POST['action'] ?? '';

  if ($action == 'zaloguj') header('Location: ../login/login.php');
  if ($action == 'zarejestruj') register($email, $password);


  function register($email, $password) {
    // validate $email/$password
    // handle DB connection
  }
?>