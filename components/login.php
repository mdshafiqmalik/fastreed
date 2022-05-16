<?php

echo '
    <div class="content">
      <span id="login" >Login In</span>
      <br>
      <form class="loginForm" action="auth.php" method="post">
        <div id="message"class="">

          <span id="">';

          if (isset($_GET['message'])) {
            $message = $_GET['message'];
             echo "$message";
          }
          echo '</span>
        </div>
        <div class="loginFields" id="emailField">
          <select name="countryCode" id="countryCode" style="display:none;">';
            include '../components/countryCodes.php';
            echo '
            </select>
                      <input id="emailOrPassword" type="text" onkeyup="changeField()"name="username" value="" placeholder="Username or Phone">
                    </div>
                    <div class="loginFields">
                      <input id="password" type="password" name="password" value="" placeholder="Password">
                      <span class="status">
                        <img onclick="change()" id="eyeClosed"src="../assets/pics/svgs/eye_closed.svg" style="display:block;"alt="">
                        <img onclick="change()" id="eyeOpened"src="../assets/pics/svgs/eye_show.svg" style="display:none;"alt="">
                      </span>
                    </div>
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
            ';
 ?>
