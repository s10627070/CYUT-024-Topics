<?php
session_start();
include('dbset.inc.php');//連結資料庫
$name = $_POST['name'];//post獲得使用者名稱錶單值
$pass1 = $_POST['pass'];//post獲得使用者密碼單值
$salt1='$hT7^Fg%6';
$salt2='L8&5G5Dgd5';
$hash=$salt1.$name.$salt2.$pass1;
$password=sha1($hash);
if($_POST["submit"]=='登入')
{
	$sql = "SELECT UserId FROM userdata where UserAcc = '$name'";   //and UserPass='$password'"  檢測資料庫是否有對應的username和password的sql
	$result = mysqli_query($dblink,	$sql);//執行sql
	$rows=mysqli_fetch_row($result);
	$uid=$rows[0];

	$sqlacc = "SELECT UserAcc FROM userdata where UserAcc = '$name'";
	$resultacc = mysqli_query($dblink,	$sqlacc);//執行sql
	$rowacc = mysqli_fetch_row($resultacc);
	$rowsacc = $rowacc[0];

	$sqlpass = "SELECT UserPass FROM userdata where UserId = '$uid'";
	$resultpass = mysqli_query($dblink,	$sqlpass);//執行sql
	$rowspass=mysqli_fetch_row($resultpass);
	$upass=$rowspass[0];

if (empty($name))	{
					?><script type="text/javascript">alert("帳號空白");window.location.href="generic.html";</script><?php
					}
else{
	if(empty($pass1))
	{	?><script type="text/javascript">alert("密碼空白");window.location.href="generic.html";</script><?php
	}
	else{if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $name)) 
		{
			?><script type="text/javascript">alert("帳號僅允許 A-Za-z0-9");window.location.href="generic.html";</script><?php 
		}
		else{	
				if($rowsacc != $name)
			{
				
				?><script type="text/javascript">alert("帳號不存在");window.location.href="generic.html";</script><?php	
			}
			else{if ($password != $upass) 
			{
				?><script type="text/javascript">alert("密碼不正確");window.location.href="generic.html";</script><?php
			}
				else{
						$sqluname = "SELECT UserName FROM userdata where UserId = '$uid'";
						$resultuname = mysqli_query($dblink,$sqluname);//執行sql
						$rowsuname=mysqli_fetch_row($resultuname);
						$uname=$rowsuname[0];
						$_SESSION["user"] =$name;
						$_SESSION["uname"] =$uname;
						header("refresh:0;url=index.php");//如果成功跳轉至welcome.html頁面
					}
				}
			
			}
		}
	}
}
?>