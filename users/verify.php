<?php
session_start();
if (isset($_GET['suid'])) {
  // Check suid present or not
  $userID = $_GET['suid'];
  $isUserPresent = checkUserID($userID);
  if ($isUserPresent) {
    if (isset($_GET['centpo'])) {
      $OTP = $_GET['centpo'];
      if (authenticateOTP($userID , $OTP)) {
        if (!checkOTPEXP($userID)) {
          if (delOTP($userID)) {
            if (verifyUser($userID)) {
              include '../_.config/sjdhfjsadkeys.php';
              $encUID = openssl_encrypt($userID, $ciphering,
              $encryption_key, $options, $encryption_iv);
              $_SESSION['uisnnue'] = $userID;
              // setcookie('uisnnue', $encUID, time()+(86400*7), '/');
              if (isset($_SESSION['uisnnue'])) {
                $uID = $_SESSION['uisnnue'];

                include '../_.config/_s_db_.php';
                $link = new mysqli("$hostName","$userName","$passWord","$dbName");
                $getUserDetail = "SELECT * FROM fast_users WHERE userID = '$uID'";
                $userDetail = mysqli_query($link, $getUserDetail);
                $userDetailArray = $userDetail->fetch_assoc();
                $userName = $userDetailArray['userName'];
                $userEmail = $userDetailArray['userEmail'];

                $getFullName = "SELECT * FROM user_cred WHERE userID = '$uID'";
                $userFullN = mysqli_query($link, $getFullName);
                $userFullName = $userFullN->fetch_assoc();
                $UFN = $userFullName['userFullName'];
                include 'otp.php';
                greeetingMail($userFullName, $userName, $userEmail);
                $GLOBALS['body']  = '<center><span id="successMessage">Registered Sucesssfully</span></center><br>
                <center><span id="successMessage">Redirecting....</span></center>
                <script type="text/javascript">
                  document.location = "../profile/?eikooCtes=true";
                </script>';
              }else {
                $GLOBALS['body']  = '<center><span id="successMessage">Registered Sucesssfully</span></center><br>
                <center><span id="successMessage">Redirecting to Login page</span></center>

                <script type="text/javascript">
                setTimeout(function(){
                  document.location = "../login";
                },5000);
                </script>
                ';
              }
            }else {
              $GLOBALS['body']  = '<center><span id="errorMessage">There is some problem at our end (000X2)</span></center>';
            }
          }else {
            $GLOBALS['body']  = '<center><span id="errorMessage">There is some problem at our end (000X1)</span></center>';
          }

        }else {
          $self = htmlspecialchars($_SERVER["PHP_SELF"]);
          $GLOBALS['body']  =  '
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
        $self = htmlspecialchars($_SERVER["PHP_SELF"]);
        $GLOBALS['body']  =  '
        <span id="signUp" >Verify Your OTP</span>
        <span id="errorMessage">Wrong OTP entered</span>
        <form class="loginForm" action="'.$self.'" method="get">
        <div class="loginFields">
          <input type="hidden" name="suid" value="'.$userID.'" placeholder="">
          <input id="OTPfield" onkeyup="checkOTP()" type="number" name="centpo" value="" placeholder="000000">
        </div>
        <div class="loginSubmit">
          <input id="verifyOTP" type="submit" name="" value="VERIFY">
        </div>
        </form>
        <br>
        <form class="loginForm" action="'.$self.'" method="post">
          <input type="hidden" name="suid" value="'.$userID.'" placeholder="000000">
          <input type="hidden" name="resendOTP" value="true" placeholder="Enter OTP">
        <div class="loginSubmit">
          <input id="resendOTP" type="submit" name="" value="Resend OTP">
        </div>
        </form>
        ';
      }
    }else {
      $self = htmlspecialchars($_SERVER["PHP_SELF"]);
      $GLOBALS['body']  =  '
      <span id="signUp" >Verify Your OTP</span>
      <span id="successMessage">We have sent a 6 digit OTP to your email</span>
      <form class="loginForm" action="'.$self.'" method="get">
      <div class="loginFields">
        <input type="hidden" name="suid" value="'.$userID.'" placeholder="">
        <input id="OTPfield" onkeyup="checkOTP()" type="number" name="centpo" value="" placeholder="000000">
      </div>
      <div class="loginSubmit">
        <input id="verifyOTP" type="submit" name="" value="VERIFY">
      </div>
      </form>
      <form class="loginForm" action="'.$self.'" method="post">
      <br>
        <input type="hidden" name="suid" value="'.$userID.'" placeholder="">
        <input type="hidden" name="resendOTP" value="true" placeholder="">
      <div class="loginSubmit">
        <input id="resendOTP" type="submit" name="" value="Resend OTP">
      </div>
      </form>
      <script>
       if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
         }
      </script>
      ';
    }
  }else {
    $GLOBALS['body']  =  '<center><span style="color:orange;" id="errorMessage">User verified already</span></center><br>
    <center><span id="successMessage">Redirecting...</span></center>
    <script type="text/javascript">
    setTimeout(function(){
      document.location = "../login?errorMessage=000USER33";
    },3000);
    </script>';
  }
}elseif(isset($_POST)) {
  $paramSet = isset($_POST['suid']) && isset($_POST['resendOTP']);
  if ($paramSet) {
    $userID = $_POST['suid'];
    if (checkUserID($userID)) {
      if(updateOTP($userID)){
        $self = htmlspecialchars($_SERVER["PHP_SELF"]);
        $GLOBALS['body']  =  '
        <span id="signUp" >Verify Your OTP</span>
        <span id="successMessage">We have <i>Resent a 6 digit OTP</i> to your email</span>
        <form class="loginForm" action="'.$self.'" method="get">
        <div class="loginFields">
          <input type="hidden" name="suid" value="'.$userID.'" placeholder="">
          <input id="OTPfield" onkeyup="checkOTP()" type="number" name="centpo" value="" placeholder="000000">
        </div>
        <div class="loginSubmit">
          <input id="verifyOTP" type="submit" name="" value="VERIFY">
        </div>
        </form>
        <br>
        <form class="loginForm" action="'.$self.'" method="post">
          <input type="hidden" name="suid" value="'.$userID.'" placeholder="">
          <input type="hidden" name="resendOTP" value="true" placeholder="">
        <div class="loginSubmit">
          <input id="resendOTP" type="submit" name="" value="Resend OTP">
        </div>
        <script>
         if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
           }
        </script>
        </form>
        ';
      }else {
        $self = htmlspecialchars($_SERVER["PHP_SELF"]);
        $GLOBALS['body']  =  '
        <span id="signUp" >Verify Your OTP</span>
        <span style="color:orange;" id="errorMessage">Failed to resend OTP again</span>
        <form class="loginForm" action="'.$self.'" method="get">
        <div class="loginFields">
          <input type="hidden" name="suid" value="'.$userID.'" placeholder="">
          <input id="OTPfield" onkeyup="checkOTP()" type="number" name="centpo" value="" placeholder="000000">
        </div>
        <div class="loginSubmit">
          <input id="verifyOTP" type="submit" name="" value="VERIFY">
        </div>
        </form>
        <br>
        <form class="loginForm" action="'.$self.'" method="post">
          <input type="hidden" name="suid" value="'.$userID.'" placeholder="">
          <input type="hidden" name="resendOTP" value="true" placeholder="">
        <div class="loginSubmit">
          <input id="resendOTP" type="submit" name="" value="Resend OTP">
        </div>
        </form>
        ';
      }
    }else {
      $GLOBALS['body']  =  '<script type="text/javascript">
        document.location = "../register?errorMessage=000X3&id=FNS";
      </script>';
    }
  }else {
    $GLOBALS['body']  =  '<script type="text/javascript">
      document.location = "../register?errorMessage=?errorMessage=000X4&id=FNS&id=FNS";
    </script>';
  }
}else {
  $GLOBALS['body']  =  '<script type="text/javascript">
    document.location = "../register?errorMessage=000X5&id=FNS";
  </script>';
}
?>
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
    <span> <a id="backArrow" href="../register">&#171;  <span>Back</span></a> </span>
  </div>
  <div id="userDiv" class="cont">
  <div class="content">
    <?php
    if (isset($GLOBALS['body'])){
      echo $GLOBALS['body'];
    }
    ?>
  </div>
  </div>
  <script src="src/fun.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  </body>
