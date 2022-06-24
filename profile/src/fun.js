function checkDate(){
  var date = document.getElementById('date');
  console.log(date);
}
function checkedItems(checkbox){
  var parent = checkbox.parentElement.parentElement;
  if (checkbox.checked == true) {
    parent.style.background = "#0165E1";
    parent.style.color = "White";
    parent.style.border = "1px solid #0165E1";
    parent.firstElementChild.firstElementChild.style.transform = "rotate(360deg)";
    parent.firstElementChild.firstElementChild.innerHTML = "&minus;";

  }else {
    parent.style.background = "white";
    parent.style.color = "#555";
    parent.style.border = " 1px solid #aaa";
    parent.firstElementChild.firstElementChild.style.transform = "rotate(0deg)";
    parent.firstElementChild.firstElementChild.innerHTML = "+";
  }
}
