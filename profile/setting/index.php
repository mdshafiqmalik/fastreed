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
