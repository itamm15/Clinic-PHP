<?php
  require("../../config.php");

  if (isset($_POST["log_out"])) log_out();

  function log_out() {
    stop_session();
    header("Location: ../login/login.php");
  }

  function get_full_name() {
    $name = get_session_property("name");
    $surname = get_session_property("surname");

    return $name ." ". $surname;
  }

  function get_menu_items() {
    $user_type = get_session_property("user_type");

    if ($user_type === "admin") return get_admin_menu_items();
    if ($user_type === "pacjent") return get_pacjent_menu_items();
    if ($user_type === "lekarz") return get_lekarz_menu_items();
  }

  function get_admin_menu_items() {
    return <<<ADMIN_MENU_ITEMS
      <h2>Lekarze</h2>
      <h2>Pacjenci</h2>
      <h2>Wizyty</h2>
      <h2>Mój profil</h2>
    ADMIN_MENU_ITEMS;
  }

  function get_pacjent_menu_items() {
    return <<<PACJENT_MENU_ITEMS
      <h2>Wizyty</h2>
      <h2>Zarejestruj wizytę</h2>
      <h2>Mój profil</h2>
    PACJENT_MENU_ITEMS;
  }

  function get_lekarz_menu_items() {
    return <<<LEKARZ_MENU_ITEMS
      <h2>Pacjenci</h2>
      <h2>Wizyty</h2>
      <h2>Mój profil</h2>
    LEKARZ_MENU_ITEMS;
  }
?>