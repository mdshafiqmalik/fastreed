<?php
session_start();


function checkLogDetails($logID){
  include '../../_.config/_s_db_.php';
  $checkLoginID = "SELECT userID FROM fast_logged_users Where loginID = '$logID' AND status = '1'";
  $userDat = mysqli_query($db, $checkLoginID);
  if (mysqli_num_rows($userDat)) {
      $row = $userDat->fetch_assoc();
      $exist = $row['userID'];
  }else {
    setcookie('logID', '', time() -3600, "/");
    unset($_SESSION['logID']);
    $exist = false;
  }
  return $exist;
}


if (isset($_SESSION['logID'])) {
  $checkLogin = checkLogDetails($_SESSION['logID']);
  if ($checkLogin) {
    // code...
  }else {
  header('Location: ../../login');
  }
}else {
  header('Location:  ../../login');
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <head>
      <meta charset="utf-8">
      <?php include '../../components/randVersion.php' ?>
      <link rel="stylesheet" href="../../users/src/style.css?v=<?php echo $randVersion; ?>">
      <link rel="stylesheet" href="../../assets/css/root.css?v=<?php echo $randVersion; ?>">
      <link rel="stylesheet" href="../../users/src/profile.css?v=<?php echo $randVersion; ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <div class="navigation">
      <span> <a id="backArrow" href="<?php
       if (isset($_SERVER['HTTP_REFERER'])) {
          $back = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
          $backPath = trim($back,'/');
          $backPath = ucfirst($backPath);
          if ($backPath == "") {
            $backPath = "Home";
          }
        }else {
          $back = '../';
        }
        echo $back; ?>">&#171;  <span> <?php echo $backPath ?> </span></a> </span>  </div>
        <div id="userDiv" class="cont">
        <div class="content">
        </div>
      </div>
  </body>
</html>
