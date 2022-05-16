<!DOCTYPE html>
<?php
$r1= rand(0,10);
$r2= rand(0,10);
$r3= rand(0,10);
$r4 = rand(0,10);
$randVersion ="$r1"."."."$r2"."."."$r3".".".$r4;  ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/root.css?id=<?php echo $randVersion; ?>">
    <link rel="stylesheet" href="assets/css/channels.css?id=<?php echo $randVersion; ?>">
    <title></title>
    <style media="screen">
    #channels{
      filter: var(--svgblue);
    }
    </style>
  </head>
  <body>
  <?php include 'components/header.php'; ?>
    <div class="authors cont500">
    </div>
  </body>
</html>
