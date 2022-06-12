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
$2y$10$VDGTrlwPVjUGE1y/yHi/rOzCJgvLKpp15Dkz1e9xHNnYBinQ372ra

$2y$10$VDGTrlwPVjUGE1y/yHi/rOzCJgvLKpp15Dkz1e9xHNnYBinQ372ra
