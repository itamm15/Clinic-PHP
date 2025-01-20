<?php
require("../../config.php");

if (isset($_POST["log_out"])) log_out();

function log_out() {
  stop_session();
  header("Location: ../login/login.php");
}
?>