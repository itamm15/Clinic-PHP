<?php require("lekarze_actions.php") ?>

<div class="lekarze_content">
  <h2>Lekarze</h2>
  <table class="lekarze_tabela">
    <thead>
      <tr>
        <th>ID</th>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Email</th>
        <th>Akcje</th>
      </tr>
    </thead>
    <tbody>
      <?php get_lekarze() ?>
    </tbody>
  </table>
</div>