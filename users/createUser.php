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

          $OTP = createOTP(6);
          $message = "<html><body>Your One Time Password(OTP) is <b>".$OTP."</b>. It will expires in <b>10 Minutes </b> verify by using OTP or the link given below</body></html>";
          $to = "mdshafiqmalik98@gmail.com";
          $subject = "OTP Authenication";
          $headers = "From: support@earnmore.com" . "\r\n" ."CC: admin@shafiqhub.com";
          $headers  .= 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

          mail($to,$subject,$message,$headers);
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
function createOTP($keyLen){
  // Set a blank variable to store the key in
   $key = "";
   for ($x = 1; $x <= $keyLen; $x++) {
       // Set each digit
       $key .= random_int(0, 9);
   }
   return $key;
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
