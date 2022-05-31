<?php

if (isset($_GET['errorMessage'])) {
  $Message ='<br><div id="errorMessage">
  <span style="color: red">'.$_GET['errorMessage'].'</span></div>
  <br>';
}else {
  $Message = '';
}
if (isset($_SESSION["OTPSTRING"])) {
  header("Location: /account/verify.php");
}else {
  echo '
  <div id="userDiv" class="cont">
  <div class="content">
  <span id="signUp" >Create An Account</span>
  '.$Message.'
  <form class="loginForm" action="otp.php" method="post">
  <div class="loginFields">

    <input id="signUpEmail" onkeyup="checkEmail()" type="text" name="email" value="" placeholder="Enter Email">
    <span id="estatus"></span>
  </div>
  <div class="loginSubmit">
    <input id="submitButton" type="submit" name="" value="SEND OTP">
  </div>
  </form>
  </div>
  ';
}
 ?>
