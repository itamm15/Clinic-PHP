<?php require("lekarze_actions.php"); ?>

<div class="lekarze_content_form">
  <h2>Nowy lekarz</h2>
  <form method="POST" class="lekarz_form">
    <label for="imie">Imię</label>
    <input type="text" name="imie" value="<?php echo $_POST['imie'] ?? '' ?>" required />

    <label for="nazwisko">Nazwisko</label>
    <input type="text" name="nazwisko" value="<?php echo $_POST['nazwisko'] ?? '' ?>" required />

    <label for="email">email</label>
    <input type="text" name="email" value="<?php echo $_POST['email'] ?? '' ?>" required />

    <label for="haslo">Hasło</label>
    <input type="password" name="haslo" required />

    <button name="create" value="create">Stwórz</button>
  </form>
</div>