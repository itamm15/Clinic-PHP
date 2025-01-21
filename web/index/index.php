<?php require('index_actions.php') ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Przychodnia</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="index.css"?
  </head>
  <body>
    <div class="index_page">
      <!-- MENU -->
      <div class="index_menu">
        <h2>Przychodnia</h2>
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
          CONTENT FROM MENU THERE
        </div>
      </div>
    </div>
  </body>
</html>