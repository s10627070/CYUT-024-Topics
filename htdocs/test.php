<!DOCTYPE HTML>
<div class="tldr-block">

</br>
<label for="massage">選擇日期（週日除外）：</label><input id="massage" type="date"><script>
var date = document.getElementById('massage');
function noSundays(e){
  // Days in JS range from 0-6 where 0 is Sunday and 6 is Saturday

  var day = new Date(e.target.value).getUTCDate();
   
  sd=10;
  if ( day == 10 ){
    e.target.setCustomValidity('不可選擇週日！');
  } else {
    e.target.setCustomValidity('');
  }
}
date.addEventListener('input',noSundays);
</script><p></p>
<style>
input:invalid {
  background-color: #E00;
}
</style>
</div>

