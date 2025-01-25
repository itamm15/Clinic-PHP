<?php require("pacjenci_actions.php") ?>

<div class="pacjenci_content">
  <h2>Pacjenci</h2>
  <div class="search">
    <input type="text" class="search_input" data-table="pacjenci_tabela" data-tr-data="pacjentDane" placeholder="Wpisz dane lekarza" />
  </div>
  <table class="pacjenci_tabela">
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
      <?php get_pacjenci() ?>
    </tbody>
  </table>
</div>