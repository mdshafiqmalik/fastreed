<!DOCTYPE html>
<?php include '../components/uniSession.php'; ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include '../components/randVersion.php' ?>
    <link rel="stylesheet" href="../users/src/style.css?v=<?php echo($randVersion); ?>">
    <link rel="stylesheet" href="../assets/css/root.css?v=<?php echo($randVersion); ?>">
    <link rel="stylesheet" href="../users/src/profile.css?v=<?php echo($randVersion); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <div class="navigation">
      <span> <a id="backArrow" href="../">&#171;  <span>Back</span></a> </span>
    </div>
    <?php
    session_start();
    if (isset($_SESSION["userID"]) || isset($_COOKIE["userID"])) {
      echo '<script type="text/javascript">
        document.location = "../profile";
      </script>';
    }


    if (isset($_GET['errorMessage'])) {
      $Message ='<div id="errorMessage">
      <span style="color: red">'.$_GET['errorMessage'].'</span></div>
      ';
    }else {
      $Message = '';
    }
     ?>

    <div id="userDiv" class="cont">
    <div class="content">
    <span id="signUp" >Create An Account</span>

    <form class="loginForm" action="../users/createUser.php" method="post">
   <?php echo $Message; ?>
   <span id="FNS" class="stat" style="color:red;"> All Fields Are Mendatory*</span>
   <div class="loginFields">
     <input width="100%" id="fullName" onkeyup="checkFullName()" type="text" name="fullName" value="" placeholder="Full Name*" required>
     <!-- <span id="usernameStatus"class="status"></span> -->
   </div>
    <span id="UNS" class="stat"></span>
    <div class="loginFields">
      <input width="100%" id="username" onkeyup="checkUsername()" type="text" name="username" value="" placeholder="Username*" required>
    </div>

    <span id="EMS" class="stat"></span>
    <div class="loginFields">
      <input id="signUpEmail" onkeyup="checkEmail()" type="text" name="email" value="" placeholder="E-mail*" required>
    </div>

    <span id="PMS" class="stat"></span>
    <div id="passwordField" class="loginFields">
      <input id="password" onkeyup="checkPassword()"type="password" name="password" value="" placeholder="Password*" required>
      <span class="status">
        <img onclick="change()" id="eyeClosed"src="../assets/pics/svgs/eye_closed.svg" style="display:block;"alt="">
        <img onclick="change()" id="eyeOpened"src="../assets/pics/svgs/eye_show.svg" style="display:none;"alt="">
      </span>
    </div>
    <div class="tc">
    <input id="checkBox" onclick="isChecked()" type="checkbox" name="checkbox"  required>
    <span id="tc">By clicking here I agree to the <a href=""> terms and services</a></span>
    </div>
    <div class="loginSubmit">
      <input id="submitButton" type="submit" name="" value="SEND OTP">
    </div>
    <br>
    <div class="or">
      <span class="">Or</span>
    </div>
    </form>
    <a class="butLink" href="../login"><button class="createAccount">
      <span>Log In</span>
    </button></a>
    </div>
  </body>
  <script src="../users/src/fun.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
</html>
