function checkDate(){
  var day = document.getElementById('day');
  var month = document.getElementById('month');
  var year = document.getElementById('year');
  var date = new Date(`${year.value}/${month.value}/${day.value}`);
  Date.prototype.isValid = function () {
    return this.getTime() == this.getTime();
  };
console.log(date);
  console.log(date.isValid());
}
