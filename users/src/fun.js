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
    if (!haveSpace) {
      var response = $.getJSON(`../../server/hidden/checkUNAME.php?username=${userName}`, function(data){
        if (data.Result) {
          userExist = false; //user exist
          // userStatus.style.display = "block";
          userStatus.innerHTML = "Username Taken";
          userStatus.style.color =  "red";
        }else {
          userExist = true; //user not exist
          // userStatus.style.display = "none";
          userStatus.innerHTML = "Username Accepted";
          userStatus.style.color =  "#20e120";
        }
      });
    }else {
      userExist = false;
      // userStatus.style.display = "block";
      userStatus.innerHTML = "Spaces Not Allowed";
      userStatus.style.color =  "red";
    }
  }else {
    userExist = false;
    // userStatus.style.display = "block";
    userStatus.innerHTML = "6 Letters or More";
    userStatus.style.color =  "red";
  }
  return userExist
}

function hasWhiteSpace(userName){
  return userName.includes(' ');
}
let isEmail;
function checkEmail(){
  var enteredEmail = document.getElementById('signUpEmail').value;
  var emailStat = document.getElementById('EMS');
  var re = /\S+@\S+\.\S+/;
  var isMail = re.test(enteredEmail);
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
  return isEmail;
}

function  checkPassword() {
  let password =   document.getElementById('password');
  let pStat = document.getElementById('PMS');
  if (password.value.length > 8) {
    pStat.innerHTML = "Password Accepted";
    pStat.style.color =  "#20e120";
    let i = true;
  }else {
    pStat.innerHTML = "Min 8 Letters"
    pStat.style.color= "red";
    i = false;
  }
  return i;
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
