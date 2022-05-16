function goTo(i) {
  window.location.href = `?tag=${i}`;
  document.getElementById(`${i}`).classList.add("tagActive");
  document.getElementById('onLoad').style.display= "none";
}
function allActive(){
  window.location.href = '/';
  document.getElementById("all").classList.add("tagActive");
  document.getElementById('onLoad').style.display= "none";
}
