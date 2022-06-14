<?php
session_start();

if (isset($_POST['redirect'])) {
  $redirect = $_POST['redirect'];
}else {
  $redirect = '../profile';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $password = $_POST['password'];
  $UsernameOrEMail = $_POST['usernameOrEMail'];
  // Check if Username is empty
  if (!empty($UsernameOrEMail)||!ctype_space($UsernameOrEMail)){
    if (!empty($password)||!ctype_space($password)){
      // Username Or Email Authentication/User Exist Or Not
      include '../_.config/_s_db_.php';
      $sanPassword = sanitizeData($password);
      $sanitizeUsername = sanitizeData($UsernameOrEMail);
      $usernameOrEMail = mysqli_real_escape_string($db,$sanitizeUsername);
      $mypassword = mysqli_real_escape_string($db,$sanPassword);
      $sql = "SELECT * FROM fast_users Where BINARY userName = '$usernameOrEMail' OR userEmail = '$usernameOrEMail' OR userPhone = '$usernameOrEMail'";
      $result = mysqli_query($db,$sql);
      // Check if user exist
      if (mysqli_num_rows($result)) {
        // Password Verification
        $row = $result->fetch_assoc();
        $userHashPassword = $row['userHashPassword'];
        $userID = $row['userID'];
        $isPasswordCorrect = password_verify($sanPassword, $userHashPassword);
        if ($isPasswordCorrect) {
          if ($logId = createLogin($userID)) {
            if (isset($_POST['rememberMe'])) {
              if ((boolean) $_POST['rememberMe']) {
                include '../_.config/sjdhfjsadkeys.php';
                $encUID = openssl_encrypt($logId, $ciphering,
                $encryption_key, $options, $encryption_iv);
                setcookie('logID', $encUID, time() + (86400 * 30), "/");
                $_SESSION['logID'] = $logId;
                header("Location:".$redirect);
              }else {
                // Set Session
                // Continue redirect without cookie set
                $_SESSION['logID'] = $logId;
                header("Location:".$redirect);
              }
            }else {
              // Set Session
              // Continue redierct without cookie set
              $_SESSION['logID'] = $logId;
              header("Location:".$redirect);
            }
          }else {
            header("Location: ../login/?message=Cannot login at the moment");
          }
        }else {
          // Password is Incorrect (Go to Login)
          header("Location: ../login/?message=Incorrect Password");
        }
      }else {
        // User Not Exist with this email or username
        // Go to login
        header("Location: ../login/?message=No Account Found");
      }
    }else {
      header("Location: ../login/?message=Enter Password");
    }
  }else {
    header("Location: ../login/?message=Enter Username Or Email");
  }
}else {
  header("Location: ../login/");
}

function sanitizeData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Create login Data
function createLogin($userID){
  $randLogID = random_str(32);
  $logDate = date('y-m-d H:i:s');
  $getDeviceInfo = $_SERVER['HTTP_USER_AGENT'];
  include '../_.config/_s_db_.php';
  $sql = "INSERT INTO fast_logged_users (`loginID`,`userID`,`loginDateTime`,`loginDevice`, `status`) VALUES ('$randLogID','$userID','$logDate','$getDeviceInfo', '1')";
  $result = mysqli_query($db, $sql);
  if ($result) {
    $loginCreated = $randLogID;
  }else {
    $loginCreated = false;
  }
  return $loginCreated;
}

function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
 ?>
