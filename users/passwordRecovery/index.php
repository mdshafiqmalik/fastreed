<?php
$GLOBALS['self'] = htmlspecialchars($_SERVER["PHP_SELF"]);
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" ){
  if (isset($_GET['usernameOrEMail'])) {
    $UsernameOrEMail = $_GET['usernameOrEMail'];
    if (empty($UsernameOrEMail)||ctype_space($UsernameOrEMail)) {
      $message = '<span id="ULNS" style="color:red;" class="stat">Email can\'t be empty</span>';
      $GLOBALS['content'] = '
      <span id="signUp" >Reset Password</span>
      <form class="" action="'.$GLOBALS['self'].'" method="get">
      '.$message.'
         <div class="loginFields" id="emailField">
           <input id="emailOrPassword"type="text" onkeyup="" name="usernameOrEMail" value="" placeholder="Email Or Username">
         </div>
         <div class="loginSubmit">
           <input id="resendOTP" type="submit" name="" value="Reset Password">
         </div>
       </form>';
    }else {
      $userExist = checkUser($UsernameOrEMail);
      if ((boolean)$userExist) {
        $userID = $userExist['userID'];
        $userEmail = $userExist['userEmail'];
        addOTP($userID)
        sendOTP($userID)
        // $GLOBALS['content'] = '
        // <span id="signUp" >Verify Your OTP</span>
        // <form class="loginForm" action="'.$self.'" method="get">
        // <div class="loginFields">
        //   <input id="OTPfield" onkeyup="checkOTP()" type="number" name="centpo" value="" placeholder="000000">
        // </div>
        // <div class="loginSubmit">
        //   <input id="verifyOTP" type="submit" name="" value="VERIFY">
        // </div>
        // </form>
        // <br>
        // <form class="loginForm" action="'.$self.'" method="post">
        //   <input type="hidden" name="suid" value="'.$userID.'" placeholder="">
        //   <input type="hidden" name="resendOTP" value="true" placeholder="">
        // <div class="loginSubmit">
        //   <input id="resendOTP" type="submit" name="" value="Resend OTP">
        // </div>
        // </form>';
      }else {
        $message = '<span id="ULNS" style="color:red;" class="stat">No user found with this email/username</span><br>
        <span id="ULNS" style="font-weight: 10;" class="stat"><b>Tip:</b> Don\'t use autofill</span>';
        $GLOBALS['content'] = '
        <span id="signUp" >Reset Password</span>
        <form class="" action="'.$GLOBALS['self'].'" method="get">
        '.$message.'
           <div class="loginFields" id="emailField">
             <input id="emailOrPassword"type="text" onkeyup="" name="usernameOrEMail" value="" placeholder="Email Or Username">
           </div>
           <div class="loginSubmit">
             <input id="resendOTP" type="submit" name="" value="Reset Password">
           </div>
         </form>
        ';
      }
    }
  }else {
    $GLOBALS['content'] = '
    <span id="signUp" >Reset Password</span>
    <form class="" action="'.$GLOBALS['self'].'" method="get">
    '.$message.'
       <div class="loginFields" id="emailField">
         <input id="emailOrPassword"type="text" onkeyup="" name="usernameOrEMail" value="" placeholder="Email Or Username">
       </div>
       <div class="loginSubmit">
         <input id="resendOTP" type="submit" name="" value="Reset Password">
       </div>
     </form>';
  }
}else {
  $GLOBALS['content'] = '
  <span id="signUp" >Reset Password</span>
  <form class="" action="'.$GLOBALS['self'].'" method="get">
  '.$message.'
     <div class="loginFields" id="emailField">
       <input id="emailOrPassword"type="text" onkeyup="" name="usernameOrEMail" value="" placeholder="Email Or Username">
     </div>
     <div class="loginSubmit">
       <input id="resendOTP" type="submit" name="" value="Reset Password">
     </div>
   </form>';
}

