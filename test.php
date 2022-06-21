
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <?php
    $st = "wCHA8T2ns573rvi3eS+M";

    include '_.config/sjdhfjsadkeys.php';
    $userID = openssl_decrypt($st, $ciphering,
    $encryption_key, $options, $encryption_iv);
    var_dump($userID);
    ?>
  </body>
</html>
