<?php
session_start();
include '../_.config/_s_db_.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $password = $_POST['password'];
    $UsernameOrEMail = $_POST['usernameOrEMail'];
    if (empty($UsernameOrEMail)||ctype_space($UsernameOrEMail)) {
        header("Location: login.php?message=Enter Username Or Email"); // Check if Username is empty
    }else {
      if (empty($password)||ctype_space($password)) { // Check if password is  empty
        header("Location: login.php?message=Enter Password");
      }else {
        $sanPassword = sanitizeData($password);
        $sanitizeUsername = sanitizeData($UsernameOrEMail);
        $usernameOrEMail = mysqli_real_escape_string($db,$sanitizeUsername);
        $mypassword = mysqli_real_escape_string($db,$sanPassword);
        $sql = "SELECT * FROM fast_users Where userName = '$usernameOrEMail' OR userEmail = '$usernameOrEMail' OR userPhone = '$usernameOrEMail'";
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
                 setcookie('userID', $encUID, time() + (86400 * 30), "/");
                 header("Location: profile");
             }else {
               $_SESSION["userID"] = $userID;
               header("Location: ../profile");
             }

           }else {
             $_SESSION["userID"] = $userID;
             header("Location: ../profile");
           }

          }else {
            header("Location: login.php?message=Incorrect Password");
          }
        }else {
          header("Location: login.php?message=Incorrect Username or Email"); // Check if email and username exist
        }
       }
    }
  }else {
    header("Location: login"); // Check if form is not submitted
  }

// }
// else{ // If User Entered Phone Number
//     $phone = $_POST['phone'];
//     $countryCode = $_POST['countryCode'];
//     if (empty($phone)||ctype_space($phone)) {
//         header("Location: /account/?message=Enter Username Or Phone"); // Check if Phone is empty
//     }else {
//       if (empty($password)||ctype_space($password)) { // Check if password is  empty
//         header("Location: /account/?message=Enter Password");
//       }else {
//
//         $sanPassword = sanitizeData($password);
//         $sanitizePhone = sanitizeData($phone);
//         $CCPhone = $countryCode.$sanitizePhone;
//         $myphone = mysqli_real_escape_string($db,$CCPhone);
//         $mypassword = mysqli_real_escape_string($db,$sanPassword);
//         $sql = "SELECT * FROM fast_users Where userPhone = '$myphone'";
//         $result = mysqli_query($db,$sql);
//         if (mysqli_num_rows($result)) {
//           $row = $result->fetch_assoc();
//           $userHashPassword = $row['userHashPassword'];
//           $isPasswordCorrect = password_verify($sanPassword, $userHashPassword);
//           if ($isPasswordCorrect) {
//             $_SESSION['userName'] = $myusername;
//             $_SESSION['userID'] = $row['userID'];
//             if (isset($_GET['redirect'])) {
//               $redirectLink = $_GET['redirect'];
//               header("Location: $redirectLink");
//             }else {
//               header("location: /account");
//             }
//           }else {
//             header("Location: /account/?message=Incorrect Password");
//           }
//         }else {
//           header("Location: /account/?message=Incorrect Phone");
//         }
//   }
// }
// }
// function mailOrPhone(){
//   if (isset($_POST['username'])) {
//     return "username";
//   }else {
//     return "phone";
//   }
// }

function sanitizeData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
