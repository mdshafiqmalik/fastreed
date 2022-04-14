function validateData(value, field){
  switch (field) {
    case "username":
    if (value.length<6) {
      return false;
    }else if (value.length>16) {
      return false;
    }else {
      return false;
    }
    break;


    case "email":
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value))
     {
     return true;
    }else {
     return false;
    }
     break;
    case "password":
    if (value.length>8) {
      return true;
      break;
    }else {
      return false;
      break;
    }
  }
}

// let parsed = response.json();

function getData(url, callback){
  var data = $.ajax({
    type: 'GET',
    url: url
  }).done(callback);
  return data;
}

getData('../hidden/', function(data) {
//  For Full Name
  $("#nmInput").keyup(isNameTrue);
  function isNameTrue(){
    let j;
    let inputValue = $("#nmInput").val();
    console.log();
    if ($("#nmInput").val()) {
      var words = countWords(inputValue);
      let numbPresent = ifNumber(inputValue);
      if (!numbPresent) {
       if (words>=2) {
         showSuccess("#nmAlert",'( Name Accepted &#10003; )');
         j = true;
       }else {
         showWarning("#nmAlert",'( Too Short e.g. John Doe )');
         j = false;
       }
      }else {
       showWarning("#nmAlert",'( Number not allowed &#x2716; )');
       j = false;
      }
    }else {
      showWarning("#nmAlert",'(Required )');
      j = false;
    }
      console.log(j);
    return j;
  }

//  for Username
  $("#unInput").keyup(isUsernameTrue);
  function isUsernameTrue(){
    let inputValue = $("#unInput").val();
    let j;
    if (inputValue) {
      let isDataValidated = validateData(inputValue, "username");
      console.log(isDataValidated);
      if (isDataValidated) {
        for (var i = 0; i < data.length; i++) {
          if (inputValue == data[i].fastUsername ) {
            showWarning("#unAlert",`( Username is already taken  &#x2716; )`);
            j = false;
          }else {
            showSuccess("#unAlert",`( Username is available &#10003; )`);
            j = true;
          }
        }
      }else {
        showWarning("#unAlert",'( Range 6 - 16 letters )',"" );
        j = false;
      }
    }
    else {
      showWarning("#unAlert",'( Required )',"" );
      j = false;
    }

    return j;
  }
// For Email
  $("#emInput").keyup(isEmailTrue);
  function isEmailTrue(){
   let toLow = $("#emInput").val();
   let inputValue = toLow.toLowerCase();
   let j;
   $("#emInput").val(inputValue);
   if ($("#emInput").val()) {
     let isDataValidated = validateData(inputValue, "email");

     if (isDataValidated) {
       for (var i = 0; i < data.length; i++) {
         if (inputValue == data[i].userEmail ) {
           showWarning("#emAlert",'( Already registered &#x2716; )');
           j = false;
         }else {
           showSuccess("#emAlert",'( E-mail Accepted &#10003; )');
           j = true;
         }
       }
     }else {
       showWarning("#emAlert",'( Invalid Email )');
       j = false;
     }
   }else {
     showWarning("#emAlert",'( Required )');
     j = false;
   }

   return j;
 }
// For password
  $("#psInput").keyup(isPasswordTrue);
  function isPasswordTrue(){
   let inputValue = $("#psInput").val();
   let i;
   if (inputValue) {
     let x = validateData(inputValue,"password");
     if (x) {
       let pc = passwordStrengthChecker(inputValue);
       switch (pc) {
         case "Weak":
         $("#psAlert").removeClass("medium");
         showWarning("#psAlert",'( Weak Password )');
         i = false;
           break;

         case "Strong":
         $("#psAlert").removeClass("medium");
         showSuccess("#psAlert",'( Strong Paswword &#10003; )');
         i = true;
           break;

         case "Medium":
         $("#psAlert").addClass("medium");
         showWarning("#psAlert",'( Medium Password &#10003; )');
         i = true;
           break;
       }

     }else{
       $("#psAlert").removeClass("medium");
      showWarning("#psAlert",'( Minimum Length 8 Letters )');
      i = false;
     }
   }else {
     $("#psAlert").removeClass("medium");
     showWarning("#psAlert",'( Required )');
     i = false;

   }

   return i;
 }
// For Confirm password
  $("#confirmPassInput").keyup(isConfirmPasswordTrue );
  function isConfirmPasswordTrue(){
    let cPassValue = $("#confirmPassInput").val();
    let passValue = $("#psInput").val();
    if (passValue) {
      if (passValue == cPassValue) {
         showSuccess("#confirmPassAlert",'( Password Matched &#10003; )');
         i = true;
      }else {
        showWarning("#confirmPassAlert",'( Password Not Match )');
        i = false;
      }
    }else {
      showWarning("#confirmPassAlert",'( Required )');
      i = false;
    }
   return i;
  }
 window.finalSubmit = function(){
    let i;
    if (isNameTrue()) {
      if (isUsernameTrue()) {
        if (isEmailTrue()) {
          if (isPasswordTrue()) {
            if (isConfirmPasswordTrue()) {
              i  = true;
            }else {
              isConfirmPasswordTrue();
              i = false;
            }
          }else {
            isPasswordTrue();
        i = false;
          }
        }else {
          isEmailTrue();
        i = false;
        }
      }else {

        isUsernameTrue();
        i = false;
      }
    }else {
      isNameTrue();
        i = false;
    }
    // console.log(i);
    return i;
  }
  // console.log("Name: ".isNameTrue());
  // console.log("Username: ".isUsernameTrue());
  // console.log("Email: ".isEmailTrue());
  // console.log("Password: ".isPasswordTrue());
  // console.log("Confirm Password: ".isConfirmPasswordTrue());
});
//  Ectra Functions
function passwordStrengthChecker(x){
  let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})');
  let mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))');
  let badge;
  if(strongPassword.test(x)) {
        badge = 'Strong';
    } else if(mediumPassword.test(x)) {
        badge = 'Medium';
    } else {
        badge = 'Weak';
    }
    return badge;
}
function ifNumber(val){
  return /\d/.test(val);
}
function countWords(x){
  let rmChar = x.replace(/[^A-Za-z]\s+/g);
  let nwWord = rmChar.trim().split(" ");
  return nwWord.length;
}
function showSuccess(id, message){
  $(id).html(message);
  $(id).addClass("success");
  $(id).removeClass("warning");
}
function showWarning(id, message){
  $(id).html(message);
  $(id).addClass("warning");
  $(id).removeClass("success");
}
