<?php
session_start();
setcookie('logID', '', time() -3600, "/");
include '_.config/_s_db_.php';
$logID = $_SESSION['logID'];
var_dump($loginID);
$sql = "UPDATE `fast_logged_users` SET `status` = \'6\' WHERE `fast_logged_users`.`loginID` = '$logID'";
if ($result = mysqli_query($db, $sql)) {
  unset($_SESSION['logID']);
  session_destroy();
  header("Location: login");
}else {
  var_dump("Cannot Logout");
}

 ?>
