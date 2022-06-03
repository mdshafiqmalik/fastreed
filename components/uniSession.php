<?php
if (!isset($_SESSION["UNIQUESESSION"])) {
  $key = "";
  for ($x = 1; $x <= 20; $x++) {
      // Set each digit
      $key .= random_int(0, 9);
  }
  $_SESSION["UNIQUESESSION"] = $key;
}
 ?>
