<?php
$self = htmlspecialchars($_SERVER["PHP_SELF"]);
$top = '<span id="signUp" >Recover Password</span>';
$intent = '<span id="successMessage" style="color: black;">Enter Username or Email to Recover Password</span>';
$template = '
    <form class="" action="'.$self.'" method="post">';
$template2 = '
        <div class="loginFields" id="emailField">
         <input id="emailOrPassword"type="text" onkeyup="" name="usernameOrEMail" value="" placeholder="Email Or Username">
        </div>
        <div class="loginSubmit">
         <input id="resendOTP" type="submit" name="" value="Reset Password">
        </div>
   </form>';

$verifyOTP1 = '
<form class="" action="'.$self.'" method="get">
<div class="loginFields">
<input type="hidden" name="type" value="OTP">
<input type="hidden" name="recID" value="';

$verifyOTP2='"><input id="OTPfield" onkeyup="checkOTP()" type="number" minlength="6" maxlength="6" name="centpo" value="" placeholder="000000">
</div>
<div class="loginSubmit">
<input id="verifyOTP" type="submit" name="" value="VERIFY">
</div>
</form>';
$resendOTP1 = '
<form class="loginForm" action="'.$self.'" method="POST">
<input type="hidden" name="resendID" value="';
$resendOTP2 = '">
<div class="loginSubmit">
  <input id="resendOTP" type="submit" name="" value="Resend OTP">
</div>
</form>';
$historyReplace = '<script>
 if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
   }
</script>';


//When user entered username or email
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" ){
  if (isset($_POST['usernameOrEMail'])) {
    $UsernameOrEMail = $_POST['usernameOrEMail'];
    if (empty($UsernameOrEMail)||ctype_space($UsernameOrEMail)) {
      $GLOBALS['content'] = $top.$intent.$template.$template2;
    }else {
      $userExist = findUser($UsernameOrEMail);
      if ((boolean)$userExist) {
        $userID = $userExist['userID'];
        $refUserID = $userID*2536;
        $userEmail = $userExist['userEmail'];
        $userNam = $userExist['userName'];
        $userFullName = $userExist['userFullName'];
        $randOTP = "";
        for ($i=0; $i < 6 ; $i++) {
          // Set each digit
          $randOTP .= random_int(0, 9);
        }
        $sentTime  = time()+600;
        if (addOTP($userID, $randOTP,$userEmail,$sentTime)) {
          include 'prOTP.php';
          if (resetMail($refUserID, $randOTP, $userEmail, $userNam)) { // passRecMail($userID, $randOTP, $userEmail, $userName)
            $message = '<span id="successMessage" >Enter OTP sent to email linked with your account</span>';
            $GLOBALS['content'] = $top.$message.$verifyOTP1.$refUserID.$verifyOTP2.$resendOTP1.$refUserID.$resendOTP2.$historyReplace;
          }else {
            $message = '<span id="errorMessage" >Unable to send OTP to the email linked with your account</span>';
            $GLOBALS['content'] = '<br>'.$message.$resendOTP1.$refUserID.$resendOTP2.$historyReplace;
          }
        }else {
          $message = '
          <span id="ULNS" style="color:red;" class="stat">Cannot verify at this moment</span>';
          $GLOBALS['content'] = $top.$template.$message.$template2;
        }
      }else {
        $message = '
        <span id="ULNS" style="color:red;" class="stat">No user found with this e-mail or Username</span><br>
        <span id="ULNS" style="font-weight: 10;" class="stat"><b>Tip: Don\'t use autofill</b></span>';
        $GLOBALS['content'] = $top.$template.$message.$template2;
      }
    }
    // when user resends otp
  }elseif (isset($_POST['resendID'])) {
    $resendID = $_POST['resendID'];
    $refID = $resendID*2536;
    if (!empty($resendID)) { //
      if (updateOTP($resendID)) {
        $message = '<span id="successMessage" >Another OTP sent to email linked with your account</span>';
        $GLOBALS['content'] = $top.$message.$verifyOTP1.$refID.$verifyOTP2.$resendOTP1.$refID.$resendOTP2.$historyReplace;
      }else {
        $message = '<span id="errorMessage" >Cannot Send New OTP</span>';
        $GLOBALS['content'] = $top.$message.$verifyOTP1.$refID.$verifyOTP2.$resendOTP1.$refID.$resendOTP2.$historyReplace;
      }
    }else {
      $message = '<span id="errorMessage" >Cannot Send New OTP</span>';
      $GLOBALS['content'] = $message.$verifyOTP1.$refID.$verifyOTP2.$resendOTP1.$refID.$resendOTP2.$historyReplace;
    }
  }else {
    $GLOBALS['content'] = $top.$intent.$template.$template2;
  }
}
// When user verify OTP
elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['type'])) {
    if ($_GET['type'] == 'Link') {
      $type = 'Link';
    }else {
      $type = 'OTP';
    }
  }else {
    $type = 'OTP';
  }

  if (isset($_GET['recID']) && isset($_GET['centpo'])) {
    $refUID=  $_GET['recID'];
    $uid = $_GET['recID']/2536;
    $otp = $_GET['centpo'];
    if (checkUser($uid)) {
      if (authenticateOTP($uid, $otp)) {
        if (!isExpired($uid)) {
          session_start();
          $_SESSION['newID'] = $uid;
          header('Location: newPass.php?recID='.$refUID);
        }else {
          $message =  '<span id="errorMessage" >Entered '.$type.' Expired Resend Another</span></center>';
          $GLOBALS['content'] = $top.$message.$resendOTP1.$refUID.$resendOTP2.$historyReplace;
        }
      }else {
        $message =  '<span id="errorMessage" >Invalid '.$type.' Entered</span></center>';
        $GLOBALS['content'] = $top.$message.$verifyOTP1.$refUID.$verifyOTP2.$resendOTP1.$refUID.$resendOTP2.$historyReplace;
      }
    }else {
      $message = '<span id="errorMessage" >'.$type.' already Used<br>Or May Not Exist</span>';
      $GLOBALS['content'] =  $top.$message.$template.$template2;
    }
  }else {
    $GLOBALS['content'] =  $top.$intent.$template.$template2;
  }
}else {
  $GLOBALS['content'] =  $top.$intent.$template.$template2;
}
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
   <?php include '../../components/randVersion.php' ?>
   <link rel="stylesheet" href="../src/style.css?v=<?php echo $_SESSION['randVersion']; ?>">
   <link rel="stylesheet" href="../../assets/css/root.css?v=<?php echo $_SESSION['randVersion']; ?>">
   <link rel="stylesheet" href="../src/profile.css?v=<?php echo $_SESSION['randVersion']; ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title></title>
 </head>
   <body>
     <div class="navigation">
       <span> <a id="backArrow" href="../../login">&#171;  <span>Back</span></a> </span>
     </div>
     <div id="userDiv" class="cont">
     <div class="content">
        <?php
        if (isset($GLOBALS['content'])) {
          echo $GLOBALS['content'];
        }
         ?>

     </div>
     </div>
     <script src="../src/fun.js?v=<?php echo $_SESSION['randVersion']; ?>" charset="utf-8"></script>
   </body>
 </html>