function checkUser($param){
  include '../../_.config/_s_db_.php';
  $UnameEmail = mysqli_real_escape_string($db,$param);
  $sql = "SELECT * FROM fast_users Where BINARY userName = '$param' OR userEmail = '$UnameEmail' OR userPhone = '$UnameEmail'";
  $result = mysqli_query($db,$sql);
  if (mysqli_num_rows($result)) {
    $row = $result->fetch_assoc();
    $userID = $row['userID'];
    $userExist = $row;
  }else {
    $userExist = false;
  }
  return $userExist;
}

$self = htmlspecialchars($_SERVER["PHP_SELF"]);

// add OTP to Database
function addOTP($link,$newUserID, $randOTP,$email,$sentTime){
  $checkOTP = "SELECT userID FROM fast_otp Where emailAddress = '$email'";
  $res = mysqli_query($link, $checkOTP);
  if ($res) {
    $delRecord = "DELETE FROM fast_otp Where emailAddress= '$email' AND optIntentb ='RP'";
    mysqli_query($link, $delRecord);
  }
  $sentDateTime = date('y-m-d H:i:s');
  $addOTP = "INSERT INTO `fast_otp` (`userID`, `sentOTP`, `emailAddress`,`expTime`,`totalOTP`, `sentDateTime`, `otpIntent`) VALUES ('$newUserID', '$randOTP','$email','$sentTime', '1', '$sentDateTime', 'RP')";
  $result = mysqli_query($link, $addOTP);
  if ($result) {
    $OTPadded = true;
  }else {
    $OTPadded = false;
  }
  return $OTPadded;
}


// Send OTP to email
function sendOTP($userFullName, $email, $suid, $randOTP){
 include '../_.config/sjdhfjsadkeys.php';
 $message = "
 <html>
 <head>
 <title>OTP Authenication</title>
 <style media='screen'>
   #message{
     font-size: 1.2em;
   }
   #link{
     text-align:center;
     margin: .8em 0em;
   }
   #link a{
     color: white;
     text-decoration:none;
     background-color: #0165E1;
     font-weight: bold;
     padding: .4em 1.5em;
     border-radius: 2px;
   }
   #message a:hover{
     background-color: #0072ff;
   }
   #OTP{
     text-align:center;
     margin: .8em 0em;
   }
   #OTP p{
     font-size: 1.2em;
     padding: .4em 2em;
     background-color: #eee;
     font-weight:bold;
     letter-spacing: 3px;
   }
   #note{
     background-color: #eee;
     margin-top: 1em;
     padding: .4em;
   }
 </style>
 </head>
 <body><div id='message'>
 Dear <b>".$userFullName." </b><br><br>
 One Time Password(OTP) for Password Recovery is: <b>(valid for 10 minutes only)</b>
 <div id='OTP'><p>".$randOTP."</p></div>
 <div>Or you can verify your account by clicking on the link given  <b>(valid for 10 minutes only)</b>
 <div id='link'><a href='https://m.shafiqhub.com/passwordRecovery/?uid=".$uid ."&pastpo=".$randOTP."'> Reset Password</a></div>
 <div id='note'><b>Note:</b> Kindly ignore this e-mail if you don't know about it.</div>
 </div>
 </body>
 </html>";
 $subject = $randOTP." is Your OTP";
 $headers = "From: Fastreed OTP Authentication <no-reply@shafiqhub.com>" . "\r\n" ."CC: support@shafiqhub.com"."\r\n"."Content-type: text/html";
 $mailDeliverd =  mail($email,$subject,$message,$headers);
 if ($mailDeliverd) {
   $mailStatus = true;
 }else {
   $mailStatus = false;
 }
 return $mailStatus;
}

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
   <?php include '../../components/randVersion.php' ?>
   <link rel="stylesheet" href="../src/style.css?v=<?php echo($randVersion); ?>">
   <link rel="stylesheet" href="../../assets/css/root.css?v=<?php echo($randVersion); ?>">
   <link rel="stylesheet" href="../src/profile.css?v=<?php echo($randVersion); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title></title>
 </head>
   <body>
     <div class="navigation">
       <span> <a id="backArrow" href="../">&#171;  <span>Back</span></a> </span>
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
