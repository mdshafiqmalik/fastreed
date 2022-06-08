<?php
include '../components/randDigits.php';
include '../components/uniSession.php';
include '../_.config/_s_db_.php';
if (isset($_POST)) {
  if (isset($_POST['email'])) {
    $fullName = sanitizeData($_POST['fullName']);
    $username = sanitizeData($_POST['username']);
    $passWords =sanitizeData($_POST['password']);
    $email = sanitizeData($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $link = new mysqli("$hostName","$userName","$passWord","$dbName");

      $checkMailAlreadyExist = "SELECT userEmail FROM fast_users Where userEmail = '$email'";
      $result = mysqli_query($link, $checkMailAlreadyExist);
      if (mysqli_num_rows($result)) { // email already exist
        header("Location: ../register?errorMessage= Email is linked with another account");
      }else {
        $checkUsernameExist = "SELECT userName FROM fast_users Where userName = '$username'";
        $result1 = mysqli_query($link, $checkUsernameExist);
        if (mysqli_num_rows($result1)) {
          header("Location: ../register?errorMessage= Username is Taken");
        }else {
          $newUserID = randDigit($link);
          $randOTP = "";
          for ($x = 1; $x <= 6; $x++) {
              // Set each digit
              $randOTP .= random_int(0, 9);
          }
          $sentTime = time()+600;
          if (addOTP($link, $newUserID, $randOTP,$email,$sentTime)) {
            if (addUser($link,$newUserID, $username,$fullName, $email,$passWords)) {
              if (sendOTP($fullName, $email, $newUserID, $randOTP)) {
                echo "Everything is ok";
              }else {
                header("Location: ../register?errorMessage= OTP Not Send");
              }
            }else {
              header("Location: ../register?errorMessage= User Not Added");
            }
          }else {
            header("Location: ../register?errorMessage= OTP Not Added");
          }
        }
      }
      }else {
        header("Location: ../register?errorMessage= Please enter a valid email address");
      }
    }else {
      header("Location: ../register");
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
function addUser($link,$newUserID, $username,$fullName, $email,$password){
  $addUser = "INSERT INTO `fast_noVerify_users` (`userID`, `userName`, `userFullName`, `userEmail`,`userHashPassword`) VALUES ('$newUserID', '$username',' $fullName', '$email','$password')";
  $result = mysqli_query($link, $addUser);
  if ($result) {
    $userAdded = true;
  }else {
    $userAdded = false;
  }
  return $userAdded;
}


//  Send OTP to email
function sendOTP($fullName, $email, $newUserID, $randomOTP){
  include '../_.config/sjdhfjsadkeys.php';

  $encOTP = openssl_encrypt($randomOTP, $ciphering,
  $encryption_key, $options, $encryption_iv);
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
  Hello ".$fullName."
  Your One Time Password is <b>".$randomOTP."</b>.<br /> The OTP will expires in <b>10 Minutes </b> verify by using OTP or the link given below</h3><br />
  <a href='https://m.shafiqhub.com/users/verify.php?suid=".$newUserID ."&cenpto=".$encOTP."'> Verify Now</a>
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
  $sqlN = "SELECT userID FROM fast_noVerify_users WHERE userID ='$randID'";
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

// Sanitize Data
function sanitizeData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// $OTP = createOTP(6);
// $sessionID = $_SESSION["UNIQUESESSION"];
// $sentTime = time();
// $saveOTP = "INSERT INTO `fast_otp` (`sentOTP`, `sessionID`, `emailAddress`, `sentTime`) VALUES ('$OTP', '$sessionID',' $email', '$sentTime')";
