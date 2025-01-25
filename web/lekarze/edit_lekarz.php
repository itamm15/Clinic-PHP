<?php require("lekarze_actions.php"); ?>

<?php $lekarz = get_lekarz($_GET["lekarz_id"]) ?>

<div class="lekarze_content_form">
  <h2>Edytuj lekarza</h2>
  <form method="POST" class="lekarz_form">
    <label for="imie">Imię</label>
    <input type="text" name="imie" value="<?php echo $lekarz['imie'] ?>" required />

    <label for="nazwisko">Nazwisko</label>
    <input type="text" name="nazwisko" value="<?php echo $lekarz['nazwisko'] ?>" required />

    <button name="edit_lekarz" value="edit_lekarz">Edytuj</button>
  </form>
</div>