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

let userExist;
function checkUsername(){
  var userName = document.getElementById('username').value;
  var userStatus = document.getElementById('UNS');
  var haveSpace = hasWhiteSpace(userName);

  if (userName.length > 6) {
    if (haveSpace) {
      userExist = false;
      userStatus.innerHTML = "Spaces Not Allowed";
      userStatus.style.color =  "red";
    }else {
      var response = $.getJSON(`../../server/hidden/checkUNAME.php?username=${userName}`, function(data){
        if (data.Result) {
          userExist = false; //user exist
          // userStatus.style.display = "block";
          userStatus.innerHTML = "Username Taken";
          userStatus.style.color =  "red";
        }else {
          userExist = true; //user not exist
          // userStatus.style.display = "none";
          userStatus.innerHTML = "Username Available";
          userStatus.style.color =  "#20e120";
        }
      });


    }
  }else {
    userExist = false;
    userStatus.innerHTML = "6 Letters or More";
    userStatus.style.color =  "red";
  }
  return userExist
}



let isEmail;
function checkEmail(){
  var enteredEmail = document.getElementById('signUpEmail').value;
  var emailStat = document.getElementById('EMS');
  var re = /\S+@\S+\.\S+/;
  var isMail = re.test(enteredEmail);

  if (hasWhiteSpace(enteredEmail)) {
    emailStat.innerHTML = "Spaces Not Allowed";
    emailStat.style.color =  "red";
    isEmail = false;
  }else {
    if (isMail) {
        var response = $.getJSON(`../../server/hidden/checkUNAME.php?email=${enteredEmail}`, function(data){
          if (data.Result) {
            isEmail = false;
            emailStat.innerHTML = "Email Already Exist";
            emailStat.style.color =  "red";
          }else {
            isEmail = true;
            emailStat.innerHTML = "Valid Email";
            emailStat.style.color =  "#20e120";
          }
        });
    }else {
      emailStat.innerHTML = "Enter a Valid Email";
      emailStat.style.color =  "red";
      isEmail = false;
    }
  }
  return isEmail;
}

function checkPassword() {
  let i;
  let password =   document.getElementById('password');
  let pStat = document.getElementById('PMS');
  if (password.value.length > 8) {
    pStat.innerHTML = "Password Accepted";
    pStat.style.color =  "#20e120";
    i = true;
  }else {
    pStat.innerHTML = "Min 8 Letters"
    pStat.style.color= "red";
    i = false;
  }
  return i;
}
function isChecked(){
  let j;
  let checkBox = document.getElementById("checkBox");
  if (checkBox.checked == 1) {
   j = true;
  }else {
    j = false;
  }
  return j;
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
function checkButton(){
  if (checkUsername() && checkEmail() && checkPassword() && checkBox()) {
    var verifyButton = document.getElementById('verifyOTP');
    verifyButton.style.background = "#000";
    verifyButton.removeAttribute("disabled");
  }
}