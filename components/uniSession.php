<?php
include '../components/randDIGITS.php';
if (!isset($_SESSION["UNIQUESESSION"])) {
  $_SESSION["UNIQUESESSION"] = createOTP(20);
}
 ?>
