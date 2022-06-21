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
function checkOTP(){
  var enteredOTP = document.getElementById('OTPfield').value;
  var verifyButton = document.getElementById('verifyOTP');
  if (enteredOTP.length == 6) {
    verifyButton.style.background = "#000";
    verifyButton.removeAttribute("disabled");
  }else {
    verifyButton.style.background = "#aaa";
    const att = document.createAttribute("disabled");
    verifyButton.setAttributeNode(att);
  }
}

// function changeField() {
//   var EPField = document.getElementById('emailOrPassword');
//   var countryCode = document.getElementById('countryCode');
//   var x = EPField.value;
//   var regex=/^[0-9]+$/;
//   if (x.match(regex)) {
//     EPField.type = "number";
//     EPField.name = "phone";
//     countryCode.style.display ="flex";
//     EPField.style.justifyContent = "center";
//   }else {
//     EPField.type = "text";
//     EPField.name = "username";
//     countryCode.style.display ="none";
//     EPField.style.justifyContent = "flex-start";
//   }
// }
function hasWhiteSpace(data){
  return data.includes(' ');
}
function hasNumber(string){
  return /\d/.test(string);
}

function hasSpecialChars(str) {
  const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
  return specialChars.test(str);
}
function hasUpperandLowerCase(str){
  const upandlow = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/;
  return upandlow.test(str);
}
function hasUpperCase(str){
  return str.match(/^[A-Z]*$/);
}
function hasTwoWord(name) {
    var matches = name.match(/\b[^\d\s]+\b/g);
    if (matches && matches.length >= 2) {
        //two or more words
        return true;
    } else {
        //not enough words
        return false;
    }
}
