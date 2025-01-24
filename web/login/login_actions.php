<?php
  require_once("../../config.php");

  const ADMIN_EMAIL = "admin@przychodnia.com";
  const ADMIN_DATA_FILE = "../../admin_data.txt";

  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $action = $_POST['action'] ?? '';

  if ($action == 'zarejestruj') header('Location: ../register/register.php');
  if ($action == 'zaloguj' && $email == ADMIN_EMAIL) login_admin($password);
  if ($action == 'zaloguj') login_user($email, $password);

  function login_admin($password) {
    $admin_data_file = fopen(ADMIN_DATA_FILE, "r") or die("Nie udalo sie otworzyc pliku");
    $admin_data = explode(";", fgets($admin_data_file));
    
    if ($password === $admin_data[1]) {
      start_session($admin_data[2], $admin_data[3], ADMIN_EMAIL, "admin");
      header("Location: ../index/index.php");
      exit;
    } 

    // TODO:: wpp dodaj errory
    fclose($admin_data_file);
  }

  function login_user($email, $password) {
    $conn = get_conn();
    $user_query = "SELECT * FROM pacjenci WHERE email = '$email';";
    $user_result = mysqli_query($conn, $user_query);

    if(mysqli_num_rows($user_result) === 1) {
      $user = mysqli_fetch_assoc($user_result);

      if(password_verify($password, $user["haslo"])) {
        start_session($user["imie"], $user["nazwisko"], $email, "pacjent");
        header("Location: ../index/index.php");
        exit;
      }
    }

    // TODO: wpp dodaj errory
    close_conn($conn);
  }
?>