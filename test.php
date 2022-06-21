
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <?php
    $st = "wi3B8Tqssp76r/C/eSWL";

    include '_.config/sjdhfjsadkeys.php';
    $userID = openssl_decrypt($st, $ciphering,
    $encryption_key, $options, $encryption_iv);
    var_dump($userID);
    ?>
  </body>
</html>
