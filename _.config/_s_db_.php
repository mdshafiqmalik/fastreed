<?php
date_default_timezone_set('Asia/Kolkata');
if ($_SERVER["HTTP_HOST"] == "m.shafiqhub.com") {
  $hostName = 'db5007199941.hosting-data.io';
  $dbName = 'dbs5934513';
  $userName = 'dbu3756952';
  $passWord = 'TheFastReedSite@123';

}elseif ($_SERVER["HTTP_HOST"] == "localhost") {
  $hostName = 'localhost';
  $dbName = 'fastreed_db';
  $userName = 'root';
  $passWord = '';
}elseif ($_SERVER["HTTP_HOST"] == "192.168.43.172"){
  $hostName = 'localhost';
  $dbName = 'fastreed_db';
  $userName = 'root';
  $passWord = '';
}
$db = new mysqli("$hostName","$userName","$passWord","$dbName");
?>
