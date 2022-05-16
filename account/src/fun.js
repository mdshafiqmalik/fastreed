function change(){
  var closed = document.getElementById('eyeClosed').style.display;
  var opened = document.getElementById('eyeOpened').style.display;
  if (closed == 'block') {
    document.getElementById('eyeClosed').style.display = "none";
    document.getElementById('eyeOpened').style.display = "block";
    document.getElementById('password').type = "text";
  }else {
    document.getElementById('eyeOpened').style.display = "none";
    document.getElementById('eyeClosed').style.display = "block";
    document.getElementById('password').type = "password";
  }
}

function changeField() {
  var EPField = document.getElementById('emailOrPassword');
  var countryCode = document.getElementById('countryCode');
  var x = EPField.value;
  var regex=/^[0-9]+$/;
  if (x.match(regex)) {
    EPField.type = "number";
    EPField.name = "phone";
    countryCode.style.display ="flex";
    EPField.style.justifyContent = "center";
  }else {
    EPField.type = "text";
    EPField.name = "username";
    countryCode.style.display ="none";
    EPField.style.justifyContent = "flex-start";
  }
}
