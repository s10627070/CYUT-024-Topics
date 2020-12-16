<?php
require_once 'php/db.php';
require_once 'php/functions.php';

//print_r ($datas);
?>
<div id='test'></div>
<script>
$(document).ready(function(){

//第一次讀取
 $returntrue=cartnumber();

//自動更新
if($returntrue){
setInterval(function(){ cartnumber(); }, 10000);  //預設10000毫秒自動重複執行cartnumber()函數
}
function cartnumber(){

$.ajax({

url: 'bid.php',

type: 'GET',

data: { id: '1'},

success: function(response) {

$('#test').html(response);

},

error: function() {

console.log('ajax error!');

}

})

}
   return true; 
});

</script>