</html>




<?php
// Delete OTP Data
function delOTP($userID){
  include '../_.config/_s_db_.php';
  $link = new mysqli("$hostName","$userName","$passWord","$dbName");
  $sql = "DELETE FROM fast_otp WHERE userID = '$userID'";
  if(mysqli_query($link, $sql)){
    $otpDeleted = true;
  }else {
    $otpDeleted = false;;
  }
  return $otpDeleted;
}


// Move User Data from no Verify to verified users
function verifyUser($userID){
  include '../_.config/_s_db_.php';
  $link = new mysqli("$hostName","$userName","$passWord","$dbName");
  $sql = "SELECT * FROM user_noverify WHERE userID = '$userID'";
  $result = mysqli_query($link, $sql);
  if ($result) {
    $data = $result->fetch_assoc();
    $userID = $data['userID'];
    $fullName = $data['userFullName'];
    $userName = $data['userName'];
    $userEmail = $data['userEmail'];
    $userHashPassword = $data['userHashPassword'];
    $ePassword = $data['ePassword'];
    $userJoiningDate = date('y-m-d H:i:s');
    $defaultProfilePic = '0';
    // add to fast_users
    $insertData =  "INSERT INTO `fast_users` (`userID`, `userEmail`, `userName`, `userPhone`, `userHashPassword`) VALUES ('$userID', '$userEmail', '$userName','', '$userHashPassword')";

    // add to uers_crendentials
    $inUserCred =  "INSERT INTO `user_cred` (`userID`, `userFullName`, `userDOB`, `userProfilePic`, `userGender`, `userJoiningDate`, `userCountry`, `userType`) VALUES ('$userID', '$fullName','','$defaultProfilePic','', '$userJoiningDate','','0')";

    // add to user_sec
    $inUserSec = "INSERT INTO `user_sec` (`userID`,`ePassword`) VALUES ('$userID', '$ePassword')";

    // add to user_verify
    $inUserverify = "INSERT INTO `user_verify` (`userID`,`emailVerify`, `phoneVerify`,`IDVerify`,`greenTickVerified`) VALUES ('$userID', '1', '0', '0', '0')";

    $r1 = mysqli_query($link, $insertData);
    $r2 = mysqli_query($link, $inUserCred);
    $r3 = mysqli_query($link, $inUserSec);
    $r4 = mysqli_query($link, $inUserverify);
    if ($r1 && $r2 && $r3 && $r4) {
      $delNoVerify ="DELETE FROM user_noverify WHERE userID = '$userID'";
      $r5 = mysqli_query($link, $delNoVerify);
      if ($r5) {
        $userAdded = true;
      }else {
        $userAdded = false;
      }
    }else {
      $userAdded = false;
    }
  }else {
    $userAdded = false;
  }
  return $userAdded;
}

