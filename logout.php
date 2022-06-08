<?php
session_start();
setcookie('userID', '', time() -3600, "/");
session_destroy();
header("Location: login");
 ?>
