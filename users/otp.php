<?php

// Send OTP
function sendOTP($userEmail, $userID, $randOTP, $userFullName){
  $user = "user";
  $message = "
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
            One Time Password(OTP) for account verification is: <b>(valid for 10 minutes only)</b>
            <div id='OTP'>
              <span id='cpOTP'>".$randOTP." </span>
            </div>
            <div><center><b>OR</b></center> </div>
            <div>You can verify your account by clicking on the link given
              <b>(valid for 10 minutes only)</b><br><br>
              <div id='link'>
                <a href='https://m.shafiqhub.com/users/verify.php?suid=".$userID ."&centpo=".$randOTP."'> Verify Account</a>
              </div>
            </div><br>
        </div><hr>
        <div>You can create your channel and publish your content. To know more about us please have a visit at our website:
        </div><br>
        <div id='link'><a href='https://m.shafiqhub.com/'> Website Link</a>
        </div><br>
        <footer id='footer'>
        This mail is sent to <b>".$userEmail." </b>and is intended for account verification of <b>".$userFullName."</b>. <br><br>Kindly ignore if you don't know about this.</b>
        </footer><br>
      </div>
    </body>
  </html>";

  $subject = $randOTP." is your OTP";
  $headers = "From: Fastreed OTP Authentication <no-reply@shafiqhub.com>" . "\r\n" ."CC: support@shafiqhub.com"."\r\n"."Content-type: text/html";
  $mailDeliverd =  mail($userEmail,$subject,$message,$headers);
  if ($mailDeliverd) {
    $mailStatus = true;
  }else {
    $mailStatus = false;
  }
  return $mailStatus;
}



function greeetingMail($userFullName, $userName, $userEmail, ){
  $message = '
  <html>
    <head>
    <title>Welcome '.$userFullName.'</title>
    <style media="screen">
      #cont{
        background-color: white;
        padding: .5em  .2em;
        max-width: 500px;
        border: .5px solid #eee;
        border-radius: 5px;
        font-size: 1.2em;
      }
      #link{
        text-align: center;
      }
      #link a{
        padding: .3em .5em;
        background-color: #0165E1;
        text-decoration: none;
        color: white;
        font-weight: bold;
        border-radius: 5px;
      }
      #link a:hover{
          background-color: #0072ff;
      }
    </style>
    </head>
    <body>
      <div id="cont">
        <p> Hi <b>'.$userFullName.'</b> </p>
         <p> Thanks for joinig us you are now a part of a huge content community.Your account is all set and <b>verified now</b>.
           <br> You can login to your account using your <b>Username or Email</b> with password. <br><br>
           Username : <b>'.$userName.'</b><br>
           Email : <b>'.$userEmail.'@gmail.com</b><br>
         </p>
         <p>  <b>Note: </b>Please keep all your login details personal. </p><br>
         <hr>
         <center> <h2>One More Step</h2> </center>
         <p>We have to collect a bit more information of you to provide you better content.<br>
            Please go and login to your account with given details and complete your profile.</p><br>
         <div id="link">
           <a href="https://m.shafiqhub.com/login">Log In</a>
         </div>
      </div>
    </body>
  </html>
  ';
  $subject = 'Welcome '.$userFullName.' to Fastreed';
  $headers = "From: Welcome To Fastreed <support@shafiqhub.com>" . "\r\n" ."CC: support@shafiqhub.com"."\r\n"."Content-type: text/html";
  $mailDeliverd =  mail($userEmail,$subject,$message,$headers);
  if ($mailDeliverd) {
    $mailStatus = true;
  }else {
    $mailStatus = false;
  }
  return $mailStatus;
}
 ?>
