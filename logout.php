<?php
$referrer = $_SERVER['REQUEST_URI'];
session_start();
session_destroy();
if (isset($_GET['redirect'])) {
  $redirect = $_GET['redirect'];
  header("Location: $redirect");
}
 ?>
