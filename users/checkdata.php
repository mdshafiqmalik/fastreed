<?php
if (isset($_POST)) {
  $allInputSet = (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['fullName']) && isset($_POST['password']) && isset($_POST['checkbox']));
  if ($allInputSet) { // Check If all fields are filled
    // make varables of the field Values
    $emailAddress = $_POST['email'];
    $userName = $_POST['username'];
    $fullName = $_POST['fullName'];
    $passWord = $_POST['password'];
    $inputEmpty = (empty($emailAddress) && empty($userName) && empty($fullName) && empty($passWord));
    if (!$inputEmpty) { // Inputs are not empty
      // username Validation
      $sanitizedUserName = sanitizeData($userName);
      $userNameLength = strlen($sanitizedUserName);
      $minUserNameLen = $userNameLength > 10;
      $checkUserNameExist = checkUserNameExist($sanitizedUserName);
      var_dump($checkUserNameExist);
      var_dump($sanitizedUserName);
    }else {
      header("Location: ../register");
    }
  }else {
    header("Location: ../register");
  }
}else {
  header("Location: ../register");
}



// check if username exist in Database
function checkUserNameExist($userName){
  include '../_.config/_s_db_.php';
  $link = new mysqli("$hostName","$userName","$passWord","$dbName");
  // check in verified users table
  $sqlV = "SELECT userName FROM fast_users Where userName = '$userName'";
  $resultV = mysqli_query($link, $sqlV);
  $userNameExistV = mysqli_num_rows($resultV);

  // check in non verified users mysql_list_tables
  $sqlN =  "SELECT userName FROM fast_noverify_users Where userName = '$userName'";
  $resultN = mysqli_query($link, $sqlN);
  $userNameExistN = mysqli_num_rows($resultN);
  var_dump($userNameExistN);
  var_dump($userNameExistV);
  // check if username exist in any tables
  if ($userNameExistV || $userNameExistN) {
    $unameExist = true;
  }else {
    $unameExist = false;
  }
  return $unameExist;
}



// Sanitize Data
function sanitizeData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
