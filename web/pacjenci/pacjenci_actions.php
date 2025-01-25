<?php

  function get_pacjenci() {
    $conn = get_conn();
    $query = "SELECT * FROM pacjenci";
    $result = mysqli_query($conn, $query);

    while ($pacjent = mysqli_fetch_row($result)) {
      echo <<<WYPISZ_PACJENTA
        <tr data-pacjent-dane="$pacjent[0] $pacjent[1]">
          <td>$pacjent[0]</td>
          <td>$pacjent[1]</td>
          <td>$pacjent[2]</td>
          <td>$pacjent[3]</td>
          <td>
            <form method="POST">
              <button type="submit" name="delete" value="$pacjent[0]">Usuń</button>
              <button type="submit" name="edit" value="$pacjent[0]">Edytuj</button>
            </form>
          </td>
        </tr>  
      WYPISZ_PACJENTA;
    }

    close_conn($conn);
  }
?>