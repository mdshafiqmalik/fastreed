<?php session_start();
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
       <img width="25px" height="25px onclick="change()" id="eyeClosed" src="../../assets/pics/svgs/eye_closed.svg" style="display:block;"alt="">
       <img width="25px" height="25px onclick="change()" id="eyeOpened" src="../../assets/pics/svgs/eye_show.svg" style="display:none;"alt="">
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



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['newPassword']) &&  isset($_POST['confirmPassword'])) {
    if (!empty(isset($_POST['newPassword'])) && !empty(isset($_POST['confirmPassword']))) {
      $newPassword = $_POST['newPassword'];
      $confirmPassword = $_POST['confirmPassword'];
      $userID = $_SESSION['newID'];
      if (strLen($confirmPassword) > 8) {
        if ($newPassword == $confirmPassword) {
          $hashPassword =  password_hash($confirmPassword, PASSWORD_DEFAULT);
          include '../../_.config/_s_db_.php';
          $updatePassword = "UPDATE fast_users SET userHashPassword = '$hashPassword' WHERE userID = '$userID'";
          $result = mysqli_query($db, $updatePassword);
          if ($result) {
            delOTP($userID);
            $GLOBALS['content'] = $successReset.'
      </div>
      </div>';
          session_destroy();
          }else {
            delOTP($userID);

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
}elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['recID'])) {
    if (!empty($_GET['recID'])) {
      $encID = $_GET['recID'];
      $decID = $encID/2536;

      if (checkUser($decID)) {
        $GLOBALS['content'] = $createPass.'
        </div>
        </div>';
      }else {
        header('Location: index.php?error=UNF');
      }
    }else {
      header('Location: index.php?error=GTIDE');
    }
  }else {
    header('Location: index.php?error=RIDNF');
  }
}else {
  header('Location: index.php?error=GTNF');
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



 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
    <?php include '../../components/randVersion.php' ?>
   <link rel="stylesheet" href="../src/style.css?v=<?php echo $randVersion; ?>">
   <link rel="stylesheet" href="../../assets/css/root.css?v=<?php echo $randVersion; ?>">
   <link rel="stylesheet" href="../src/profile.css?v=<?php echo $randVersion; ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title></title>
 </head>
   <body>
     <div class="navigation">
       <span> <a id="backArrow" href="index.php">&#171;  <span>Back</span></a> </span>
     </div>
     <div id="userDiv" class="cont">
     <div class="content">

        <?php
        if (isset($GLOBALS['content'])) {
          echo $GLOBALS['content'];
        }
         ?>
     <script src="fun.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
   </body>
 </html>
