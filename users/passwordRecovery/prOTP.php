<?php
function resetMail($userID, $randOTP, $userEmail, $userFullName){

  include '../../_.config/sjdhfjsadkeys.php';
  $encID = openssl_encrypt($userID, $ciphering,
  $encryption_key, $options, $encryption_iv);

  $message ="
  <html>
    <head>
    <title>OTP Authenication</title>
    <style media='screen'>
      #link{
        text-align:center;
        margin: .8em 0em;
      }
      #link a{
        color: white;
        text-decoration:none;
        background-color: #0165E1;
        font-weight: bold;
        padding: .4em 1.5em;
        border-radius: 2px;
      }
      #message a:hover{
        background-color: #0072ff;
      }
      #OTP{
        text-align:center;
        margin: .8em 0em;
      }
      #OTP{
        font-size: 1.2em;
        padding: .4em 2em;
        background-color: #eee;
        font-weight:bold;
        letter-spacing: 3px;
      }
      #note{
        background-color: #eee;
        margin-top: 1em;
        padding: .4em;
      }
      #footer{
        padding: .4em;
        background-color: #dee;
      }
      #copy{
        margin-left: 5px;
        letter-spacing: 1px;
        font-size:.9em;
        color: red;
      }
      #message, #link a{
        font-size: 1.2em;
      }
      #cont{
        background-color: white;
        padding: .3em;
        max-width: 500px;
        border: .5px solid #eee;
        border-radius: 5px;
      }
    </style>
    </head>
    <body>
      <div id='cont'>
        <div id='message'>
            Dear <b>".$userFullName." </b><br><br>
            One Time Password(OTP) for password recovery is: <b>(valid for 10 minutes only)</b>
            <div id='OTP'>
              <span id='cpOTP'>".$randOTP." </span>
            </div>
            <div><center><b>OR</b></center> </div>
            <div>You can also reset your password by clicking on the link given
              <b>(valid for 10 minutes only)</b><br><br>
              <div id='link'>
                <a href='https://m.shafiqhub.com/users/passwordRecovery/newPass.php?recID=".$encID."&centpo=".$randOTP."&type=Link'> Reset Password Link</a>
              </div>
            </div><br>
        </div><hr>
        <footer id='footer'>
        This mail is sent to <b>".$userEmail." </b>and is intended for password recovery. <br><br>Kindly ignore if you haven't generated this OTP</b>
        </footer><br>
      </div>
    </body>
  </html>";

  $subject = $randOTP." is your OTP";
  $headers = "From: Fastreed Password Recovery <no-reply@shafiqhub.com>" . "\r\n" ."CC: support@shafiqhub.com"."\r\n"."Content-type: text/html";
  $mailDeliverd =  mail($userEmail,$subject,$message,$headers);
  if ($mailDeliverd) {
    $mailStatus = true;
  }else {
    $mailStatus = false;
  }
  return $mailStatus;
}
 ?>
