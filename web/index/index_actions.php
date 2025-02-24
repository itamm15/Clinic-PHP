<?php
  require("../../config.php");

  if (isset($_POST["log_out"])) log_out();

  function require_logged_in_user() {
    if (!get_session_property("name")) {
      header("Location: ../login/login.php");
    }
  }

  function log_out() {
    stop_session();
    header("Location: ../login/login.php");
  }

  function get_full_name() {
    $name = get_session_property("name");
    $surname = get_session_property("surname");

    return $name ." ". $surname;
  }

  /*
  Render menu for the given user type. Current views:
  ** Admin
    - lekarze,
    - dodaj lekarza,
    - pacjenci,
    - nowy pacjent,
    - wizyty,
    - nowa wizyta, 
    - moj profil

  ** Lekarz
    - pacjenci,
    - wizyty,
    - moj profil

  ** Pacjent
    - wizyty,
    - zarejestruj wizyte,
    - moj profil
  */
  function get_menu_items() {
    $user_type = get_session_property("user_type");

    if ($user_type === "admin") return get_admin_menu_items();
    if ($user_type === "pacjent") return get_pacjent_menu_items();
    if ($user_type === "lekarz") return get_lekarz_menu_items();
  }

  function get_admin_menu_items() {
    return <<<ADMIN_MENU_ITEMS
      <h2><a href="?page=lekarze">Lekarze</a></h2>
      <h2><a href="?page=nowy_lekarz">Dodaj lekarza</a></h2>
      <h2><a href="?page=pacjenci">Pacjenci</a></h2>
      <h2><a href="?page=nowy_pacjent">Nowy pacjent</a></h2>
      <h2><a href="?page=wizyty">Wizyty</a></h2>
      <h2><a href="?page=nowa_wizyta">Nowa wizyta</a></h2>
      <h2><a href="?page=profil">Mój profil</a></h2>
      <h2><a href="?page=autor">Autor</a></h2>
    ADMIN_MENU_ITEMS;
  }

  function get_pacjent_menu_items() {
    return <<<PACJENT_MENU_ITEMS
      <h2><a href="?page=wizyty">Wizyty</a></h2>
      <h2><a href="?page=nowa_wizyta">Zarejestruj wizytę</a></h2>
      <h2><a href="?page=profil">Mój profil</a></h2>
      <h2><a href="?page=autor">Autor</a></h2>
    PACJENT_MENU_ITEMS;
  }

  function get_lekarz_menu_items() {
    return <<<LEKARZ_MENU_ITEMS
      <h2><a href="?page=pacjenci">Pacjenci</a></h2>
      <h2><a href="?page=wizyty">Wizyty</a></h2>
      <h2><a href="?page=profil">Mój profil</a></h2>
      <h2><a href="?page=autor">Autor</a></h2>
    LEKARZ_MENU_ITEMS;
  }

  /*
  Renders content within layout based on the `page` param in URL.
  If the `page` param is either invalid or not passed renders text to select item from menu.
  
  Layout view:
  __________________________________________________
  |        |          current_user_info    logout_b
  |  MENU  |________________________________________
  |        |
  |        |
  |        |
  |        |
  |        |          CONTENT FROM PARAMS
  |        |
  |        |           
  |        |
  |        |
  |        |

  Thanks to this approach, we have the same layout on each sub-page.
  (This makes `index.php` a root file when user is logged in :))
  */
  function render_content_from_params() {
    $page = $_GET["page"] ?? '';

    if ($page === "wizyty") return require("../wizyty/wizyty.php");
    if ($page === "nowa_wizyta") return require("../wizyty/nowa_wizyta.php");
    if ($page === "odwolaj_wizyte") return require("../wizyty/odwolaj_wizyte.php");
    if ($page === "edit_wizyte") return require("../wizyty/edit_wizyte.php");
    if ($page === "lekarze") return require("../lekarze/lekarze.php");
    if ($page === "nowy_lekarz") return require("../lekarze/nowy_lekarz.php");
    if ($page === "edit_lekarz") return require("../lekarze/edit_lekarz.php");
    if ($page === "pacjenci") return require("../pacjenci/pacjenci.php");
    if ($page === "nowy_pacjent") return require("../pacjenci/nowy_pacjent.php");
    if ($page === "edit_pacjent") return require("../pacjenci/edit_pacjent.php");
    if ($page === "profil") return require("../profil/profil.php");
    if ($page === "autor") return require("../autor/autor.php");
    
    echo <<<INDEX_PAGE
      <h1>Wybierz pozycje z menu do przekierowania.</h1>
    INDEX_PAGE;
  }
?>