<?php require("wizyty_actions.php"); ?>

<?php $wizyta = get_wizyta($_GET["wizyta_id"]); ?>

<div class="wizyty_content_form">
  <h2>Edytuj wizytę</h2>
  <form method="POST" class="wizyta_form">
    <label for="lekarz">Lekarz</label>
    <?php get_lekarze_for_select() ?>

    <?php get_pacjent_details() ?>

    <label for="opis">Opis</label>
    <input type="text" name="opis" value='<?php echo $wizyta['opis'] ?>' required/>
    <button name="edytuj_wizyte" value="edytuj_wizyte">Edytuj</button>
  </form>
</div>