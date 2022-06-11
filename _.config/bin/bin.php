<meta charset="UTF-8">
<meta property="og:type" content="website" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="msapplication-tap-highlight" content="no">
<link href='./favicon.ico' rel='icon' sizes="32x32"  type='image/x-icon'/>
<link href='./favicon.ico' sizes="16x16" rel='icon' type='image/x-icon'/>
<link href='./favicon.ico' sizes="48x48"  rel='icon' type='shortcut icon'/>
<link rel='apple-touch-icon' sizes="180x180" type='apple-touch-icon image_src' href=''/>


$to = "mdshafiqmalik98@gmail.com";
$subject = "OTP Authenication";
$txt = "Now OTP is sent";
$headers = "From: support@earnmore.com" . "\r\n" .
"CC: admin@shafiqhub.com";
mail($to,$subject,$txt,$headers);


// }
// else{ // If User Entered Phone Number
//     $phone = $_POST['phone'];
//     $countryCode = $_POST['countryCode'];
//     if (empty($phone)||ctype_space($phone)) {
//         header("Location: /account/?message=Enter Username Or Phone"); // Check if Phone is empty
//     }else {
//       if (empty($password)||ctype_space($password)) { // Check if password is  empty
//         header("Location: /account/?message=Enter Password");
//       }else {
//
//         $sanPassword = sanitizeData($password);
//         $sanitizePhone = sanitizeData($phone);
//         $CCPhone = $countryCode.$sanitizePhone;
//         $myphone = mysqli_real_escape_string($db,$CCPhone);
//         $mypassword = mysqli_real_escape_string($db,$sanPassword);
//         $sql = "SELECT * FROM fast_users Where userPhone = '$myphone'";
//         $result = mysqli_query($db,$sql);
//         if (mysqli_num_rows($result)) {
//           $row = $result->fetch_assoc();
//           $userHashPassword = $row['userHashPassword'];
//           $isPasswordCorrect = password_verify($sanPassword, $userHashPassword);
//           if ($isPasswordCorrect) {
//             $_SESSION['userName'] = $myusername;
//             $_SESSION['userID'] = $row['userID'];
//             if (isset($_GET['redirect'])) {
//               $redirectLink = $_GET['redirect'];
//               header("Location: $redirectLink");
//             }else {
//               header("location: /account");
//             }
//           }else {
//             header("Location: /account/?message=Incorrect Password");
//           }
//         }else {
//           header("Location: /account/?message=Incorrect Phone");
//         }
//   }
// }
// }
// function mailOrPhone(){
//   if (isset($_POST['username'])) {
//     return "username";
//   }else {
//     return "phone";
//   }
// }
