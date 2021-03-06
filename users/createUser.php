<?php
session_start();
if (count($_SESSION) > 0)  {
  include '../_.config/_s_db_.php';
  $newUserID = randDigit($db);
  $randOTP = "";
  for ($x = 1; $x <= 6; $x++) {
      // Set each digit
      $randOTP .= random_int(0, 9);
  }
  $expTime = time()+600; // For Ten minutes
  $email = $_SESSION['userEmail'];
  $hashPassword = $_SESSION['passWord'];
  $fullName = $_SESSION['fullName'];
  $username = $_SESSION['userName'];
  $encPassword = $_SESSION['encPassword'];
  $gender = $_SESSION['gender'];
  $refUserID = $newUserID * 2536;

  if (addOTP($db, $newUserID, $randOTP,$email,$expTime)) {
   if (addUser($expTime, $db, $newUserID, $username,$fullName, $email, $hashPassword, $encPassword, $gender)) {
     include 'mail/avOTP.php';

     if (sendOTP($email, $refUserID, $randOTP, $fullName, $gender)) { //sendOTP($email, $newUserID, $randOTP, $fullName)

       header("Location: verify.php?_secRandID=$refUserID");
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
function addOTP($db,$newUserID, $randOTP,$email,$expTime){
  $checkOTP = "SELECT userID FROM fast_otp Where emailAddress = '$email'";
  $res = mysqli_query($db, $checkOTP);
  if ($res) {
    $delRecord = "DELETE FROM fast_otp Where emailAddress= '$email' AND optIntent ='AV'";
    mysqli_query($db, $delRecord);
  }
  $sentDateTime = date('y-m-d H:i:s');
  $addOTP = "INSERT INTO `fast_otp` (`userID`, `sentOTP`, `emailAddress`,`expTime`,`totalOTP`, `sentDateTime`, `otpIntent`) VALUES ('$newUserID', '$randOTP','$email','$expTime', '1', '$sentDateTime', 'AV')";
  $result = mysqli_query($db, $addOTP);
  if ($result) {
    $OTPadded = true;
  }else {
    $OTPadded = false;
  }
  return $OTPadded;
}


// Add user to Database
function addUser($secKey, $db, $newUserID, $username, $fullName, $email, $password, $encPass, $gender){
  $checkEmail = "SELECT userEmail FROM user_noverify Where userEmail = '$email'";
  $res = mysqli_query($db, $checkEmail);
  if ($res) {
    $delRecord = "DELETE FROM user_noverify WHERE userEmail= '$email'";
    mysqli_query($db, $delRecord);
  }

  $addUser = "INSERT INTO `user_noverify` (`userID`, `userName`, `userFullName`, `userEmail`,`userHashPassword`,`ePassword`, `gender`,`vKey`) VALUES ('$newUserID', '$username',' $fullName', '$email','$password', '$encPass', '$gender', '$secKey')";
  $result = mysqli_query($db, $addUser);
  if ($result) {
    $userAdded = true;
  }else {
    $userAdded = false;
  }
  return $userAdded;
}


// Create Random ID
function checkRandomID($db, $randID){
  $sqlV = "SELECT userID FROM fast_users WHERE userID ='$randID'";
  $sqlN = "SELECT userID FROM user_noverify WHERE userID ='$randID'";
  $resultV = mysqli_query($db, $sqlV);
  $resultN = mysqli_query($db, $sqlN);
  if (mysqli_num_rows($resultV)) {
    $idExist = true;
  }elseif (mysqli_num_rows($resultN)) {
    $idExist = true;
  }else {
    $idExist = false;
  }
  return $idExist;
}
function randDigit($db){
  $randID = RID();
  $checkID = checkRandomID($db, $randID);
  while ($checkID == true) {
    $randID = RID();
    $checkID = checkRandomID($db, $randID);
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
