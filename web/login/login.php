<?php require('login_actions.php') ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Logowanie</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="login.css">
  </head>
  <body class="login_page">
    <form method="post" class="login_form">
      <?php show_errors() ?>
      <h1 class="login_header">Zaloguj się</h1>
      <div class="login_form__inputs">
        <input type="text" name="email" placeholder="Email" class="login_text__input">
        <input type="password" name="password" placeholder="Hasło" class="login_text__input">
      </div>
      <div>
        <button class="login_action__button" name="action" value="zaloguj">Zaloguj się</button>
        <button class="login_action__button" name="action" value="zarejestruj">Zarejestruj</button>
      </div>
    </form>
  </body>
</html>