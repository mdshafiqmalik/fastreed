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
    #copy:hover{
      cursor: pointer;
    }
    #message, #link{
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
            <code id='cpOTP'>".$randOTP."
            </code><button id ='copy' onclick='CopyToClipboard('cpOTP')' >copy</button>
          </div>
          <div>Or you can verify your account by clicking on the link given
            <b>(valid for 10 minutes only)</b>
            <div id='link'>
              <a href='https://m.shafiqhub.com/users/verify.php?suid=".$suid ."&centpo=".$randOTP."'> Verify Account</a>
            </div>
          </div><br>
      </div>
      <footer id='footer'>
      This mail is sent to <b>".$userEmail." </b>and is intended for account verification of <b>".$userFullName."</b>. <br>Kindly ignore if you don't know about this.</b>
      </footer><br><hr>
      <div>You can create an account with us by clicking on link given below
      </div>
      <br>
      <div id='link'><a href='https://m.shafiqhub.com/register'> Sign Up With Fastreed</a>
      </div>
    </div>
    <script type='text/javascript'>
    function CopyToClipboard(id)
    {
    var r = document.createRange();
    r.selectNode(document.getElementById(id));
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(r);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
    let cp = document.getElementById('copy');
    cp.innerHTML = 'copied';
    cp.style.color= 'orange';
    }

    </script>
  </body>
</html>
