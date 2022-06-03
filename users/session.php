<?php
include '_.config/_s_db_.php';
   session_start();
   
   if (isset($_SESSION['userID'])) {
     $userID = $_SESSION['userID'];
     $sql = 'SELECT * from fast_users where userID = "$userID"';
     $res = mysqli_query($db,$sql);
     if (mysqli_num_rows($res)){
       $row = $res->fetch_assoc();
       $userID = $row['userID'];
     }
   }
 ?>
