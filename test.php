<?php
include '_.config/sjdhfjsadkeys.php';
$newID = openssl_encrypt('256738965268752', $ciphering,
$encryption_key, $options, $encryption_iv);

echo $newID;
echo "<br><br>";

$decID = openssl_decrypt($newID, $ciphering,
$encryption_key, $options, $encryption_iv);

echo $decID;

?>
