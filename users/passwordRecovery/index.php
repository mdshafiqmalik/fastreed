<?php
include '../../components/randVersion.php';
/*
if (postSet) {
  if (emailOrUsernameGiven) {
    if (checkUser) {
      if (updateOTP) {
        if (sendOTP) {
          // Enter OTP Sent to email
          //  Make form with Get
        }else {
          // Enter email/username
          // Cannot Send OTP
        }
      }else {
        // Enter email/username
        // Server Error
      }
    }else {
      // Enter email/username
      // User Not Found
    }
  }elseif (PasswordandConfirmPassword) {
    // code...
  }else {
    // Enter email/username
  }
}elseif (GETSet) {
  if (userID && OTP) {
    if (!empty(userID && OTP)) {
      // OTP Form
      if (OTPauth) {
        if (!isOTPExpires) {
          // create random session
        }else {
          // Enter OTP Sent to email
          // Expired OTP
          // Resend OTP
        }
      }else {
        // Enter OTP Sent to email
        // Wrong OTP
        // Resend OTP
      }
    }else {
      // Enter email/username
    }
  }else {
    // Enter email/username
  }
}else {
  // Enter email/username
}
*/
$GLOBALS['self'] = htmlspecialchars($_SERVER["PHP_SELF"]);
$top = '<span id="signUp" >Reset Password</span>';
$intent = '<span id="successMessage">Enter Username or Email to Rcover Password</span>';
$template = '
    <form class="" action="'.$GLOBALS['self'].'" method="post">';
$template2 = '
        <div class="loginFields" id="emailField">
         <input id="emailOrPassword"type="text" onkeyup="" name="usernameOrEMail" value="" placeholder="Email Or Username">
        </div>
        <div class="loginSubmit">
         <input id="resendOTP" type="submit" name="" value="Reset Password">
        </div>
   </form>';


$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" ){
  if (isset($_POST['usernameOrEMail'])) {
    $UsernameOrEMail = $_POST['usernameOrEMail'];
    if (empty($UsernameOrEMail)||ctype_space($UsernameOrEMail)) {
      $GLOBALS['content'] = $template.$intent.$template2;
    }else {
      $userExist = checkUser($UsernameOrEMail);
      if ((boolean)$userExist) {
        $userID = $userExist['userID'];
        $userEmail = $userExist['userEmail'];
        $randOTP = "";
        for ($i=0; $i < 6 ; $i++) {
          // Set each digit
          $randOTP .= random_int(0, 9);
        }
        $sentTime  = time()+600;
        if (addOTP($userID, $randOTP,$userEmail,$sentTime)) {
          // code...
        }else {
          $message = '
          <span id="ULNS" style="color:red;" class="stat">Cannot verify at this moment</span>';
          $GLOBALS['content'] = $top.$template.$message.$template2;
        }
      }else {
        $message = '
        <span id="ULNS" style="color:red;" class="stat">No user found with this email/username</span><br>
        <span id="ULNS" style="font-weight: 10;" class="stat"><b>Tip:</b> Don\'t use autofill</span>';
        $GLOBALS['content'] = $top.$template.$message.$template2;
      }
    }
  }else {
    $GLOBALS['content'] = $top.$intent.$template.$template2;
  }
}else {
  $GLOBALS['content'] =  $top.$intent.$template.$template2;
}

function checkUser($param){
  include '../../_.config/_s_db_.php';
  $UnameEmail = mysqli_real_escape_string($db,$param);
  $sql = "SELECT * FROM fast_users Where BINARY userName = '$param' OR userEmail = '$UnameEmail' OR userPhone = '$UnameEmail'";
  $result = mysqli_query($db,$sql);
  if (mysqli_num_rows($result)) {
    $row = $result->fetch_assoc();
    $userExist = $row;
  }else {
    $userExist = false;
  }
  return $userExist;
}

$self = htmlspecialchars($_SERVER["PHP_SELF"]);

// Add OTP to Database
function addOTP($userID, $randOTP,$email,$sentTime){
  include '../../_.config/_s_db_.php';
  $checkOTP = "SELECT userID FROM fast_otp Where emailAddress = '$email'";
  $res = mysqli_query($db, $checkOTP);
  if ($res) {
    $delRecord = "DELETE FROM fast_otp Where emailAddress= '$email' AND otpIntent ='RP'";
    mysqli_query($db, $delRecord);
  }
  $sentDateTime = date('y-m-d H:i:s');
  $addOTP = "INSERT INTO `fast_otp` (`userID`, `sentOTP`, `emailAddress`,`expTime`,`totalOTP`, `sentDateTime`, `otpIntent`) VALUES ('$userID', '$randOTP','$email','$sentTime', '1', '$sentDateTime', 'RP')";
  $result = mysqli_query($db, $addOTP);
  if ($result) {
    $OTPadded = true;
  }else {
    $OTPadded = false;
  }
  return $OTPadded;
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
   </body>
 </html>
