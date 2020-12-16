<?php
//載入資料庫與處理的方法
require_once 'db.php';
require_once 'functions.php';

//判別有無在登入狀態
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
	//執行新增使用者的方法，直接把整個 $_POST個別的照順序變數丟給方法。
	$add_result = add_contactus($_POST['name'], $_POST['tel'], $_POST['email'], $_POST['message']);

	if($add_result)
	{
		$name = $_POST['name'];
		$message= $_POST['message'];
		$email = $_POST['email'];
		echo '<script type="text/javascript"> ';
		echo 'alert("已收到您的意見");' ;
		echo 'window.location.href="../contactus.php"; ';
		echo '</script> ';
		@require_once 'send_mail_conactus.php';
		//echo 'yes';

	}
	else{
		//echo 'yes';
		echo '<script type="text/javascript"> ';
		echo 'alert("請重新送出表單");' ;
		echo 'window.location.href="../contactus.php"; ';
		echo '</script> ';
	}

}
else
{
	//若為 null 或者 false 代表失敗
	echo 'no';	
	echo '<script type="text/javascript"> ';
	echo 'alert("請先登入");' ;
	echo 'window.location.href="../login.php"; ';
	echo '</script> ';
}

?>
