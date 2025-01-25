<?php require('index_actions.php') ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Przychodnia</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="../lekarze/lekarze.css">
    <link rel="stylesheet" href="../pacjenci/pacjenci.css">
    <link rel="stylesheet" href="../wizyty/wizyta.css">
    <script src="../../js/searcher.js"></script>
  </head>
  <body>
    <div class="index_page">
      <!-- MENU -->
      <div class="index_menu">
        <h1>Przychodnia</h1>
        <div class="index_menu__items">
          <?php echo get_menu_items() ?>
        </div>
      </div>
      <!-- CONTENT -->
      <div class="index_content">
        <div class="index_logout">
          <span class="index_fullname"><?php echo get_full_name(); ?></span>
          <form method="POST" action="index_actions.php">
            <button type="submit" name="log_out">Wyloguj</button>
          </form>
        </div> 
        <div>
          <?php render_content_from_params() ?>
        </div>
      </div>
    </div>
  </body>
</html>