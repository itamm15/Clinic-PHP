<?php 
  const ADMIN_DATA_FILE = "../../admin_data.txt";
  $is_change_password_action = $_POST["change_admin_password"] ?? '';

  if ($is_change_password_action) {
    change_admin_password($_POST["admin_password"]);
  }

  function render_change_password_form() {
    if (get_session_property("user_type") === "admin") {
      return <<<ADMIN_ZMIEN_HASLO
        <form method="POST">
          <label for="password">Nowe hasło</label>
          <input type="password" name="admin_password" required />
          <button name="change_admin_password" value="change_admin_password" type="submit">Zapisz nowe hasło</button>
        </form>
      ADMIN_ZMIEN_HASLO;
    }
  }

  function change_admin_password($new_password) {
    $admin_data_file = fopen(ADMIN_DATA_FILE, "w") or die("Nie udało się otworzyć pliku!");
    $data_to_write = get_data_to_write($new_password);
    fwrite($admin_data_file, $data_to_write);
    fclose($admin_data_file);
    header("Location: ../index/index.php?page=profil");
    exit();
  }

  function get_data_to_write($new_password) {
    $email = get_session_property("email");
    $name = get_session_property("name");
    $surname = get_session_property("surname");

    return "$email;$new_password;$name;$surname";
  }
?>