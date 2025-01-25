<?php
  require_once("../../config.php");

  const ADMIN_EMAIL = "admin@przychodnia.com";
  const PRZYCHODNIA_DOMAIN = "przychodnia.com";
  const ADMIN_DATA_FILE = "../../admin_data.txt";

  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $action = $_POST['action'] ?? '';

  if ($action == 'zarejestruj') header('Location: ../register/register.php');
  if ($action == 'zaloguj' && $email == ADMIN_EMAIL) login_admin($password);
  if ($action == 'zaloguj' && explode('@', $email)[1] == PRZYCHODNIA_DOMAIN) login_lekarz($email, $password);
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

  function login_lekarz($email, $password) {
    $conn = get_conn();
    $lekarz_query = "SELECT * FROM lekarze WHERE email = '$email'";
    $result = mysqli_query($conn, $lekarz_query);

    if (mysqli_num_rows($result) === 1) {
      $lekarz = mysqli_fetch_assoc($result);

      if (password_verify($password, $lekarz["haslo"])) {
        start_session($lekarz['imie'], $lekarz['nazwisko'], $email, "lekarz");
        header("Location: ../index/index.php");
        exit;
      }
    }

    // TODO: wpp dodaj errory
    close_conn($conn);
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