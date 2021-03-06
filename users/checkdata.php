<?php
if (isset($_POST)) {
  $allInputSet = (isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['fullName']) && isset($_POST['password']) && isset($_POST['checkbox']));
  if ($allInputSet) { // Check If all fields are filled
    // make varables of the field Values
    $emailAddress = $_POST['email'];
    $gender = $_POST['gender'];
    $userName = $_POST['username'];
    $fullName = $_POST['fullName'];
    $passWord = $_POST['password'];
    $inputEmpty = (empty($gender) && empty($emailAddress) && empty($userName) && empty($fullName) && empty($passWord));
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
      $minFullNameLength = $fullNameLength > 6;
      $nameHasNumber = preg_match('/[0-9]/',$sanitizeFullName);
      $nameHasSpecialChar = preg_match('/[\'!`.~^$%&*()}{}@#-?><_,|=+]/', $sanitizeFullName);

      // Username Validation
      $sanitizedUserName = sanitizeData($userName);
      $userNameLength = strlen($sanitizedUserName);
      $minUserNameLen = $userNameLength > 6;
      $checkUserNameExists = checkUserNameExist($sanitizedUserName);
      $userNameValid = isValidUsername($sanitizedUserName);

      // Email Validation
      $sanitizedEmail = sanitizeData($emailAddress);
      $validEMail = filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);
      $checkEMailExists = checkEmailExist($validEMail);

      // Check Gender Exist

      if (!$nameHasNumber || !$nameHasSpecialChar) {
        if ($minFullNameLength) {
          if ($minUserNameLen) {
            if ($userNameValid) {
              if (!$checkUserNameExists) {
                if (!$checkEMailExists) {
                  if ($minPasswordLenght) {
                    if ($gender != '0') {
                      // create sessions
                      session_start();
                      $_SESSION['userName'] = $sanitizedUserName;
                      $_SESSION['userEmail'] = $sanitizedEmail;
                      $_SESSION['fullName'] = $sanitizeFullName;
                      $_SESSION['passWord'] = $hashPassword;
                      $_SESSION['encPassword'] = $encPassword;
                      $_SESSION['gender'] = $gender;
                      header("Location: createUser.php");
                    }else {
                      header("Location: ../register/?errorMessage=Select Gender&id=GNS");
                    }
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
            header("Location: ../register/?errorMessage=Username Minimum Length is 6&id=UNS");
          }
        }else {
          header("Location: ../register/?errorMessage=Full Name Minimum Length is 6 letters&id=FNS");
        }
      }else {
        header("Location: ../register/?errorMessage=Number and Special Characters are not allowed&id=FNS");
      }

    }else {
      header("Location: ../register?error=01");
    }
  }else {
    header("Location: ../register?error=02");
  }
}else {
  header("Location: ../register?error=03");
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
  // check in verified users table
  $sql = "SELECT userName FROM fast_users WHERE userName = '$enterdUserName'";
  $result = mysqli_query($db, $sql);
  $userNameExist = mysqli_num_rows($result);

  // check if username exist in any tables
  if ($userNameExist) {
    $unameExist = true;
  }else {
    $unameExist = false;
  }
  return $unameExist;
}

// Check if email exits
function checkEmailExist($emailInput){
  include '../_.config/_s_db_.php';
  // check in verified users table
  $sql = "SELECT userEmail FROM fast_users WHERE userEmail = '$emailInput'";
  $result = mysqli_query($db, $sql);
  $emailExist= mysqli_num_rows($result);

  // check if username exist in any tables
  if ($emailExist) {
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
