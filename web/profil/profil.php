<?php require("profil_actions.php") ?>

<div class="profil_content">
  <h1 class="profil_header">Profil użytkownika</h1>
  <div class="profil_info">
    <p><span>Imię:</span> <?php echo get_session_property("name") ?></p>
    <p><span>Nazwisko:</span> <?php echo get_session_property("surname") ?></p>
    <p><span>Email:</span> <?php echo get_session_property("email"); ?></p>
    <p><span>Typ użytkownika:</span> <?php echo get_session_property("user_type") ?></p>
    <?php echo render_change_password_form() ?>
  </div>
</div>