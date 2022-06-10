<?php
session_start();
// $_SESSION['true'] = 'true';
if (isset($_SESSION['true'])&& isset($_GET['eikooCtes'])) {
  if ($_GET['eikooCtes'] == 'true' ) {
    echo "true";
  }
}else {
}
 ?>
