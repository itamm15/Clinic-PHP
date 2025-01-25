<?php require("wizyty_actions.php") ?>

<div class="wizyty_content">
  <h2>Wizyty</h2>
  <div class="search">
    <input type="text" class="search_input" data-table="wizyty_tabela" data-tr-data="wizytaDane" placeholder="Wpisz opis wizyty" />
  </div>
  <table class="wizyty_tabela">
    <thead>
      <tr>
        <th>ID</th>
        <th>Lekarz</th>
        <th>Pacjent</th>
        <th>Data wizyty</th>
        <th>Opis</th>
        <th>Czy odwołana?</th>
        <th>Akcje</th>
      </tr>
    </thead>
    <tbody>
      <?php get_wizyty() ?>
    </tbody>
  </table>
</div>