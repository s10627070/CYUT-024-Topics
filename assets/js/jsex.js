
function talk() {
/*
	alert("歡迎來到無人旅館");
	alert("讓我來幫你導覽");
	alert('右邊MENU打開先註冊');
	alert('註冊好候登入');
	alert('接著挑選你要的房間');
	alert('就可以開始訂房瞜!!');

	alert('訂房完請至您的EAMIL查看正不正確');
	alert('如果有錯誤請通知我們');
	alert('如果都沒錯您的資訊都會在MENU您的資料那邊');
*/
var str = "讓我來幫你導覽";
document.write('<head><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.0/sweetalert2.css"/></head>');
document.write('<body><script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>'+
'<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.0/sweetalert2.js" type="text/javascript"></script>'+
' <script type="text/javascript">')

document.write("Swal.fire({icon: 'success',title: '歡迎來到無人旅館', html:'★右邊MENU打開先註冊&emsp;&emsp;&emsp;&emsp;&emsp;</br>' +"+
"'★註冊好後登入&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</br>' +"+
"'★接著挑選你要的房間&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</br>' +"+
"'★就可以開始訂房囉!!&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;</br>' +"+
"'★訂房完請至您的EMAIL查看&emsp;&emsp;&emsp;</br>' +"+
"'★如果有錯誤請通知我們&emsp;&emsp;&emsp;&emsp;&emsp;</br>' +"+
"'★您的資訊都會在MENU那邊&emsp;&emsp;&emsp;</br>' "+
"}).then((result) => {location.reload();})" );
document.write("</script></body>");
}
