<?php
include "../../config/secrets.php";
function isConnected()
{
  $link = new mysqli($host_name, $user_name, $password, $database);
 if ($link->connect_error) {
   $isConnect = die('<p>Failed to connect to MySQL: '. $link->connect_error .'</p>');
 } else {
   $isConnect ='<p>Connection to MySQL server successfully established.</p>';
 }
 return $isConnect;
}

?>
