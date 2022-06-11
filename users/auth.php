<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $UsernameOrEMail = $_POST['usernameOrEMail'];
    if (empty($UsernameOrEMail)||ctype_space($UsernameOrEMail)) {
        header("Location: ../login/?message=Enter Username Or Email"); // Check if Username is empty
    }else {
      if (empty($password)||ctype_space($password)) { // Check if password is  empty
        header("Location: ../login/?message=Enter Password");
      }else {
        include '../_.config/_s_db_.php';
        $sanPassword = sanitizeData($password);
        $sanitizeUsername = sanitizeData($UsernameOrEMail);
        $usernameOrEMail = mysqli_real_escape_string($db,$sanitizeUsername);
        $mypassword = mysqli_real_escape_string($db,$sanPassword);
        $sql = "SELECT * FROM fast_users Where BINARY userName = '$usernameOrEMail' OR userEmail = '$usernameOrEMail' OR userPhone = '$usernameOrEMail'";
        $result = mysqli_query($db,$sql);
        if (mysqli_num_rows($result)) {
          $row = $result->fetch_assoc();
          $userHashPassword = $row['userHashPassword'];
          $isPasswordCorrect = password_verify($sanPassword, $userHashPassword);
          if ($isPasswordCorrect) {  // Check if password correct
            $userID = $row['userID'];
           if (isset($_POST['rememberMe'])) { // check if checkbox is set
             if ((boolean) $_POST['rememberMe']) { // check if checkbox is checked
                 include '../_.config/sjdhfjsadkeys.php';
                 $encUID = openssl_encrypt($userID, $ciphering,
                 $encryption_key, $options, $encryption_iv);
                 setcookie('uisnnue', $encUID, time() + (86400 * 30), "/");
                 header("Location: ../profile?eikooCtes=true");
             }else {
               $_SESSION["uisnnue"] = $userID;
               header("Location: ../profile/?eikooCtes");
             }

           }else {
             $_SESSION["uisnnue"] = $userID;
             header("Location: ../profile/?eikooCtes");
           }

          }else {
            header("Location: ../login/?message=Incorrect Password");
          }
        }else {
          header("Location: ../login/?message=Incorrect Username or Email"); // Check if email and username exist
        }
       }
    }
  }else {
    header("Location: ../login/"); // Check if form is not submitted
  }
function sanitizeData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
