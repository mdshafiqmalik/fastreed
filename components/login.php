<?php

echo '
<div id="userDiv" class="cont">
    <div class="content">
      <span id="login" >Login In</span>
      <br>
      <form class="loginForm" action="auth.php" method="post">
        ';

          if (isset($_GET['errorMessage'])) {
            $message = $_GET['errorMessage'];
             echo '<div id="errorMessage"class="">

               <span id="">'.$message.'</span></div>';
          }
          echo '
        <div class="loginFields" id="emailField">
          <!-- <select name="countryCode" id="countryCode" style="display:none;"> -->';
            // include '../components/countryCodes.php';
            echo '
            </select>
                      <input id="emailOrPassword" type="text" onkeyup="changeField()"name="usernameOrEMail" value="" placeholder="Email or Username">
                    </div>
                    <div class="loginFields">
                      <input id="password" type="password" name="password" value="" placeholder="Password">
                      <span class="status">
                        <img onclick="change()" id="eyeClosed"src="../assets/pics/svgs/eye_closed.svg" style="display:block;"alt="">
                        <img onclick="change()" id="eyeOpened"src="../assets/pics/svgs/eye_show.svg" style="display:none;"alt="">
                      </span>
                    </div>
                    <div class="rememberMe"><input id="rememberMe" type="checkbox" name="rememberMe" value="true"> Remember Me</div>
                    <div class="loginSubmit">
                      <input type="submit" name="" value="LOGIN">
                      <a href="#">Forgotten Password?</a>
                    </div>
                    <div class="or">
                      <span class="">Or</span>
                    </div>
                  </form>
                  <!-- <div class="createAccount"> -->
                    <button class="createAccount">
                      <span>Create An Account </span>
                      <img width="13px" width="13px"src="../assets/pics/svgs/plus.svg" alt="">
                    </button>
                </div>
                </div>
            ';
 ?>
