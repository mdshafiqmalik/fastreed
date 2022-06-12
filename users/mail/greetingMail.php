<?php
// Greeting Mail

function greetingMail($userFullNam, $userName, $userEmail){
  $message = '
  <html>
    <head>
    <title>Welcome '.$userFullNam.'</title>
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
        <p> Hi <b>'.$userFullNam.'</b> </p>
         <p> Thanks for joinig us you are now a part of a huge content community.Your account is all set and <b>verified now</b>.
           <br> You can login to your account using your <b>Username or Email</b> with password. <br><br>
           Username : <b>'.$userName.'</b><br>
           Email : <b>'.$userEmail.'</b><br>
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
  $subject = 'Welcome '.$userFullNam.'  to Fastreed';
  $headers = "From: Fastreed  <support@shafiqhub.com>" . "\r\n" ."CC: support@shafiqhub.com"."\r\n"."Content-type: text/html";
  $mailDeliverd =  mail($userEmail,$subject,$message,$headers);
  if ($mailDeliverd) {
    $mailStatus = true;
  }else {
    $mailStatus = false;
  }
  return $mailStatus;
}
 ?>
