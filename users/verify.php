
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include '../components/randVersion.php' ?>
    <link rel="stylesheet" href="src/style.css?v=<?php echo($randVersion); ?>">
    <link rel="stylesheet" href="../assets/css/root.css?v=<?php echo($randVersion); ?>">
    <link rel="stylesheet" href="src/profile.css?v=<?php echo($randVersion); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
  <div class="navigation">
    <span> <a id="backArrow" href="../">&#171;  <span>Back</span></a> </span>
  </div>

  <?php
  session_start();
  session_destroy();
  if (isset($_GET['suid'])) {
    // Check suid present or not
    $userID = $_GET['suid'];
    $isUserPresent = checkUserID($userID);
    if ($isUserPresent) {
      if (isset($_GET['OTP'])) {
        $OTP = $_GET['OTP'];
        // authenticateOTP($userID);
      }else {
        echo '
        <div id="userDiv" class="cont">
        <div class="content">
        <span id="signUp" >Verify Your OTP</span>
        <span id="successMessage">We have sent a 6 digit OTP to your email</span>
        <form class="loginForm" action="makeRealUser.php?suid=867648756487" method="get">
        <div class="loginFields">
          <input id="OTPfield"onkeyup="checkOTP()" type="number" name="OTP" value="" placeholder="Enter OTP">
        </div>
        <div class="loginSubmit">
          <input id="verifyOTP" type="submit" name="" value="VERIFY"disabled>
        </div>
        </form>
        </div>
        ';
      }
    }else {
      header("Location: ../register");
    }
  }else {
    header("Location: ../register");
  }




  function checkUserID($userID){
    include '../_.config/_s_db_.php';
    $link = new mysqli("$hostName","$userName","$passWord","$dbName");
    $checkSUID = "SELECT userID FROM fast_noverify_users WHERE userID = '$userID'";
    $result = mysqli_query($link, $checkSUID);
    $isUserID = mysqli_num_rows($result);
    if ($isUserID) {
      $userIDPresent = true;
    }else {
      $userIDPresent = false;
    }
    return $userIDPresent;
  }
  ?>

</div>
  <script src="src/fun.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  </body>
</html>
