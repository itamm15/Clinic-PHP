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

  // SESSION
  function start_session($name, $surname, $email) {
    session_start();
    $_SESSION["name"] = $name;
    $_SESSION["surname"] = $surname;
    $_SESSION["email"] = $email;
  }

  function stop_session() {
    session_unset();
    session_destroy();
  }

  function get_session_property($key) {
    session_start();
    return  $_SESSION[$key];
  }
?>