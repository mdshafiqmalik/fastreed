function checkDate(){
  var date = document.getElementById('date');
  console.log(date);
}
function checkedItems(checkbox){
  var parent = checkbox.parentElement;
  if (checkbox.checked == true) {
    parent.style.background = "#0165E1";
    parent.style.color = "White";

  }else {
    parent.style.background = "white";
    parent.style.color = "black";
  }
}
