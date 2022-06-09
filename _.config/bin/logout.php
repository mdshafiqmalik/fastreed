<?php
// session_start();
// session_destroy();
// if (isset($_GET['redirect'])) {
//   $redirect = $_GET['redirect'];
//   header("Location: $redirect");
// }
// check if username exist in Database
// Validate Username
date_default_timezone_set('Asia/Kolkata');
$arrayName = array('folder' => 'users','type'=>'default', 'id'=>'56467888','ext'=>'jpg' );
echo serialize($arrayName);
 ?>
