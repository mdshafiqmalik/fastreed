function checkDate(){
  var date = document.getElementById('date');
  console.log(date);
}
function checkedItems(checkbox){
  var parent = checkbox.parentElement;
  if (checkbox.checked == true) {
    parent.style.background = "#0165E1";
    parent.style.color = "White";
    parent.style.border = "1px solid #0165E1";

  }else {
    parent.style.background = "white";
    parent.style.color = "#555";
    parent.style.border = " 1px solid #aaa";
  }
}
