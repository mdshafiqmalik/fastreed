<?php
include '../_.config/_s_db_.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $password = $_POST['password'];
  if (mailOrPhone() == "username") { // If User Entered Username
    $Username = $_POST['username'];
    if (empty($Username)||ctype_space($Username)) {
        header("Location: /account/?message=Enter Username Or Phone"); // Check if Username is empty
    }else {
      if (empty($password)||ctype_space($password)) { // Check if password is  empty
        header("Location: /account/?message=Enter Password");
      }else {
        $sanPassword = sanitizeData($password);
        $sanitizeUsername = sanitizeData($Username);
        $myusername = mysqli_real_escape_string($db,$sanitizeUsername);
        $mypassword = mysqli_real_escape_string($db,$sanPassword);
        $sql = "SELECT userHashPassword, userID FROM fast_users Where userName = '$myusername'";
        $result = mysqli_query($db,$sql);
        if (mysqli_num_rows($result)) {
          $row = $result->fetch_assoc();
          $userHashPassword = $row['userHashPassword'];
          $isPasswordCorrect = password_verify($sanPassword, $userHashPassword);
          if ($isPasswordCorrect) {                     // if password verified
            $_SESSION['userName'] = $myusername;
            $_SESSION['userID'] = $row['userID'];
            if (isset($_GET['redirect'])) {
              $redirectLink = $_GET['redirect'];
              header("Location: $redirectLink");
            }else {
              header("location: /account");
            }
          }else {
            header("Location: /account/?message=Password Incorrect");
          }
        }else {
          header("Location: /account/?message=Incorrect Username"); // Check if Phone is empty
        }
       }
    }
  }
}else{ // If User Entered Phone Number
    $phone = $_POST['phone'];
    $countryCode = $_POST['countryCode'];
    if (empty($phone)||ctype_space($phone)) {
        header("Location: /account/?message=Enter Username Or Phone"); // Check if Phone is empty
    }else {
      if (empty($password)||ctype_space($password)) { // Check if password is  empty
        header("Location: /account/?message=Enter Password");
      }else {

        $sanPassword = sanitizeData($password);
        $sanitizePhone = sanitizeData($phone);
        $CCPhone = $countryCode.$sanitizePhone;
        $myphone = mysqli_real_escape_string($db,$CCPhone);
        $mypassword = mysqli_real_escape_string($db,$sanPassword);
        $sql = "SELECT * FROM fast_users Where userPhone = '$myphone'";
        $result = mysqli_query($db,$sql);
        if (mysqli_num_rows($result)) {
          $row = $result->fetch_assoc();
          $userHashPassword = $row['userHashPassword'];
          $isPasswordCorrect = password_verify($sanPassword, $userHashPassword);
          if ($isPasswordCorrect) {
            $_SESSION['userName'] = $myusername;
            $_SESSION['userID'] = $row['userID'];
            if (isset($_GET['redirect'])) {
              $redirectLink = $_GET['redirect'];
              header("Location: $redirectLink");
            }else {
              header("location: /account");
            }
          }else {
            header("Location: /account/?message=Incorrect Password");
          }
        }else {
          header("Location: /account/?message=Incorrect Phone");
        }
  }
}
}

function mailOrPhone(){
  if (isset($_POST['username'])) {
    return "username";
  }else {
    return "phone";
  }
}
function sanitizeData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
