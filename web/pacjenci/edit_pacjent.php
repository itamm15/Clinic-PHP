<?php require("pacjenci_actions.php"); ?>

<?php $pacjenct = get_pacjent($_GET["pacjent_id"]) ?>

<div class="pacjenci_content_form">
  <h2>Edytuj pacjenta</h2>
  <form method="POST" class="pacjent_form">
    <label for="imie">Imię</label>
    <input type="text" name="imie" value="<?php echo $pacjenct['imie'] ?>" required />

    <label for="nazwisko">Nazwisko</label>
    <input type="text" name="nazwisko" value="<?php echo $pacjenct['nazwisko'] ?>" required />

    <button name="edit_pacjent" value="edit_pacjent">Edytuj</button>
  </form>
</div>