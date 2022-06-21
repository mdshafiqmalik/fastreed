function change(){
  var closed = document.getElementById('eyeClosed').style.display;
  var opened = document.getElementById('eyeOpened').style.display;
  if (closed == 'block') {
    document.getElementById('eyeClosed').style.display = "none";
    document.getElementById('eyeOpened').style.display = "block";
    document.getElementById('newPassword').type = "text";
    document.getElementById('confirmPassword').type = "text";
  }else {
    document.getElementById('eyeOpened').style.display = "none";
    document.getElementById('eyeClosed').style.display = "block";
    document.getElementById('newPassword').type = "password";
    document.getElementById('confirmPassword').type = "password";
  }
}


function checkFeild(){
   var confPass =  document.getElementById('confirmPassword').value;
    var newPass =  document.getElementById('newPassword').value;
   var cnfP = document.getElementById('CNFP');
   var confPass;
   if (checkPass()) {
     if (confPass.length < 8) {
       cnfP.innerHTML = "Min. Password Length is 8";
       cnfP.style.color = "red";
       confPass = false;
     }else {
       if (newPass == confPass ) {
         cnfP.innerHTML = "Password Matched";
         cnfP.style.color = "green";
         confPass = true;
         submit.style.background = "#000";
         submit.removeAttribute("disabled");
       }else {
         cnfP.innerHTML = "Password Not Matched";
         cnfP.style.color = "red";
         confPass = false;
       }
     }
   }
   function checkPass(){
     var newPass =  document.getElementById('newPassword').value;
     var nwP =document.getElementById('NWP');
     var checkPass;
     if (newPass.length < 8) {
       nwP.innerHTML = "Min. Password Length is 8";
       nwP.style.color = "red";
       checkPass = false;
     }else {
       nwP.innerHTML = "Password Accepted";
       nwP.style.color = "green";
       checkPass = true;
     }
     return checkPass;
  }

}
   var submit = document.getElementById('submitPass');
   submit.style.background = "#aaa";
