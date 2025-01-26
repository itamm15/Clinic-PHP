<?php
  require_once("../../config.php");

  const ADMIN_EMAIL = "admin@przychodnia.com";
  const PRZYCHODNIA_DOMAIN = "przychodnia.com";
  const ADMIN_DATA_FILE = "../../admin_data.txt";

  $errors = array();
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $action = $_POST['action'] ?? '';

  if ($action == 'zarejestruj') header('Location: ../register/register.php');
  if ($action == 'zaloguj') zaloguj($errors, $email, $password);

  function zaloguj(&$errors, $email, $password) {
    validate_attrs($errors, $email, $password);
    if (count($errors) === 0) {
      if ($email == ADMIN_EMAIL) {
        login_admin($password);
      }

      if (explode('@', $email)[1] == PRZYCHODNIA_DOMAIN) {
        login_lekarz($email, $password);
      } 

      login_user($email, $password);
    }
  }

  function login_admin($password) {
    $admin_data_file = fopen(ADMIN_DATA_FILE, "r") or die("Nie udalo sie otworzyc pliku");
    $admin_data = explode(";", fgets($admin_data_file));
    
    if ($password === $admin_data[1]) {
      fclose($admin_data_file);
      start_session($admin_data[2], $admin_data[3], ADMIN_EMAIL, -1, "admin");
      header("Location: ../index/index.php");
      exit;
    } else {
      global $errors;
      fclose($admin_data_file);
      array_push($errors, "Coś poszło nie tak przy logowaniu jako admin - problem z hasłem");
    }
  }

  function login_lekarz($email, $password) {
    $conn = get_conn();
    $lekarz_query = "SELECT * FROM lekarze WHERE email = '$email'";
    $result = mysqli_query($conn, $lekarz_query);

    if (mysqli_num_rows($result) === 1) {
      $lekarz = mysqli_fetch_assoc($result);
      close_conn($conn);

      if (password_verify($password, $lekarz["haslo"])) {
        start_session($lekarz['imie'], $lekarz['nazwisko'], $email, $lekarz['id'], "lekarz");
        header("Location: ../index/index.php");
        exit;
      } else {
        global $errors;
        array_push($errors, "Niepoprawne hasło lekarza!");
      }
    } else {
      global $errors;
      close_conn($conn);
      array_push($errors, "Nieznany lekarz! Spróbuj z innym mailem lub skontaktuj się z kliniką.");
    }
  }
  function login_user($email, $password) {
    $conn = get_conn();
    $user_query = "SELECT * FROM pacjenci WHERE email = '$email';";
    $user_result = mysqli_query($conn, $user_query);

    if(mysqli_num_rows($user_result) === 1) {
      $user = mysqli_fetch_assoc($user_result);
      close_conn($conn);

      if(password_verify($password, $user["haslo"])) {
        start_session($user["imie"], $user["nazwisko"], $email, $user['id'], "pacjent");
        header("Location: ../index/index.php");
        exit;
      } else {
        global $errors;
        array_push($errors, "Niepoprawne hasło pacjenta!");
      }
    } else {
      global $errors;
      close_conn($conn);
      array_push($errors, "Nieznany pacjent! Spróbuj z innym mailem lub skontaktuj się z kliniką.");
    }
  }

  function validate_attrs(&$errors, $email, $password) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) array_push($errors, "Niepoprawny email!");
    if (strlen($password) === 0) array_push($errors, "Hasło nie może być puste!");

    return $errors;
  }

  function show_errors() {
    global $errors;
    if (count($errors) !== 0) {
      echo '<div class="login_errors">Ups! Coś poszło nie tak.';
        foreach ($errors as $error ) {
          echo '<p>'.$error.'</p>';
        }
      echo '</div>';
    }
  }
?>