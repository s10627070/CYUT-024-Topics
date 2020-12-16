<?php 
include ('dbset.inc.php');
global $dblink;
$name=$_POST['name'];
$passport1=$_POST['passport1'];

if (is_array($_POST['rooml'])) {
	foreach ($_POST['rooml'] as $rvalue) {
	$aroom = $rvalue;
	}
}

$dblink->set_charset('UTF-8'); // 設定資料庫字符集
$result = $dblink->query("select * from userdata where UserName ='$name'");//呼叫資料庫使用者的名稱
$row=mysqli_fetch_array($result);
$data = $result->fetch_all();
$UserName=@$row['UserName'];//抓名稱
$passport=@$row['passport'];//抓身分證


$resultroom = $dblink->query("SELECT * FROM room WHERE UserName ='$name' AND type='$aroom' AND sum='已訂房' AND pay='已付款'");
$rowroom=mysqli_fetch_array($resultroom);
$data1 = $resultroom->fetch_all();
$date  = date('Y-m-d');
$date1=@$rowroom['date1'];
$UserName1=@$rowroom['UserName'];
$phone=@$rowroom['phone'];
$pay=@$rowroom['pay'];
$type=@$rowroom['type'];

$pass = $dblink->query("SELECT pass FROM berry WHERE type ='$type' ");
$passrow=mysqli_fetch_array($pass);
$password1 = $pass->fetch_all();
$pwd = @$passrow['pass'];


if(isset($_POST["submit"]))
{	
	require'passporttest1.php';
	$passport1 = $_POST['passport1'];
	$passportrow = checkId($_POST['passport1']);

	if($passportrow!='1')
	{
	echo "<script>alert('身分證格式錯誤'); location.href ='registered.php';</script>";
	}
	else if($date != $date1)
	{
		?><script type="text/javascript">alert("時間未到，請回");window.location.href="checkin.php";</script><?php
	}
	else if($pwd!=null)
	{
		?><script type="text/javascript">alert("已經有Check In了！！！");window.location.href="checkin.php";</script><?php
	}
	else
	{
		if(empty($name))
		{
		?><script type="text/javascript">alert("姓名空白");window.location.href="checkin.php";</script><?php
		}
		else
		{
			if(empty($passport1))
			{
			?><script type="text/javascript">alert("身分證空白");window.location.href="checkin.php";</script><?php
			}
			else
			{
				if(empty($aroom))
				{
				?><script type="text/javascript">alert("房間空白");window.location.href="checkin.php";</script><?php
				}
				else
				{
					if($name!=$UserName1)
					{
					?><script type="text/javascript">alert("此人無房間");window.location.href="checkin.php";</script><?php
					}
					else
					{
						if($aroom!=$type)
						{
						?><script type="text/javascript">alert("房間錯誤");window.location.href="checkin.php";</script><?php
						}
						else
						{
							if($passport1!=$passport)
							{
							?><script type="text/javascript">alert("沒有此人");window.location.href="checkin.php";</script><?php
							}
							else
							{
								if($pay!='已付款')
								{
								?><script type="text/javascript">alert("還沒付款");window.location.href="checkin.php";</script><?php
								}
								else
								{	
									if($type == '豪華房')
										header("refresh:0;url=key/Room.key.setting1.php");
									else if($type == '一般房')
									header("refresh:0;url=key/Room.key.setting2.php");
									
								}
							}
						}
					}
				}
			}
		}	
	}
}
?>