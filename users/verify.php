
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
  <div id="userDiv" class="cont">
  <div class="content">
  <span id="signUp" >Verify Your OTP</span>
  <?php
  session_start();
  session_destroy();

  if (isset($_GET['suid'])) {
    // Check suid present or not
    $userID = $_GET['suid'];
    $isUserPresent = checkUserID($userID);
    if ($isUserPresent) {
      if (isset($_GET['centpo'])) {
        $OTP = $_GET['centpo'];
        if (authenticateOTP($userID , $OTP)) {
          if (!checkOTPEXP($userID , $OTP)) {
            echo '<span id="successMessage">You are verified Now</span>';
          }else {
            echo '
            <span id="errorMessage">Entered link or OTP Expired</span>
            <form class="loginForm" action="'.$self.'" method="post">
            <br>
              <input type="hidden" name="suid" value="'.$userID.'" placeholder="Enter OTP">
              <input type="hidden" name="resendOTP" value="true" placeholder="Enter OTP">
            <div class="loginSubmit">
              <input id="resendOTP" type="submit" name="" value="Resend OTP">
            </div>
            </form>
            ';
          }

        }else {
          echo '
          <span id="errorMessage">Wrong OTP entered</span>
          <form class="loginForm" action="'.$self.'" method="get">
          <div class="loginFields">
            <input type="hidden" name="suid" value="'.$userID.'" placeholder="Enter OTP">
            <input id="OTPfield" onkeyup="checkOTP()" type="number" name="centpo" value="" placeholder="Enter OTP">
          </div>
          <div class="loginSubmit">
            <input id="verifyOTP" type="submit" name="" value="VERIFY">
          </div>
          </form>
          <br>
          <form class="loginForm" action="'.$self.'" method="post">
            <input type="hidden" name="suid" value="'.$userID.'" placeholder="Enter OTP">
            <input type="hidden" name="resendOTP" value="true" placeholder="Enter OTP">
          <div class="loginSubmit">
            <input id="resendOTP" type="submit" name="" value="Resend OTP">
          </div>
          </form>
          ';
        }
      }else {
        $self = htmlspecialchars($_SERVER["PHP_SELF"]);
        echo '
        <span id="successMessage">We have sent a 6 digit OTP to your email</span>
        <form class="loginForm" action="'.$self.'" method="get">
        <div class="loginFields">
          <input type="hidden" name="suid" value="'.$userID.'" placeholder="Enter OTP">
          <input id="OTPfield" onkeyup="checkOTP()" type="number" name="centpo" value="" placeholder="Enter OTP">
        </div>
        <div class="loginSubmit">
          <input id="verifyOTP" type="submit" name="" value="VERIFY">
        </div>
        </form>
        ';
      }
    }else {
      header("Location: ../register");
    }
  }elseif (isset($_POST['suid'] && isset($_POST['resendOTP'])) {
      $userID = $_POST['suid'];
      if (checkSUID($userID)) {
        if(resendOTP($userID)){
          $self = htmlspecialchars($_SERVER["PHP_SELF"]);
          echo '
          <span id="successMessage">We have <i>Resent a 6 digit OTP</i> to your email</span>
          <form class="loginForm" action="'.$self.'" method="get">
          <div class="loginFields">
            <input type="hidden" name="suid" value="'.$userID.'" placeholder="Enter OTP">
            <input id="OTPfield" onkeyup="checkOTP()" type="number" name="centpo" value="" placeholder="Enter OTP">
          </div>
          <div class="loginSubmit">
            <input id="verifyOTP" type="submit" name="" value="VERIFY">
          </div>
          </form>
          <br>
          <form class="loginForm" action="'.$self.'" method="post">
            <input type="hidden" name="suid" value="'.$userID.'" placeholder="Enter OTP">
            <input type="hidden" name="resendOTP" value="true" placeholder="Enter OTP">
          <div class="loginSubmit">
            <input id="resendOTP" type="submit" name="" value="Resend OTP">
          </div>
          </form>
          ';
        }else {
          echo '
          <span style="color:orange;" id="errorMessage">Failed to resend OTP again</span>
          <form class="loginForm" action="'.$self.'" method="get">
          <div class="loginFields">
            <input type="hidden" name="suid" value="'.$userID.'" placeholder="Enter OTP">
            <input id="OTPfield" onkeyup="checkOTP()" type="number" name="centpo" value="" placeholder="Enter OTP">
          </div>
          <div class="loginSubmit">
            <input id="verifyOTP" type="submit" name="" value="VERIFY">
          </div>
          </form>
          <br>
          <form class="loginForm" action="'.$self.'" method="post">
            <input type="hidden" name="suid" value="'.$userID.'" placeholder="Enter OTP">
            <input type="hidden" name="resendOTP" value="true" placeholder="Enter OTP">
          <div class="loginSubmit">
            <input id="resendOTP" type="submit" name="" value="Resend OTP">
          </div>
          </form>
          ';
        }
      }else {
        header("Location: ../register");
      }
  }else {
    header("Location: ../register");
  }

 function resendOTP($suid){
   $expTime = time()+600;
   $randOTP = "";
   for ($x = 1; $x <= 6; $x++) {
       // Set each digit
       $randOTP .= random_int(0, 9);
   }
   include '../_.config/_s_db_.php';
   $link = new mysqli("$hostName","$userName","$passWord","$dbName");
   $upOTPandTime = "UPDATE fast_otp SET sentOTP = '$randOTP', expTime = '$expTime' WHERE userID = '$userID'";
   $result = mysqli_query($link, $upOTPandTime);
   if ($result) {
     $otpResend = true;
   }else {
     $otpResend = false;
   }
   return $otpResend;
 }

  function checkOTPEXP($userID, $OTP){
    include '../_.config/_s_db_.php';
    $link = new mysqli("$hostName","$userName","$passWord","$dbName");
    $sentOTP = "SELECT sentTime FROM fast_otp WHERE userID = '$userID'";
    $result = mysqli_query($link, $sentOTP);
    $expTime = $result->fetch_assoc();
    if ($expTime < time()) {
      $OTPEXP = false;
    }else {
      $OTPEXP = true;
    }
    return $OTPEXP;
  }

  function authenticateOTP($userID, $OTP){
    include '../_.config/_s_db_.php';
    $link = new mysqli("$hostName","$userName","$passWord","$dbName");
    $fastOTP = "SELECT * FROM fast_otp WHERE userID = '$userID'";
    $result = mysqli_query($link, $fastOTP);
    $dbArray = $result->fetch_assoc();
    $dbOTP = $dbArray['sentOTP'];
    $expTime = $dbArray['sentTime'];
    if ($dbOTP == $OTP) {
      $OAuth = true;
    }else {
      $OAuth = false;
    }
    return $OAuth;
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
</div>
  <script src="src/fun.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  </body>
</html>
