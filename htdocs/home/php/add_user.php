<?php
//載入資料庫與處理的方法
require_once 'db.php';
require_once 'functions.php';
//執行檢查有無使用者的方法。
$check = check_has_username($_POST['username']);
$checkmail = check_has_mail($_POST['mail']);
if($check)
{
	//若為true 代表有使用者以重複
	echo'<script type="text/javascript"> alert("帳號重複!"); window.history.back();</script> ';
}
else
{	
	if(!$checkmail)
	{
		if($_POST['password'] == $_POST['password2']){

			$add_result = add_user($_POST['username'], $_POST['password'], $_POST['name'], $_POST['mail'], $_POST['phone']);
			if($add_result)
			{	
				//echo 'yes';
				echo'<script type="text/javascript"> alert("註冊成功! ");</script> ';
				echo'<script type="text/javascript"> alert("請至信箱收信已開通帳號!"); window.location.href="/"; </script> ';
				require_once 'verify_mail.php';
			}
			else
			{
			//若為 null 或者 false 代表失敗
			echo 'no';	
			echo '<script type="text/javascript"> alert("系統錯誤請聯絡管理員"); window.location.href="../"; </script>';
			}

		}
		else{
			echo'兩次密碼錯誤';
			echo'<script type="text/javascript"> alert("確認密碼不同"); window.history.back();</script> ';
		}

	}
	else{
		echo'信箱已被註冊過';
		echo'<script type="text/javascript"> alert("信箱已被註冊過"); window.history.back();</script> ';
	}

}
?>