<?php
session_start();
if (count($_SESSION) > 0)  {
  include '../_.config/_s_db_.php';
  $link = new mysqli("$hostName","$userName","$passWord","$dbName");
  $newUserID = randDigit($link);
  $randOTP = "";
  for ($x = 1; $x <= 6; $x++) {
      // Set each digit
      $randOTP .= random_int(0, 9);
  }
  $sentTime = date('Y-m-d'); // For six minutes
  $email = $_SESSION['userEmail'];
  $hashPassword = $_SESSION['passWord'];
  $fullName = $_SESSION['fullName'];
  $username = $_SESSION['userName'];
  $encPassword = $_SESSION['encPassword'];

  if (addOTP($link, $newUserID, $randOTP,$email,$sentTime)) {
   if (addUser($link, $newUserID, $username,$fullName, $email, $hashPassword, $encPassword)) {
     if (sendOTP($fullName, $email, $newUserID, $randOTP)) {
       header("Location: verify.php?suid=$newUserID");
     }else {
       header("Location: ../register?errorMessage= OTP Not Send&id=FNS");
     }
   }else {
     header("Location: ../register?errorMessage= User Not Added&id=FNS");
   }
 }else {
   header("Location: ../register?errorMessage= OTP Not Added&id=FNS");
 }
}else {
  header("Location: ../register");
}


// add OTP to Database
function addOTP($link,$newUserID, $randOTP,$email,$sentTime){
  $addOTP = "INSERT INTO `fast_otp` (`userID`, `sentOTP`, `emailAddress`,`sentTime`) VALUES ('$newUserID', '$randOTP','$email','$sentTime')";
  $result = mysqli_query($link, $addOTP);
  if ($result) {
    $OTPadded = true;
  }else {
    $OTPadded = false;
  }
  return $OTPadded;
}


// Add user to Database
function addUser($link, $newUserID, $username, $fullName, $email, $password, $encPass){
  $addPassword = "INSERT INTO `user_sec` (`userID`, `ePassword`) VALUES ('$newUserID', '$encPass')";
  $addUser = "INSERT INTO `fast_noverify_users` (`userID`, `userName`, `userFullName`, `userEmail`,`userHashPassword`) VALUES ('$newUserID', '$username',' $fullName', '$email','$password')";
  $result1 = mysqli_query($link, $addUser);
  $result2 = mysqli_query($link, $addPassword);
  if ($result1 && $result2) {
    $userAdded = true;
  }else {
    $userAdded = false;
  }
  return $userAdded;
}


 // Send OTP to email
function sendOTP($fullName, $email, $newUserID, $randomOTP){
  include '../_.config/sjdhfjsadkeys.php';

  $message = "
  <html>
  <head>
  <title>OTP Authenication</title>
  <style media='screen'>
    #message{
      font-size: 1.2em;
    }
  </style>
  </head>
  <body><p id='message'>
  Hello <b>".$fullName." </b><br>
  Your One Time Password is <b>".$randomOTP."</b>.<br /> The OTP will expires in <b>10 Minutes </b> verify by using OTP or the link given below</h3><br /><br />
  <a href='https://m.shafiqhub.com/users/verify.php?suid=".$newUserID ."&cenpto=".$randomOTP."'> Verify Now</a>
  </body>
  </html>";
  $subject = $randomOTP." is Your OTP";
  $headers = "From: admin@shafiqhub.com" . "\r\n" ."CC: admin@shafiqhub.com";
  $headers = 'Content-type: text/html';
  $mailDeliverd =  mail($email,$subject,$message,$headers);
  if ($mailDeliverd) {
    $mailStatus = true;
  }else {
    $mailStatus = false;
  }
  return $mailStatus;
}




// Create Random ID
function checkRandomID($link, $randID){
  $sqlV = "SELECT userID FROM fast_users WHERE userID ='$randID'";
  $sqlN = "SELECT userID FROM fast_noverify_users WHERE userID ='$randID'";
  $resultV = mysqli_query($link, $sqlV);
  $resultN = mysqli_query($link, $sqlN);
  if (mysqli_num_rows($resultV)) {
    $idExist = true;
  }elseif (mysqli_num_rows($resultN)) {
    $idExist = true;
  }else {
    $idExist = false;
  }
  return $idExist;
}
function randDigit($link){
  $randID = RID();
  $checkID = checkRandomID($link, $randID);
  while ($checkID == true) {
    $randID = RID();
    $checkID = checkRandomID($link, $randID);
  }
  return $randID;
}
function RID(){
  $randUID ="";
    for ($i=0; $i < 15; $i++) {
    // Set each digit
    $randUID .= random_int(0, 9);
  }
  return $randUID;
}


// $OTP = createOTP(6);
// $sessionID = $_SESSION["UNIQUESESSION"];
// $sentTime = time();
// $saveOTP = "INSERT INTO `fast_otp` (`sentOTP`, `sessionID`, `emailAddress`, `sentTime`) VALUES ('$OTP', '$sessionID',' $email', '$sentTime')";
