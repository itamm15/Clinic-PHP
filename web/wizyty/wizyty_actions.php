<?php

  function get_wizyty() {
    $conn = get_conn();
    $query = "SELECT 
                wizyty.*, 
                lekarze.imie AS lekarz_imie, lekarze.nazwisko AS lekarz_nazwisko,
                pacjenci.imie AS pacjent_imie, pacjenci.nazwisko AS pacjent_nazwisko
              FROM wizyty 
              INNER JOIN lekarze ON wizyty.lekarz_id = lekarze.id
              INNER JOIN pacjenci ON wizyty.pacjent_id = pacjenci.id;";

    $result = mysqli_query($conn, $query);

    while ($wizyta = mysqli_fetch_assoc($result)) {
      $powod_odwolania = format_powod_odwolania($wizyta['powod_odwolania']);
      echo <<<WYPISZ_WIZYTY
        <tr data-wizyta-dane="$wizyta[opis]">
          <td>$wizyta[id]</td>
          <td>$wizyta[lekarz_imie] $wizyta[lekarz_nazwisko]</td>
          <td>$wizyta[pacjent_imie] $wizyta[pacjent_nazwisko]</td>
          <td>$wizyta[data_wizyty]</td>
          <td>$wizyta[opis]</td>
          <td>$powod_odwolania</td>
          <td>
            <form method="POST">
              <button type="submit" name="delete" value="$wizyta[id]">Usuń</button>
              <button type="submit" name="edit" value="$wizyta[id]">Edytuj</button>
            </form>
          </td>
        </tr>
      WYPISZ_WIZYTY;
    }

    close_conn($conn);
  }

  function format_powod_odwolania($powod_odwolania) {
    if(empty($powod_odwolania)) return "Nie";
    return "Tak, powód: ".$powod_odwolania;
  }
?>