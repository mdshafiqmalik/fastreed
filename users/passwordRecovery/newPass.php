   <?php include '../../components/randVersion.php' ?>
<?php
$createPass = '
   <span id="signUp">Create New Password</span>
   <form class="" action="" method="post">
   <span id="NWP" class="stat"></span>
   <div class="loginFields">
     <input id="newPassword" onkeyup="checkFeild()" type="password" name="newPassword" value="" placeholder="Enter New Password">
   </div>
   <span id="CNFP" class="stat"></span>
   <div class="loginFields">
     <input id="confirmPassword" onkeyup="checkFeild()" type="password" name="confirmPassword" value="" placeholder="Confirm New Password">
     <span class="status" id="passwordEYE">
       <img onclick="change()" id="eyeClosed"src="../../assets/pics/svgs/eye_closed.svg" style="display:block;"alt="">
       <img onclick="change()" id="eyeOpened"src="../../assets/pics/svgs/eye_show.svg" style="display:none;"alt="">
     </span>
   </div>
   <div class="loginSubmit">
     <input id="submitPass" type="submit" name="" value="Reset Password">
   </div>
    </form>';
$notMatch = '
    <script type="text/javascript">
    document.getElementById("CNFP").innerHTML = "Password Not Matched";
    document.getElementById("CNFP").style.color = "red";
    </script>';
$shortLength = '
    <script type="text/javascript">
    document.getElementById("CNFP").innerHTML = "Min. Password Length is 8";
      document.getElementById("CNFP").style.color = "red";
    </script>';
$erro1 = '
    <script type="text/javascript">
    document.getElementById("message").innerHTML = "There is an Error at our end";
      document.getElementById("message").style.color = "red";
    </script>
';
$successReset = '
<span id="successMessage" >Password Reset Sucesssfully</span>
<br>
 <a style="text-decoration: none; font-weight: bold; padding: .3em .6em; border: 1px solid blue; border-radius: 5px;" href="../../login">Login</a>
</div>
</div>
';
var_dump($_SESSION['newPassID']);
if (isset($_SESSION['newPassID'])) {
  $userID = $_SESSION['newPassID'];
  if (checkUser($userID)) {
    $GLOBALS['content'] = $createPass.'
    </div>
    </div>';
  }else {
    unset($_SESSION['newPassID']);
    header('Location: index.php');
  }
}else {
  unset($_SESSION['newPassID']);
  header('Location: index.php');
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['newPassword']) &&  isset($_POST['confirmPassword'])) {
    if (!empty(isset($_POST['newPassword'])) && !empty(isset($_POST['confirmPassword']))) {
      $newPassword = sanitizeData($_POST['newPassword']);
      $confirmPassword = sanitizeData($_POST['confirmPassword']);
      $userID = $_SESSION['newPassID'];
      if (strLen($confirmPassword) > 8) {
        if ($newPassword == $confirmPassword) {
          $hashPassword =  password_hash($confirmPassword, PASSWORD_DEFAULT);
          include '../../_.config/_s_db_.php';
          $updatePassword = "UPDATE fast_users SET userHashPassword = '$hashPassword' WHERE userID = '$userID'";
          $result = mysqli_query($db, $updatePassword);
          if ($result) {
            delOTP($userID);
            unset($_SESSION['newPassID']);
            session_destroy();
            $GLOBALS['content'] = $successReset.'
      </div>
      </div>'. $erro1;
          }else {
            delOTP($userID);
            unset($_SESSION['newPassID']);
            session_destroy();
            $GLOBALS['content'] = $createPass.'
      </div>
      </div>'. $erro1;
          }
        }else {
          $GLOBALS['content'] = $createPass.'
    </div>
    </div>'. $notMatch;
        }
      }else {
        $GLOBALS['content'] = $createPass.'
    </div>
    </div>'. $shortLength;
      }
    }
  }
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">

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


     <script type="text/javascript">
     function change(){
       var closed = document.getElementById('eyeClosed').style.display;
       var opened = document.getElementById('eyeOpened').style.display;
       if (closed == 'block') {
         document.getElementById('eyeClosed').style.display = "none";
         document.getElementById('eyeOpened').style.display = "block";
         document.getElementById('confirmPassword').type = "text";
         document.getElementById('newPassword').type = "text";
       }else {
         document.getElementById('eyeOpened').style.display = "none";
         document.getElementById('eyeClosed').style.display = "block";
         document.getElementById('confirmPassword').type = "password";
         document.getElementById('newPassword').type = "password";
       }
     }
    function checkFeild(){
       var confPass =  document.getElementById('confirmPassword').value;
        var newPass =  document.getElementById('newPassword').value;
       var cnfP = document.getElementById('CNFP');
       var confPass;
       if (checkPass()) {
         if (confPass.length < 8) {
           cnfP.innerHTML = "Min. Password Length is 8";
           cnfP.style.color = "red";
           confPass = false;
         }else {
           if (newPass == confPass ) {
             cnfP.innerHTML = "Password Matched";
             cnfP.style.color = "green";
             confPass = true;
             submit.style.background = "#000";
             submit.removeAttribute("disabled");
           }else {
             cnfP.innerHTML = "Password Not Matched";
             cnfP.style.color = "red";
             confPass = false;
           }
         }
       }
       function checkPass(){
         var newPass =  document.getElementById('newPassword').value;
         var nwP =document.getElementById('NWP');
         var checkPass;
         if (newPass.length < 8) {
           nwP.innerHTML = "Min. Password Length is 8";
           nwP.style.color = "red";
           checkPass = false;
         }else {
           nwP.innerHTML = "Password Accepted";
           nwP.style.color = "green";
           checkPass = true;
         }
         return checkPass;
      }

   }
       var submit = document.getElementById('submitPass');
       submit.style.background = "#aaa";
     </script>
   </body>
 </html>
<?php
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
function sanitizeData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
