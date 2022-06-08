<?php
// session_start();
// session_destroy();
// if (isset($_GET['redirect'])) {
//   $redirect = $_GET['redirect'];
//   header("Location: $redirect");
// }
// check if username exist in Database
// Validate Username
function isValidUsername($userName){
  $allowed  = array("_","-");
  if (ctype_alnum(str_replace($allowed, '', $userName))) {
    $isvalid = true;
  }else {
    $isvalid = false;
  }
  return $isvalid;
}

var_dump(isValidUsername("MDSHAFIQ7"));
 ?>
