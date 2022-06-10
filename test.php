<html>
<head>
<title>OTP Authenication</title>
<style media='screen'>
  #message{
    font-size: 1.2em;
  }
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
  #OTP p{
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
    margin:
  }
  body{
    display: flex;
    justify-content:  center;
    align-items: center;
    background-color: #eee;
  }
  #cont{
    background-color: white;
    padding: .3em;
  }
</style>
</head>
<body>
<div id='cont'style='max-width: 500px'>
<div id='message'>
Dear <b>".$userFullName." </b><br><br>
One Time Password(OTP) for account verification is: <b>(valid for 10 minutes only)</b>
<div id='OTP'><p>".$randOTP." <span id ='copy'>copy</span> </p></div>
<div>Or you can verify your account by clicking on the link given  <b>(valid for 10 minutes only)</b>
<div id='link'><a href='https://m.shafiqhub.com/users/verify.php?suid=".$suid ."&centpo=".$randOTP."'> Verify Account</a></div>
</div>
<br>
<footer id='footer'>
This mail is sent to <b>".$userEmail." </b>and is intended for account verification of <b>".$userFullName."</b>. <br>Kindly ignore if you don't know about this.</b>
</footer>
<br>
<hr>
<div><center>You can create an account with us by clicking on link given below</center></div>
<div id='link'><a href='https://m.shafiqhub.com/register'> Sign Up With Fastreed</a></div>
</div>
</div>
</body>
</html>
