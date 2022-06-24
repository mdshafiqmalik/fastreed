function checkDate(){
  var date = document.getElementById('date');
  console.log(date);
}

function checkedItems(checkbox){
  var parent = checkbox.parentElement.parentElement;
  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  var cCount = document.getElementById('cCount');
  let remain = 5-checkboxes.length;
  if (checkbox.checked == true) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    let remain = 5-checkboxes.length;
    if (remain <= 0) {
      cCount.innerHTML = `(${checkboxes.length} items selected)`;
      cCount.style.color = "green";

    }else {
      cCount.innerHTML = `(Select ${remain} More)`;
    }
    parent.style.background = "#0165E1";
    parent.style.color = "White";
    parent.style.border = "1px solid #0165E1";
    parent.firstElementChild.firstElementChild.style.transform = "rotate(360deg)";
    parent.firstElementChild.firstElementChild.innerHTML = "&minus;";

  }else {
    cCount.style.color = "red";
    cCount.innerHTML = `(Select ${remain} More)`;
    parent.style.background = "white";
    parent.style.color = "#555";
    parent.style.border = " 1px solid #aaa";
    parent.firstElementChild.firstElementChild.style.transform = "rotate(0deg)";
    parent.firstElementChild.firstElementChild.innerHTML = "+";
  }
}
