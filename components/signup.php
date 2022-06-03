<?php
if (isset($_GET['errorMessage'])) {
  $Message ='<br><div id="errorMessage">
  <span style="color: red">'.$_GET['errorMessage'].'</span></div>
  <br>';
}else {
  $Message = '';
}
  echo '
  <div id="userDiv" class="cont">
  <div class="content">
  <span id="signUp" >Create An Account</span>

  <form class="loginForm" action="verify.php" method="post">
'.$Message.'
<span id="UNS" class="stat"></span>
  <div class="loginFields">

    <input id="username" onkeyup="checkUsername()" type="text" name="username" value="" placeholder="Username">
    <span id="usernameStatus"class="status"></span>
  </div>

<span id="EMS" class="stat"></span>
  <div class="loginFields">
    <input id="signUpEmail" onkeyup="checkEmail()" type="text" name="email" value="" placeholder="E-mail">
    <span id="estatus"></span>
  </div>

<span id="PMS" class="stat"></span>
  <div id="passwordField" class="loginFields">
    <input id="password" onkeyup="checkPassword()"type="password" name="password" value="" placeholder="Password">
    <span class="status">
      <img onclick="change()" id="eyeClosed"src="../assets/pics/svgs/eye_closed.svg" style="display:block;"alt="">
      <img onclick="change()" id="eyeOpened"src="../assets/pics/svgs/eye_show.svg" style="display:none;"alt="">
    </span>
  </div>
  <div class="tc">
  <input type="checkbox" name="" value="">
  <span id="tc">By Clicking I agree to the <a href=""> terms and services</a></span>
  </div>
  <div class="loginSubmit">
    <input id="submitButton" type="submit" name="" value="SEND OTP" disabled>
  </div>
  </form>
  </div>
  ';
 ?>
