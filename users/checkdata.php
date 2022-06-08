<?php
if (isset($_POST)) {
  $allInputSet = (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['fullName']) && isset($_POST['password']) && isset($_POST['checkbox']));
  if ($allInputSet) { // Check If all fields are filled
    // make varables of the field Values
    $emailAddress = $_POST['email'];
    $userName = $_POST['username'];
    $fullName = $_POST['fullName'];
    $passWord = $_POST['password'];
    $inputEmpty = (empty($emailAddress) && empty($userName) && empty($fullName) && empty($passWord));
    if (!$inputEmpty) { // Inputs are not empty

      // passwords
      $hashPassword =  password_hash($passWord, PASSWORD_DEFAULT);
      include '../_.config/sjdhfjsadkeys.php';
      $encPassword = openssl_encrypt($passWord, $ciphering,
      $encryption_key, $options, $encryption_iv);
      $minPasswordLenght = strLen($passWord) > 8;

      // Full name Validation
      $sanitizeFullName = sanitizeData($fullName);
      $fullNameLength = strLen($sanitizeFullName);
      $minFullNameLength = $fullNameLength > 8;
      $nameHasNumber = preg_match('/[0-9]/',$sanitizeFullName);
      $nameHasSpecialChar = preg_match('/[\'!`.~^$%&*()}{}@#-?><_,|=+]/', $sanitizeFullName);

      // Username Validation
      $sanitizedUserName = sanitizeData($userName);
      $userNameLength = strlen($sanitizedUserName);
      $minUserNameLen = $userNameLength > 8;
      $checkUserNameExists = checkUserNameExist($sanitizedUserName);
      $userNameValid = isValidUsername($sanitizedUserName);

      // Email Validation
      $sanitizedEmail = sanitizeData($emailAddress);
      $validEMail = filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);
      $checkEMailExists = checkEmailExist($validEMail);

      if (!$nameHasNumber || !$nameHasSpecialChar) {
        if ($minFullNameLength) {
          if ($minUserNameLen) {
            if ($userNameValid) {
              if (!$checkUserNameExists) {
                if (!$checkEMailExists) {
                  if ($minPasswordLenght) {

                    // create sessions
                    session_start();
                    $_SESSION['userName'] = $sanitizedUserName;
                    $_SESSION['userEmail'] = $sanitizedEmail;
                    $_SESSION['fullName'] = $sanitizeFullName;
                    $_SESSION['passWord'] = $hashPassword;
                    $_SESSION['encPassword'] = $encPassword;
                    header("Location: createUser.php");
                  }else {
                    header("Location: ../register/?errorMessage=Password Minimum Length is 8 letters&id=PMS");
                  }
                }else {
                  header("Location: ../register/?errorMessage=There is already have an account with this e-mail address&id=EMS");
                }
              }else {
                header("Location: ../register/?errorMessage=Username is Taken&id=UNS");
              }
            }else {
              header("Location: ../register/?errorMessage=Only Alphabets, No's and underscore(_) is allowed in Username&id=UNS");
            }
          }else {
            header("Location: ../register/?errorMessage=Username Minimum Length is 8 letters&id=UNS");
          }
        }else {
          header("Location: ../register/?errorMessage=Full Name Minimum Length is 8 letters&id=FNS");
        }
      }else {
        header("Location: ../register/?errorMessage=Number and Special Characters are not allowed&id=FNS");
      }

    }else {
      header("Location: ../register");
    }
  }else {
    header("Location: ../register");
  }
}else {
  header("Location: ../register");
}

// Validate Username
function isValidUsername($userName){
  $allowed  = array("_","-");
  if (ctype_alnum(str_replace($allowed, '', $userName))) {
    $isvalid = true;
  }else {
    $isvalid = false;
  }
  return $isvalid;
}

// check if username exist in Database
function checkUserNameExist($enterdUserName){
  include '../_.config/_s_db_.php';
  $link = new mysqli("$hostName","$userName","$passWord","$dbName");
  // check in verified users table
  $sqlV = "SELECT userName FROM fast_users WHERE userName = '$enterdUserName'";
  $resultV = mysqli_query($link, $sqlV);
  $userNameExistV = mysqli_num_rows($resultV);

  // check in non verified users mysql_list_tables
  $sqlN =  "SELECT userName FROM fast_noverify_users WHERE userName = '$enterdUserName'";
  $resultN = mysqli_query($link, $sqlN);
  $userNameExistN = mysqli_num_rows($resultN);

  // check if username exist in any tables
  if ($userNameExistV || $userNameExistN) {
    $unameExist = true;
  }else {
    $unameExist = false;
  }
  return $unameExist;
}

// Check if email exits
function checkEmailExist($emailInput){
  include '../_.config/_s_db_.php';
  $link = new mysqli("$hostName","$userName","$passWord","$dbName");
  // check in verified users table
  $sqlV = "SELECT userEmail FROM fast_users WHERE userEmail = '$emailInput'";
  $resultV = mysqli_query($link, $sqlV);
  $emailExistV = mysqli_num_rows($resultV);

  // check in non verified users mysql_list_tables
  $sqlN =  "SELECT userEmail FROM fast_noverify_users WHERE userEmail = '$emailInput'";
  $resultN = mysqli_query($link, $sqlN);
  $emailExistN = mysqli_num_rows($resultN);

  // check if username exist in any tables
  if ($emailExistV || $emailExistN) {
    $emailExist = true;
  }else {
    $emailExist = false;
  }
  return $emailExist;
}

// Sanitize Data
function sanitizeData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
