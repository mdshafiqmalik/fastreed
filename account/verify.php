<?php
session_start();
    if (isset($_SESSION["OTPSTRING"])) {
      $otpSent = '
      <div id="userDiv" class="cont">
      <div class="content">
      <span id="signUp" >Verify Your OTP</span>
      <br>
      <form class="loginForm" action="verify.php" method="get">
      <div class="loginFields">
        <input id=""onkeyup="" type="email" name="email" value="" placeholder="Enter 6 Digit OTP">
      </div>
      <div class="loginSubmit">
        <input type="submit" name="" value="VERIFY">
      </div>
      </form>
      </div>
      ';
    }else {
      header("Location: /account/?errorMessage=Try Again");
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include '../components/randVersion.php' ?>
    <link rel="stylesheet" href="src/style.css?v=<?php echo($randVersion); ?>">
    <link rel="stylesheet" href="../assets/css/root.css?v=<?php echo($randVersion); ?>">
    <link rel="stylesheet" href="src/profile.css?v=<?php echo($randVersion); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
  <div class="navigation">
    <span> <a id="backArrow" href="/">&#171;  <span>Back</span></a> </span>
  </div>
<?php echo "$otpSent"; ?>

</div>
  <script src="src/fun.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  </body>
</html>
