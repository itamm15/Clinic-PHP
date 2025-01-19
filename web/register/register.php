<?php require('register_actions.php') ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Rejstracja</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="register.css">
  </head>
  <body class="register_page">
    <form method="post" class="register_form">
      <h1 class="register_header">Zarejstruj się</h1>
      <div class="register_form__inputs">
        <input type="text" name="email" placeholder="Email" class="register_text__input">
        <input type="text" name="password" placeholder="Hasło" class="register_text__input">
      </div>
      <div>
        <button class="register_action__button" name="action" value="zarejestruj">Zarejestruj</button>
        <button class="register_action__button" name="action" value="zaloguj">Zaloguj</button>
      </div>
    </form>
  </body>
</html>