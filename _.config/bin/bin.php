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
