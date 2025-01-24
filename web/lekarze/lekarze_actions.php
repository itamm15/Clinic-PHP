<?php
  $lekarz_id_to_edit = $_POST['edit'] ?? '';
  $lekarz_id_to_delete = $_POST['delete'] ?? '';

  if ($lekarz_id_to_edit) {
    // utworz edit pagea
  }

  if ($lekarz_id_to_delete) {
    $conn = get_conn();
    $query = "DELETE FROM lekarze WHERE id = $lekarz_id_to_delete";

    if (mysqli_query($conn, $query)) {
      close_conn($conn);
      header("Location: ../index/index.php?page=lekarze");
    } else {
      echo "Nie udało się usunąć lekarza!";
      close_conn($conn);
    }
  }

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
              <button type="submit" name="delete" value="$lekarz[0]">Usuń</button>
              <button type="submit" name="edit" value="$lekarz[0]">Edytuj</button>
            </form>
          </td>
        </tr>
      WYPISZ_LEKARZA;
    }

    close_conn($conn);
  }
?>