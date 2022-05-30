<?php
$errorMessage = "Please enter a valid email address";
if (isset($_POST['email'])) {
  $email = $_POST['email'];
  if (filter_var("$email", FILTER_VALIDATE_EMAIL)) {
    // make random 6 Digit OTP
    $randString = createOTP(6);
    session_start();
    $_SESSION["OTPSTRING"] = $randString;
  }else {
    header("Location: /account?errorMessage=$errorMessage");
  }
}else {
  header("Location: /account?errorMessage=$errorMessage");
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
?>
