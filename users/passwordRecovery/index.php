<?php
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" ){
  if (isset($_GET['usernameOrEMail'])) {

    $UsernameOrEMail = $_GET['usernameOrEMail'];
    if (empty($UsernameOrEMail)||ctype_space($UsernameOrEMail)) {
      $message = '<span id="ULNS" style="color:red;" class="stat">Email can\'t be empty</span>';
    }else {
      $userExist = checkUser($UsernameOrEMail);
    }
  }
}

function checkUser($param){
  include '../../_.config/_s_db_.php';
  $UnameEmail = mysqli_real_escape_string($db,$param);
  $sql = "SELECT * FROM fast_users Where BINARY userName = '$UnameEmail' OR userEmail = '$UnameEmail' OR userPhone = '$UnameEmail'";
  $result = mysqli_query($db,$sql);
  if (mysqli_num_rows($result)) {
    $row = $result->fetch_assoc();

  }else {
    // code...
  }
}

$self = htmlspecialchars($_SERVER["PHP_SELF"]);
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
       <span id="signUp" >Reset Password</span>
       <form class="" action="<?php echo $self; ?>" method="get">
         <?php
         if (isset($message)) {
          echo $message;
         }
         ?>
         <div class="loginFields" id="emailField">
           <input id="emailOrPassword"type="text" onkeyup="" name="usernameOrEMail" value="" placeholder="Email Or Username">
         </div>
         <div class="loginSubmit">
           <input id="resendOTP" type="submit" name="" value="Reset Password">
         </div>
       </form>
     </div>
     </div>
   </body>
 </html>
