<?php session_start(); ?>
<!DOCTYPE html>
<?php include '../components/uniSession.php'; ?>

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
  <?php
  if (isset($_SESSION["userID"])) {
    header("Location: ../profile");
  }elseif(isset($_COOKIE["userID"])) {
    header("Location: ../profile");
  }else {
    header("Location: login");
  }
  ?>

  <script src="src/fun.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  <!-- <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $randVersion ?>" charset="utf-8"></script> -->
  </body>
</html>
