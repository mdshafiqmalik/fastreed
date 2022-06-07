<?php
include '../components/randDigits.php';
include '../components/uniSession.php';
include '../_.config/_s_db_.php';
if (isset($_POST)) {
  if (isset($_POST['email'])) {
    $username = sanitizeData($_POST['username']);
    $passWord =sanitizeData($_POST['password']);
    $email = sanitizeData($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

      }else {
        header("Location: /users?errorMessage= Please enter a valid email address");
      }
    }else {
      header("Location: /users/");
    }
}else {
  header("Location: /users/");
}

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

 ?>
