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
  $sentTime = time()+600; // For Ten minutes
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
  $checkOTP = "SELECT userID FROM fast_otp Where emailAddress = '$email'";
  $res = mysqli_query($link, $checkOTP);
  if ($res) {
    $delRecord = "DELETE FROM fast_otp Where emailAddress= '$email'";
    mysqli_query($link, $delRecord);
  }
  $sentDateTime = date('y-m-d H:i:s');
  $addOTP = "INSERT INTO `fast_otp` (`userID`, `sentOTP`, `emailAddress`,`expTime`,`totalOTP`, `sentDateTime`, `otpIntent`) VALUES ('$newUserID', '$randOTP','$email','$sentTime', '1', '$sentDateTime', 'AV')";
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
  $checkEmail = "SELECT userEmail FROM user_noverify Where userEmail = '$email'";
  $res = mysqli_query($link, $checkEmail);
  if ($res) {
    $delRecord = "DELETE FROM `user_noverify` Where `user_noverify`.`userEmail`= '$email'";
    mysqli_query($link, $delRecord);
  }

  $addUser = "INSERT INTO `user_noverify` (`userID`, `userName`, `userFullName`, `userEmail`,`userHashPassword`,`ePassword`) VALUES ('$newUserID', '$username',' $fullName', '$email','$password', '$encPass')";
  $result = mysqli_query($link, $addUser);
  if ($result) {
    $userAdded = true;
  }else {
    $userAdded = false;
  }
  return $userAdded;
}


 // Send OTP to email
function sendOTP($userFullName, $email, $suid, $randOTP){
  include '../_.config/sjdhfjsadkeys.php';
  $message = "
  <html>
  <head>
  <title>OTP Authenication</title>
  <style media='screen'>
    #message{
      font-size: 1.2em;
    }
    #link{
      text-align:center;
      margin: .8em 0em;
    }
    #link a{
      color: white;
      text-decoration:none;
      background-color: #0165E1;
      font-weight: bold;
      padding: .4em 1.5em;
      border-radius: 2px;
    }
    #message a:hover{
      background-color: #0072ff;
    }
    #OTP{
      text-align:center;
      margin: .8em 0em;
    }
    #OTP p{
      font-size: 1.2em;
      padding: .4em 2em;
      background-color: #eee;
      font-weight:bold;
      letter-spacing: 3px;
    }
    #note{
      background-color: #eee;
      margin-top: 1em;
      padding: .4em;
    }
  </style>
  </head>
  <body><div id='message'>
  Dear <b>".$userFullName." </b><br><br>
  One Time Password(OTP) for account verification is: <b>(valid for 10 minutes only)</b>
  <div id='OTP'><p>".$randOTP."</p></div>
  <div>Or you can verify your account by clicking on the link given  <b>(valid for 10 minutes only)</b>
  <div id='link'><a href='https://m.shafiqhub.com/users/verify.php?suid=".$suid ."&centpo=".$randOTP."'> Verify</a></div>
  <div id='note'><b>Note:</b> Kindly ignore this e-mail if you don't know about it.</div>
  </div>
  </body>
  </html>";
  $subject = $randOTP." is Your OTP";
  $headers = "From: Fastreed OTP Authentication <no-reply@shafiqhub.com>" . "\r\n" ."CC: support@shafiqhub.com"."\r\n"."Content-type: text/html";
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
  $sqlN = "SELECT userID FROM user_noverify WHERE userID ='$randID'";
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
