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
$upp['folder'] = 'users';
$upp['year'] = '2022';
$upp['month'] = '7';
$upp['id'] ='874954';
$upp['ext'] = 'jpg';
$profileImage = $upp['folder'].'/'.$upp['year'].'/'.$upp['month'].'/'.$upp['id'].'.'.$upp['ext'];
echo $profileImage;
 ?>
