<?php
include '../components/randVersion.php';
$VYO = '<span id="signUp" >Verify Your OTP</span>';
$self = htmlspecialchars($_SERVER["PHP_SELF"]);
$formHead = '<form class="loginForm" action="'.$self.'" method="get">
<div class="loginFields">
  <input type="hidden" name="_secRandID" value="';

$formTop = '" placeholder="">
<input id="OTPfield" onkeyup="checkOTP()" type="number" minlength="6" maxlength="6" name="centpo" value="" placeholder="000000">
</div>
<div class="loginSubmit">
<input id="verifyOTP" type="submit" name="" value="VERIFY">
</div>
</form>
<br>
<form class="loginForm" action="'.$self.'" method="post">
<input type="hidden" name="_secRandID" value="';

$formBottom =   '" placeholder="">
  <input type="hidden" name="resendOTP" value="true" placeholder="">
<div class="loginSubmit">
  <input id="resendOTP" type="submit" name="" value="Resend OTP">
</div>
</form>';

$historyReplace = '<script>
 if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
   }
</script>';
if (isset($_GET['_secRandID'])) {

  include '../_.config/sjdhfjsadkeys.php';
  $decUID = openssl_decrypt($_GET['_secRandID'], $ciphering,
  $decryption_key, $options, $decryption_iv);
  // Check suid present or not
  var_dump($decUID);
  $userID = $decUID;
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
                $getUserDetail = "SELECT * FROM fast_users WHERE userID = '$uID'";
                $userDetail = mysqli_query($db, $getUserDetail);
                $userDetailArray = $userDetail->fetch_assoc();
                $userName = $userDetailArray['userName'];
                $userEmail = $userDetailArray['userEmail'];

                $getFullName = "SELECT * FROM user_cred WHERE userID = '$uID'";
                $userFullN = mysqli_query($db, $getFullName);
                $userFullName = $userFullN->fetch_assoc();
                $UFN = $userFullName['userFullName'];

                include 'mail/greetingMail.php';
                greetingMail($UFN, $userName, $userEmail);
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
          $GLOBALS['body']  =  '
          <span id="errorMessage">Entered link or OTP Expired and Now Deleted</span>
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
        $message = '<span id="errorMessage">Wrong OTP entered</span>';
        $GLOBALS['body']  =  $VYO.$message.$formHead.$userID.$formTop.$userID.$formBottom;
      }
    }else {
      $message = '<span id="successMessage">We have sent a 6 digit OTP to your email</span>';
      $GLOBALS['body']  =  $VYO.$message.$formHead.$userID.$formTop.$userID.$formBottom.$historyReplace;
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
  $paramSet = isset($_POST['_secRandID']) && isset($_POST['resendOTP']);
  if ($paramSet) {

    include '../_.config/sjdhfjsadkeys.php';
    $userID = openssl_decrypt($_POST['_secRandID'], $ciphering,
    $encryption_key, $options, $encryption_iv);

    if (checkUserID($userID)) {
      if(updateOTP($userID)){
        $message = '<span id="successMessage">We have <i>Resent a 6 digit OTP</i> to your email</span>';

        $GLOBALS['body']  =  $VYO.$message.$formHead.$userID.$formTop.$userID.$formBottom .$historyReplace;
      }else {
        $message = '<span style="color:orange;" id="errorMessage">Failed to resend OTP again</span>';
        $GLOBALS['body']  =  $VYO.$message.$formHead.$userID.$formTop.$userID.$formBottom;
      }
    }else {
      $GLOBALS['body']  =  '<script type="text/javascript">
        document.location = "../register?errorMessage=000X3&id=FNS";
      </script>';
    }
  }else {
    $GLOBALS['body']  =  '<script type="text/javascript">
      document.location = "../register?errorMessage=?errorMessage=000X4&id=FNS";
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
    <link rel="stylesheet" href="src/style.css?v=<?php echo $_SESSION['randVersion']; ?>">
    <link rel="stylesheet" href="../assets/css/root.css?v=<?php echo $_SESSION['randVersion']; ?>">
    <link rel="stylesheet" href="src/profile.css?v=<?php echo $_SESSION['randVersion']; ?>">
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
  <script src="src/fun.js?v=<?php echo $_SESSION['randVersion'] ?>" charset="utf-8"></script>
  <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $_SESSION['randVersion'] ?>" charset="utf-8"></script>
  </body>
</html>




<?php

// Move User Data from no Verify to verified users
function verifyUser($userID){
  include '../_.config/_s_db_.php';
  $sql = "SELECT * FROM user_noverify WHERE userID = '$userID'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    $data = $result->fetch_assoc();
    $userID = $data['userID'];
    $fullName = $data['userFullName'];
    $userName = $data['userName'];
    $userEmail = $data['userEmail'];
    $userHashPassword = $data['userHashPassword'];
    $ePassword = $data['ePassword'];
    $userJoiningDate = date('y-m-d H:i:s');
    $profilePic = '0';
    // add to fast_users
    $insertData =  "INSERT INTO `fast_users` (`userID`, `userEmail`, `userName`, `userPhone`, `userHashPassword`) VALUES ('$userID', '$userEmail', '$userName','', '$userHashPassword')";

    // add to uers_crendentials
    $inUserCred =  "INSERT INTO `user_cred` (`userID`, `userFullName`, `userDOB`, `userEmail`, `userProfilePic`, `userGender`, `userJoiningDate`, `userCountry`, `userType`) VALUES ('$userID', '$fullName','','$userEmail','$profilePic','', '$userJoiningDate','','0')";

    // add to user_sec
    $inUserSec = "INSERT INTO `user_sec` (`userID`,`ePassword`) VALUES ('$userID', '$ePassword')";

    // add to user_verify
    $inUserverify = "INSERT INTO `user_verify` (`userID`,`emailVerify`, `phoneVerify`,`IDVerify`,`greenTickVerified`) VALUES ('$userID', '1', '0', '0', '0')";

    $r1 = mysqli_query($db, $insertData);
    $r2 = mysqli_query($db, $inUserCred);
    $r3 = mysqli_query($db, $inUserSec);
    $r4 = mysqli_query($db, $inUserverify);
    if ($r1 && $r2 && $r3 && $r4) {
      $delNoVerify ="DELETE FROM user_noverify WHERE userID = '$userID'";
      $r5 = mysqli_query($db, $delNoVerify);
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
 // $totalOTP = "SELECT * FROM fast_otp WHERE userID = '$suid' AND optIntent ='AV'";
 // $result0 = mysqli_query($db, $totalOTP);
 // if (mysqli_num_rows($result0)) {
 //   $arrayD = $result0->fetch_assoc();
 //   $tOTP = $arrayD['totalOTP'];
 //   $tOTP = intval($tOTP);
 //   $tOTP +=1;
 // }else {
 //   $tOTP = 1;
 // }
 $sentDateTime = date('y-m-d H:i:s');
 $upOTPandTime = "UPDATE fast_otp SET sentOTP = '$randOTP', expTime = '$expTime' , sentDateTime = '$sentDateTime' WHERE userID = '$suid' AND otpIntent ='AV'";
 $result1 = mysqli_query($db, $upOTPandTime);
 if ($result1) {
   $getEmailandFullName = "SELECT userEmail, userFullName FROM user_noverify WHERE userID ='$suid'";
   $result2 = mysqli_query($db, $getEmailandFullName);
   if ($result2) {
     $arrayDat = $result2->fetch_assoc();
     $userFullName = $arrayDat['userFullName'];
     $userEmail = $arrayDat['userEmail'];
     include 'mail/avOTP.php';
     if (sendOTP($userEmail, $suid, $randOTP, $userFullName)) { //sendOTP($userEmail, $suid, $randOTP, $userFullName)
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
  $sentOTP = "SELECT * FROM fast_otp WHERE userID = '$userID' AND otpIntent = 'AV'";
  $result = mysqli_query($db, $sentOTP);
  $expTime = $result->fetch_assoc();
  $eTime = $expTime['expTime'];
  if (time() > $eTime) {
    $OTPEXP = true;
    delOTP($userID);
  }else {
    $OTPEXP = false;
  }
  return $OTPEXP;
}

// Delete OTP Data
function delOTP($userID){
  include '../_.config/_s_db_.php';
  $sql = "DELETE FROM fast_otp WHERE userID = '$userID' AND otpIntent ='AV'";
  if(mysqli_query($db, $sql)){
    $otpDeleted = true;
  }else {
    $otpDeleted = false;;
  }
  return $otpDeleted;
}
function authenticateOTP($userID, $OTP){
  include '../_.config/_s_db_.php';
  $fastOTP = "SELECT * FROM fast_otp WHERE userID = '$userID' AND otpIntent = 'AV'";
  $result = mysqli_query($db, $fastOTP);
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
  $checkSUID = "SELECT userID FROM user_noverify WHERE userID = '$userID'";
  $result = mysqli_query($db, $checkSUID);
  $isUserID = mysqli_num_rows($result);
  if ($isUserID) {
    $userIDPresent = true;
  }else {
    $userIDPresent = false;
  }
  return $userIDPresent;
}
?>
