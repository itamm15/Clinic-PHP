/*
Universal app searcher. 
Usage: 
  Define searcher in html:

  <div class="search">
    <input type="text" class="search_input" data-table="lekarze_tabela" data-tr-data="lekarzDane" placeholder="Wpisz dane lekarza" />
  </div>

  Where:
  - `data-table` is name of table to be filtered,
  - `data-tr-data` is name of dataset attr settled in the `tr` of `tbody` attr.
*/
document.addEventListener("DOMContentLoaded", () => {
  const searchInputs = document.querySelectorAll(".search_input");

  searchInputs.forEach((input) => {
    const trData = input.dataset.trData;
    const tableClass = input.dataset.table;
    const table = document.querySelector(`.${tableClass}`);
    const rows = table.querySelectorAll("tbody tr");

    input.addEventListener("input", (event) => {
      const filter = event.target.value.toLowerCase();

      rows.forEach((row) => {
        const rowData = row.dataset[trData].toLowerCase();
        row.style.display = rowData.includes(filter) ? "" : "none";
      })
    })
  })
});