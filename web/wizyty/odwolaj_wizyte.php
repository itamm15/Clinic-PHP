<?php require("wizyty_actions.php"); ?>

<?php $wizyta = get_wizyta($_GET["wizyta_id"]) ?>

<div class="wizyty_content_form">
  <h2>Odwołaj wizytę</h2>
  <form method="POST" class="wizyta_form">
    <label for="powod_odwolania">Powód odwołania</label>
    <input type="text" name="powod_odwolania" required/>
    <button name="odwolaj_wizyte" value="odwolaj_wizyte">Odwolaj</button>
  </form>
</div>