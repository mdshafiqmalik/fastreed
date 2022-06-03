<?php
header('content-type:application/json');
include '../../_.config/_s_db_.php';
$link = new mysqli("$hostName","$userName","$passWord","$dbName");
if (isset($_GET["username"])) {
  $inputValue = $_GET["username"];
  $userDataSql =  "SELECT * FROM fast_users Where  BINARY userName = '".$inputValue."' ";
    if (mysqli_query($link, $userDataSql)) {
      $result = mysqli_query($link, $userDataSql);
      if (mysqli_num_rows($result)) {
        $found = array("Result"=>true);
        $foundJSON = json_encode($found);
        echo "$foundJSON";
      }else {
        $notFound = array("Result"=>false);
        $notFoundJSON = json_encode($notFound);
        echo "$notFoundJSON";
      }
    }else {
      $cantRead = array("Result"=>"undefined");
      $cantReadDecode = json_encode($cantRead);
      echo "$cantReadDecode";
    }
}else if(isset($_GET["email"])) {
    $inputValue = $_GET["email"];
  $userDataSql =  "SELECT * FROM fast_users Where userEmail = '".$inputValue."' ";
    if (mysqli_query($link, $userDataSql)) {
      $result = mysqli_query($link, $userDataSql);
      if (mysqli_num_rows($result)) {
        $found = array("Result"=>true);
        $foundJSON = json_encode($found);
        echo "$foundJSON";
      }else {
        $notFound = array("Result"=>false);
        $notFoundJSON = json_encode($notFound);
        echo "$notFoundJSON";
      }
    }else {
      $cantRead = array("Result"=>"undefined");
      $cantReadDecode = json_encode($cantRead);
      echo "$cantReadDecode";
    }
}else {
    $cantRead = array("Result"=>"Access Denied");
    $cantReadDecode = json_encode($cantRead);
    echo "$cantReadDecode";
}
 ?>
