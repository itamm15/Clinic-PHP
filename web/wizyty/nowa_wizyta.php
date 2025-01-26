<?php require("wizyty_actions.php"); ?>

<div class="wizyty_content_form">
  <h2>Nowa wizyta</h2>
  <form method="POST" class="wizyta_form">
    <label for="lekarz">Lekarz</label>
    <?php get_lekarze_for_select() ?>

    <?php get_pacjent_details() ?>

    <label for="data_wizyty">Data wizyty</label>
    <input type="datetime-local" name="data_wizyty" required />

    <label for="opis">Opis</label>
    <input type="text" name="opis" required/>
    <button name="create_wizyte" value="create_wizyte">Stwórz wizytę</button>
  </form>
</div>