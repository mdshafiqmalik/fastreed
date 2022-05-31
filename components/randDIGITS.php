<?php
function createOTP($keyLen){
  // Set a blank variable to store the key in
   $key = "";
   for ($x = 1; $x <= $keyLen; $x++) {
       // Set each digit
       $key .= random_int(0, 9);
   }
   return $key;
}
 ?>
