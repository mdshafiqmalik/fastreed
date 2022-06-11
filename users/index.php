<?php include '../components/randVersion.php'; ?>
<!DOCTYPE html>
<?php include '../components/uniSession.php'; ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include '../components/randVersion.php' ?>
    <link rel="stylesheet" href="src/style.css?v=<?php echo $_SESSION['randVersion']; ?>">
    <link rel="stylesheet" href="../assets/css/root.css?v=<?php echo $_SESSION['randVersion']; ?>">
    <link rel="stylesheet" href="src/profile.css?v=<?php echo $_SESSION['randVersion']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
  <div class="navigation">
    <span> <a id="backArrow" href="/">&#171;  <span>Back</span></a> </span>
  </div>
  <?php
  if (isset($_SESSION["userID"])) {
    echo '<script type="text/javascript">
      document.location = "../profile";
    </script>';
  }elseif(isset($_COOKIE["userID"])) {
    echo '<script type="text/javascript">
      document.location = "../profile";
    </script>';
  }else {
    echo '<script type="text/javascript">
      document.location = "../login";
    </script>';
  }
  ?>

  <script src="src/fun.js?v=<?php echo $_SESSION['randVersion'] ?>" charset="utf-8"></script>
  <!-- <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $_SESSION['randVersion'] ?>" charset="utf-8"></script> -->
  </body>
</html>
