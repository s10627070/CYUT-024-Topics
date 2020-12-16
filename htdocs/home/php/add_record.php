<?php
//載入資料庫與處理的方法
require_once 'db.php';
require_once 'functions.php';
//print_r($_SESSION);
//判別有無在登入狀態
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
	//執行新增使用者的方法，直接把整個 $_POST個別的照順序變數丟給方法。
	if ($_POST['now_price'] != $bidding['now_price']) {
		$add_result = add_record($_POST['name'], $_POST['now_price'], $_POST['bidding_id']);
		if($add_result)
		{
			//若為true 代表新增成功，印出yes
			echo 'yes';
		}
		else
		{
			//若為 null 或者 false 代表失敗
			echo 'no';	
		}
	}
	else {
		echo 'no1';
	}
	
	

}
else
{
	//若為 null 或者 false 代表失敗
	echo 'no';	
}

?>