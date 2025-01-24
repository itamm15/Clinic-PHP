<?php
  function get_lekarze() {
    $conn = get_conn();
    $query = "SELECT * FROM lekarze;";
    $result = mysqli_query($conn, $query);

    while ($lekarz = mysqli_fetch_row($result)) {
      echo <<<WYPISZ_LEKARZA
        <tr>
          <td>$lekarz[0]</td>
          <td>$lekarz[1]</td>
          <td>$lekarz[2]</td>
          <td>$lekarz[3]</td>
          <td>
            <form method="POST">
              <input type="submit" name="$lekarz[0]" value="Usuń" />
              <input type="submit" name="$lekarz[0]" value="Edytuj" />
            </form>
          </td>
        </tr>
      WYPISZ_LEKARZA;
    }

    close_conn($conn);
  }
?>