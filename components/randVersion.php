<?php
if (!isset($_SESSION['randVersion'])) {
  $r1= rand(0,10);
  $r2= rand(0,10);
  $r3= rand(0,10);
  $r4 = rand(0,10);
  $randVersion ="$r1"."."."$r2"."."."$r3".".".$r4;
  $_SESSION['randVersion'] = $randVersion;
}
?>
