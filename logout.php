<?php
session_start();
$logID = $_SESSION['logID'];
setcookie('logID', '', time() -3600, "/");
include '_.config/_s_db_.php';

var_dump($loginID);
$sql = "UPDATE `fast_logged_users` SET `status` = \'6\' WHERE `fast_logged_users`.`loginID` = '$logID'";
session_destroy();
if ($result = mysqli_query($db, $sql)) {
  unset($_SESSION['logID']);

  header("Location: login");
}else {
  var_dump("Cannot Logout");
}

 ?>
