<?php
include '../components/randVersion.php';
if (isset($_GET['message'])) {
  $Message ='<div id="errorMessage">
  <span style="color: red">'.$_GET['message'].'</span></div>
  ';
}else {
  $Message = '';
}

if (isset($_SESSION["logID"]) || isset($_COOKIE["uisnnue"])) {
  if (!empty($_COOKIE['logID'])) {
    header("Location: ../profile/");
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../users/src/style.css?v=<?php echo $_SESSION['randVersion']; ?>">
    <link rel="stylesheet" href="../assets/css/root.css?v=<?php echo $_SESSION['randVersion']; ?>">
    <link rel="stylesheet" href="../users/src/profile.css?v=<?php echo $_SESSION['randVersion']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="navigation">
      <span> <a id="backArrow" href="../">&#171;  <span>Back</span></a> </span>
    </div>
    <div id="userDiv" class="cont">
      <div class="content">
        <span id="login">Log In</span>
        <br>
        <form class="loginForm" action="../users/auth.php" method="post">
          <?php echo $Message; ?>
          <span id="ULNS" class="stat"></span>
          <div class="loginFields" id="emailField">
            <input id="emailOrPassword"type="text" onkeyup="" name="usernameOrEMail" value="" placeholder="Email Or Username">
          </div>
          <span id="LPWD" class="stat"></span>
          <div class="loginFields">
            <input id="password" type="password" name="password" value="" placeholder="Password">
            <span class="status" id="passwordEYE">
              <img onclick="change()" id="eyeClosed"src="../assets/pics/svgs/eye_closed.svg" style="display:block;"alt="">
              <img onclick="change()" id="eyeOpened"src="../assets/pics/svgs/eye_show.svg" style="display:none;"alt="">
            </span>
          </div>

          <?php
          if (isset($_SERVER['HTTP_REFERER'])) {
            $red = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
            $logout = ($red == '/logout/');
            $home = ($red == '/');
            $register = ($red == '/register/');

            var_dump($logout);
            var_dump($home);
            var_dump($register);
            if (!$logout || !$register || !$home) {
              echo '<input type="hidden" name="redirect" value="'.$red.'">';
            }
          }
           ?>

          <div class="rememberMe"><input id="rememberMe" type="checkbox" name="rememberMe" value="true"> Remember Me</div>
          <div class="loginSubmit">
            <input type="submit" name="" value="LOGIN">
            <a href="../users/passwordRecovery/">Forgotten Password?</a>
          </div>
          <div class="or">
            <span class="">Or</span>
          </div>
        </form>
        <a class="butLink"href="../register"><button class="createAccount" >
          <span>Create An Account </span>
          <img width="13px" width="13px"src="../assets/pics/svgs/plus.svg" alt="">
        </button></a>
      </div>
    </div>
  </body>
  <script src="../users/src/fun.js?v=<?php echo $_SESSION['randVersion'] ?>" charset="utf-8"></script>
  <!-- <script src="assets/js/jquery-3.6.0.js?v=<?php echo $_SESSION['randVersion'] ?>" charset="utf-8"></script> -->
</html>
