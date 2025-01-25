<?php

  $pacjent_id_to_edit = $_POST["edit"] ?? '';
  $pacjent_id_to_delete = $_POST['delete'] ?? '';

  if ($pacjent_id_to_delete) delete_pacjent($pacjent_id_to_delete);

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

  function delete_pacjent($pacjent_id_to_delete) {
    $conn = get_conn();
    $query = "DELETE FROM pacjenci WHERE id = $pacjent_id_to_delete";

    if (mysqli_query( $conn, $query)) {
      close_conn($conn);
      header("Location: ../index/index.php?page=pacjenci");
      exit();
    } else {
      close_conn($conn);
      echo "Nie udało się usunąć pacjenta!";
    }
  }
?>