// Update OTP
function updateOTP($suid){
 $expTime = time()+600;
 $randOTP = "";
 for ($x = 1; $x <= 6; $x++) {
     // Set each digit
     $randOTP .= random_int(0, 9);
 }
 include '../_.config/_s_db_.php';
 $link = new mysqli("$hostName","$userName","$passWord","$dbName");
 $totalOTP = "SELECT * FROM fast_otp WHERE userID = '$suid'";
 $result0 = mysqli_query($link, $totalOTP);
 $arrayD = $result0->fetch_assoc();
 $tOTP = $arrayD['totalOTP'];
 $tOTP = intval($tOTP);
 $tOTP +=1;
 $sentDateTime = date('y-m-d H:i:s');
 $upOTPandTime = "UPDATE fast_otp SET sentOTP = '$randOTP', expTime = '$expTime', totalOTP = '$tOTP' , sentDateTime = '$sentDateTime' WHERE userID = '$suid'";
 $result1 = mysqli_query($link, $upOTPandTime);
 if ($result1) {
   $getEmailandFullName = "SELECT userEmail, userFullName FROM user_noverify WHERE userID ='$suid'";
   $result2 = mysqli_query($link, $getEmailandFullName);
   if ($result2) {
     $arrayDat = $result2->fetch_assoc();
     $userFullName = $arrayDat['userFullName'];
     $userEmail = $arrayDat['userEmail'];
     include 'otp.php';
     if (sendOTP($userEmail, $suid, $randOTP, $userFullName)) {
       $otpResend = true;
     }else {
       $otpResend = false;
     }
   }else {
     $otpResend = false;
   }
 }else {
   $otpResend = false;
 }
 return $otpResend;
}

function checkOTPEXP($userID){
  include '../_.config/_s_db_.php';
  $link = new mysqli("$hostName","$userName","$passWord","$dbName");
  $sentOTP = "SELECT * FROM fast_otp WHERE userID = '$userID'";
  $result = mysqli_query($link, $sentOTP);
  $expTime = $result->fetch_assoc();
  $eTime = $expTime['expTime'];
  if (time() > $eTime) {
    $OTPEXP = true;
  }else {
    $OTPEXP = false;
  }
  return $OTPEXP;
}

function authenticateOTP($userID, $OTP){
  include '../_.config/_s_db_.php';
  $link = new mysqli("$hostName","$userName","$passWord","$dbName");
  $fastOTP = "SELECT * FROM fast_otp WHERE userID = '$userID' AND otpIntent = 'AV'";
  $result = mysqli_query($link, $fastOTP);
  $dbArray = $result->fetch_assoc();
  $dbOTP = $dbArray['sentOTP'];
  $expTime = $dbArray['expTime'];
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
  $checkSUID = "SELECT userID FROM user_noverify WHERE userID = '$userID'";
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
