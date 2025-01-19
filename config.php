<?php
  // DB
  function get_conn() {
    $server = "localhost";
    $port = "3307";
    $username = "root";
    $password = "";
    $database = "przychodnia";
  
    $conn = mysqli_connect($server, $username, $password, $database, $port);

    if(!$conn) die("Polaczenie nieudane! ". mysqli_connect_error());

    return $conn;
  }

  function close_conn($conn) {
    mysqli_close($conn);
  }
?>