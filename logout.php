<?php
session_start();
setcookie('uisnnue', '', time() -3600, "/");
session_destroy();
header("Location: login");
 ?>
