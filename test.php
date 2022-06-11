<?php
include '_.config/_s_db_.php';
$link = new mysqli("$hostName","$userName","$passWord","$dbName");
$uID = "176464569462096";
$getFullName = "SELECT userFullName FROM user_cred WHERE userID = '$uID'";
$userFullName = mysqli_query($link, $getFullName);
$UFN =$userFullName->fetch_assoc();
var_dump($UFN);
 ?>
