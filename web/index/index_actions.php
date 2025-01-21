<?php
require("../../config.php");

if (isset($_POST["log_out"])) log_out();

function log_out() {
  stop_session();
  header("Location: ../login/login.php");
}

function get_full_name() {
  $name = get_session_property("name");
  $surname = get_session_property("surname");

  return $name ." ". $surname;
}
?>