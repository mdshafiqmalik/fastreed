<?php
if (isset($_GET['errorMessage'])) {
  $Message ='<br><div id="errorMessage">
  <span style="color: red">'.$_GET['errorMessage'].'</span></div>
  <br>';
}else {
  $Message = '';
}
$sendOTP = '
<div id="userDiv" class="cont">
<div class="content">
<span id="signUp" >Create An Account</span>
'.$Message.'
<form class="loginForm" action="verify.php" method="get">
<div class="loginFields">

  <input id="signUpEmail" onkeyup="checkEmail()" type="text" name="email" value="" placeholder="Enter Email">
  <span id="estatus"></span>
</div>
<div class="loginSubmit">
  <input type="submit" name="" value="SEND OTP">
</div>
</form>
</div>
';

$otpSent = '
<div id="userDiv" class="cont">
<div class="content">
<span id="signUp" >Create An Account</span>
<br>
<form class="loginForm" action="verify.php" method="get">
<div class="loginFields">
  <input id=""onkeyup="" type="email" name="email" value="" placeholder="Enter 6 Digit OTP">
</div>
<div class="loginSubmit">
  <input type="submit" name="" value="VERIFY">
</div>
</form>
</div>
';
if (isset($_SESSION['sentOTP'])) {
  $sentOTP = $_SESSION['sentOTP'];

}else {
  echo "$sendOTP";
}
 ?>
