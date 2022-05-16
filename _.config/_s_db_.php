<?php
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
}else {
}
$db = new mysqli("$hostName","$userName","$passWord","$dbName");

?>