<?php
function updateOTP($suid){
  $expTime = time()+600;
  $randOTP = "";
  for ($x = 1; $x <= 6; $x++) {
      // Set each digit
      $randOTP .= random_int(0, 9);
  }
  include '../../_.config/_s_db_.php';
  // $totalOTP = "SELECT * FROM fast_otp WHERE userID = '$suid' AND otpIntent ='PR'";
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
  $upOTPandTime = "UPDATE fast_otp SET sentOTP = '$randOTP', expTime = '$expTime' , sentDateTime = '$sentDateTime' WHERE userID = '$suid' AND otpIntent ='PR'";
  $result1 = mysqli_query($db, $upOTPandTime);
  if ($result1) {
    $getEmailandFullName = "SELECT userEmail, userFullName FROM user_cred WHERE userID ='$suid'";
    $result2 = mysqli_query($db, $getEmailandFullName);
    if ($result2) {
      $arrayDat = $result2->fetch_assoc();
      $userFullName = $arrayDat['userFullName'];
      $userEmail = $arrayDat['userEmail'];
      include 'prOTP.php';
      if (resetMail($suid, $randOTP, $userEmail, $userFullName)) { //passRecMail($userID, $randOTP, $userEmail, $userName)
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

// Add OTP to Database
function addOTP($userID, $randOTP,$email,$sentTime){
  include '../../_.config/_s_db_.php';
  $checkOTP = "SELECT userID FROM fast_otp Where emailAddress = '$email'";
  $res = mysqli_query($db, $checkOTP);
  if ($res) {
    $delRecord = "DELETE FROM fast_otp Where emailAddress= '$email' AND otpIntent ='PR'";
    mysqli_query($db, $delRecord);
  }
  $sentDateTime = date('y-m-d H:i:s');
  $addOTP = "INSERT INTO `fast_otp` (`userID`, `sentOTP`, `emailAddress`,`expTime`,`totalOTP`, `sentDateTime`, `otpIntent`) VALUES ('$userID', '$randOTP','$email','$sentTime', '1', '$sentDateTime', 'PR')";
  $result = mysqli_query($db, $addOTP);
  if ($result) {
    $OTPadded = true;
  }else {
    $OTPadded = false;
  }
  return $OTPadded;
}
function isExpired($uid){
  include '../../_.config/_s_db_.php';
  $sentOTP = "SELECT * FROM fast_otp WHERE userID = '$uid' AND otpIntent = 'PR'";
  $result = mysqli_query($db, $sentOTP);
  $expTime = $result->fetch_assoc();
  $eTime = $expTime['expTime'];
  if (time() > $eTime) {
    $OTPEXP = true;
  }else {
    $OTPEXP = false;
  }
  return $OTPEXP;
}
// Delete OTP Data
function delOTP($userID){
  include '../../_.config/_s_db_.php';
  $sql = "DELETE FROM fast_otp WHERE userID = '$userID' AND otpIntent ='PR'";
  if(mysqli_query($db, $sql)){
    $otpDeleted = true;
  }else {
    $otpDeleted = false;;
  }
  return $otpDeleted;
}
function checkUser($param){
  include '../../_.config/_s_db_.php';
  $UnameEmail = mysqli_real_escape_string($db,$param);
  $sql = "SELECT * FROM fast_otp WHERE userID = '$param' AND otpIntent='PR'";
  $result = mysqli_query($db,$sql);
  if (mysqli_num_rows($result)) {
    $row = $result->fetch_assoc();
    $userExist = $row;
  }else {
    $userExist = false;
  }
  return $userExist;
}

function findUser($param){
  include '../../_.config/_s_db_.php';
  $UnameEmail = mysqli_real_escape_string($db,$param);
  $sql = "SELECT * FROM fast_users WHERE userName = '$UnameEmail' OR userEmail ='$UnameEmail' OR userPhone='$UnameEmail'";
  $result = mysqli_query($db,$sql);
  if (mysqli_num_rows($result)) {
    $row = $result->fetch_assoc();
    $userExist = $row;
  }else {
    $userExist = false;
  }
  return $userExist;
}


function authenticateOTP($userID, $OTP){
  include '../../_.config/_s_db_.php';
  $fastOTP = "SELECT * FROM fast_otp WHERE userID = '$userID' AND otpIntent = 'PR'";
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
 ?>
