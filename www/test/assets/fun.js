function goTo(i) {
  window.location.href = `?tag=${i}`;
  document.getElementById(`${i}`).classList.add("tagActive");
  document.getElementById('onLoad').style.display= "none";
}
function allActive(){
  window.location.href = 'index.php';
  document.getElementById("all").classList.add("tagActive");
  document.getElementById('onLoad').style.display= "none";
}
// var w = 10;
// function onLoad(){
//   if (w < 499)
//           {
//               w = w+5;
//               document.getElementById('loader').style.width = w + 'px';
//
//           } else {
//              clearInterval(int);
//          }
// }
// var int = setInterval(onLoad, 100);
