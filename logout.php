<?php
session_start();
$logID = $_COOKIE['logID'];
var_dump($loginID);
include '_.config/_s_db_.php';
// $sql = "UPDATE `fast_logged_users` SET `status` = \'6\' WHERE `fast_logged_users`.`loginID` = '$logID'";
// $result =mysqli_query($db, $sql);
// if ($result) {
//   unset($_SESSION['logID']);
//   session_destroy();
//   header("Location: login");
// }else {
//   var_dump("Cannot Logout");
// }

 ?>
