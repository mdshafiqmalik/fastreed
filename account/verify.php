<?php
$errorMessage = "Please enter a valid email address";
if (isset($_GET['email'])) {
  $email = $_GET['email'];
  if (filter_var("$email", FILTER_VALIDATE_EMAIL)) {
    echo "$email";
  }else {
    header("Location: /account?errorMessage=$errorMessage");
  }
}else {
  header("Location: /account?errorMessage=$errorMessage");
}
 ?>
