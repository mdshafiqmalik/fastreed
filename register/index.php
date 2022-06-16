
<?php
include '../components/randVersion.php';
if (isset($_SESSION["uisnnue"]) || isset($_COOKIE["uisnnue"])) {
      header("Location: ../profile/");
}
include '../components/uniSession.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include '../components/randVersion.php' ?>
    <link rel="stylesheet" href="../users/src/style.css?v=<?php echo $randVersion; ?>">
    <link rel="stylesheet" href="../assets/css/root.css?v=<?php echo $randVersion; ?>">
    <link rel="stylesheet" href="../users/src/profile.css?v=<?php echo $randVersion; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style media="screen">
      .Gender{
        display: flex;
        align-items: center;
        margin: .3em 1em 1em 1em;
        font-size: 1.2em;
        font-weight: bold;
      }
      .Gender select{
        background: white;
        color: #444;
        margin-left: 1.5em;
        border: 0;
        outline: 0;
        font-size: .8em;
        font-weight: bold;
        border-bottom: 2px solid;
      }
    </style>
  </head>
  <body>
    <?php

    if (isset($_SERVER['HTTP_REFERER'])) {
      $back = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
    }else {
      $back = '../';
    }

     ?>
    <div class="navigation">
      <span> <a id="backArrow" href="<?php echo $back; ?>">&#171;  <span>Back</span></a> </span>
    </div>

    <div id="userDiv" class="cont">
    <div class="content">
    <span id="signUp" >Create An Account</span>

    <form class="loginForm" action="../users/checkdata.php" method="post">
   <span id="FNS" class="stat" style="color:red;"> All Fields Required*</span>
   <div class="loginFields">
     <input width="100%" id="fullName" onkeyup="checkFullName()" type="text" name="fullName" value="" placeholder="Full Name (Jhon Doe)" >
     <!-- <span id="usernameStatus"class="status"></span> -->
   </div>
    <span id="UNS" class="stat"></span>
    <div class="loginFields">
      <input width="100%" id="username" onkeyup="checkUsername()" type="text" name="username" value="" placeholder="Username (jhon_doe)" >
    </div>

    <span id="EMS" class="stat"></span>
    <div class="loginFields">
      <input id="signUpEmail" onkeyup="checkEmail()" type="text" name="email" value="" placeholder="Email (jhondoe@gmail.com)" >
    </div>

    <span id="PMS" class="stat"></span>
    <div id="passwordField" class="loginFields">
      <input id="passworD" onkeyup="checkPassword()" type="text" name="password" value="" placeholder="Password">
    </div>
    <span id="GNS" class="stat"></span>
    <div class="Gender">
      <label for="gender">Gender</label>
      <select name="gender" id="gender"  required>
        <option value="0">SELECT</option>
        <option value="male" >Male</option>
        <option value="female">Female</option>
        <option value="others" >Other</option>
      </select>
    </div>
    <div class="tc">
    <input id="checkBox" onclick="isChecked()" type="checkbox" name="checkbox" >
    <span id="tc">By clicking here I agree to the <a href=""> terms and services</a></span>
    </div>
    <div class="loginSubmit">
      <input id="submitButton" type="submit" name="" value="Create Account">
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
  <?php
  if (isset($_GET['errorMessage'])) {
    echo '  <script type="text/javascript">
        document.getElementById("'.$_GET['id'].'").innerHTML = "'.$_GET['errorMessage'].'";
        document.getElementById("'.$_GET['id'].'").style.color = "red";

        window.onload = function(){
            let errorMessage = document.getElementById("'.$_GET['id'].'");
          if (!errorMessage) {
          }else {
            setTimeout(function(){
              errorMessage.innerHTML = "";
            },6000);
          }
        }
      </script>'
      ;
  }
   ?>

  <script src="../users/src/fun.js?v=<?php echo $_SESSION['randVersion'] ?>" charset="utf-8"></script>
  <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $_SESSION['randVersion'] ?>" charset="utf-8"></script>
</html>
