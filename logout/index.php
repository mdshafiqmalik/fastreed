<?php
session_start();
$ses = $_SESSION['logID'];
include '../_.config/_s_db_.php';
$sql = "UPDATE fast_logged_users SET status = 0 WHERE loginID = '$ses' ";
$result =mysqli_query($db, $sql);
if ($result) {
  unset($_SESSION['logID']);
  setcookie('logID', '', time()-3600, '/');
  session_destroy();
  header("Location: ../login?message=Sucesssfully Log out");
}else {
  var_dump("Cannot Logout");
}

 ?>
