<?php
//載入資料庫與處理的方法
require_once 'db.php';
require_once 'functions.php';
//print_r($_POST);
//判別有無在登入狀態
if(isset($_SESSION['is_login']) && $_SESSION['is_login']){

    $update_result = update_order($_POST['id'],$_POST['publish']);


	if($update_result)
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
else
{
	//若為 null 或者 false 代表失敗
	echo 'no';	
}
?>