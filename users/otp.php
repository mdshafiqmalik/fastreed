<?php
include '../components/randDigits.php';
include '../components/uniSession.php';
if (isset($_POST['email'])) {
  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email = $_POST['email'];
    $OTP = createOTP(6);
    $sessionID = $_SESSION["UNIQUESESSION"];
    $sentTime = time();
    include '../_.config/_s_db_.php';
    $saveOTP = "INSERT INTO `fast_otp` (`sentOTP`, `sessionID`, `emailAddress`, `sentTime`) VALUES ('$OTP', '$sessionID',' $email', '$sentTime')";
    $result = mysqli_query($db,$saveOTP);
    var_dump($result);
    echo '
    <div id="userDiv" class="cont">
    <div class="content">
    <span id="signUp" >Verify Your OTP</span>
    <span id="successMessage">We have sent a 6 digit OTP to your email</span>
    <form class="loginForm" action="verify.php" method="get">
    <div class="loginFields">
      <input id="OTPfield"onkeyup="checkOTP()" type="number" name="email" value="" placeholder="Enter OTP">
    </div>
    <div class="loginSubmit">
      <input id="verifyOTP" type="submit" name="" value="VERIFY"disabled>
    </div>
    </form>
    </div>
    ';
    }else {
      header("Location: /account?errorMessage= Please enter a valid email address");
    }
  }else {
    header("Location: /account/");
  }
 ?>
