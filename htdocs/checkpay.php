<?php 
session_start();
?>
<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
	
		<title>無人旅館</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="../index.php">首頁 <span>by Siri & Jay</span></a></div>
				<a href="#menu">Menu</a>
			</header>
		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<?php
					include_once ('dbset.inc.php');
				global $dblink;
				$dblink->set_charset('UTF-8'); // 設定資料庫字符集
				$result = $dblink->query("select UserId,email,UserPass,UserName from userdata where UserId ='1'");
				$row=mysqli_fetch_array($result);
				$data = $result->fetch_all();
					if(($_SESSION["uname"]=="root"))
					{
					echo "<p style='color:gray;'>Welcome!</p>";
					echo "<p style='color:gray;'>".$_SESSION["uname"]."</p>";//登入後出現
					echo '<li><a href="index.php">Home</a></li>';
					echo '<li><a href="logout.php">logout</a><li>';
					echo '<li><a href="admin.php">管理者</a><li>';
					}
					else{
					//若使用者已經是登入狀態擁有SESSION值，則前往以下網頁
					?><script type="text/javascript">alert("無權限閱讀");window.location.href="../index.php";</script><?php
					}
					?>
				</ul>
			</nav>

		<!-- 這裡播放房間圖片要嘛？ -->

			<section class="banner full">
				<article>
					<img src="../images/hello.jpg" alt="" />
					<div class="inner">
						<header>
							<h2>人工確認</h2>
						</header>
					</div>
				</article>
			</section>
		
		<!-- One -->
			<section id="one" class="wrapper style2">
				<div class="inner">
					<div class="grid-style">
						
						<div>
							<div class="box">
								<div class="image fit">
								<img src="../images/checkpay.jpg" alt="" />	
								</div>
								<div class="content">
									<header class="align-center">
									<footer class="align-center">
									<form action="checkpay.php" method="post">
									輸入姓名:<input type="text" name="checkname" value="" required>
									入住日期:<input type="date" value="<?= isset($_POST['date1']) ? $_POST['date1'] : ''; ?>" name="date1" min="<?= date('Y-m-d'); ?>"required><br/>
									退房日期:<input type="date" value="<?= isset($_POST['date2']) ? $_POST['date2'] : ''; ?>" name="date2" min="<?= date('Y-m-d'); ?>" max="<?=date('Y-m-d', strtotime("+20 day", time()))?>"required><br/>
									<input type="submit" name="submit" value="送出"/>';
									</form>
									</footer>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
				</div>
				<div class="copyright">
					&copy; 記得一定要完成.
				</div>
			</footer>
		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>
			

	</body>
</html>
<?php
session_start();
include_once("dbset.inc.php");//連接數據庫 
$checkname =$_POST['checkname'];
$date1=$_POST['date1'];
$date2=$_POST['date2'];
global $dblink;
$dblink->set_charset('UTF-8'); // 設定資料庫字符集
$result = $dblink->query("select UserName,date1,date2 from room where UserName ='$checkname' and date1='$date1' and date2='$date2'");
$row=mysqli_fetch_array($result);
$UserName=@$row['UserName'];
$date11=$_POST['date1'];
$date21=$_POST['date2'];
if (isset($_POST["submit"])) 
{	
include_once ('dbset.inc.php');
global $dblink;
$dblink->set_charset('UTF-8'); // 設定資料庫字符集
$result = $dblink->query("select UserId,email,UserPass,UserName from userdata where UserId ='8'");
$row=mysqli_fetch_array($result);
$data = $result->fetch_all();
$checkname =$_POST['checkname'];
$date1=$_POST['date1'];
$date2=$_POST['date2'];
	if(($_SESSION["uname"]=="root"))
	{
		$checkname = $_POST['checkname']; //姓名
		if (empty($checkname))
		{
		?><script type="text/javascript">alert("請填寫姓名");window.location.href="checkpay.php";</script><?php
		}
		else{
			if(empty($date1))
			{
				?><script type="text/javascript">alert("請填寫入住日期");window.location.href="checkpay.php";</script><?php
			}
				else
				{
					if(empty($date2))
					{
						?><script type="text/javascript">alert("請填寫退房日期");window.location.href="checkpay.php";</script><?php
					}
					else
					{
						if($date1!=$date11)
						{
							?><script type="text/javascript">alert("日期錯誤");window.location.href="checkpay.php";</script><?php
						}
						else
						{
							require ("dbset.inc.php");
							$result = $dblink->query("update room set pay='已付款' where UserName='$checkname'");
							$row = @mysqli_fetch_row($result);
							if ($result)
							{
							echo '成功!<br>';
							?><script type="text/javascript">alert("成功");window.location.href="checkpay.php";</script><?php
							}
						}
					}
				}
			}
	}
	else
	{
	?><script type="text/javascript">alert("無權限閱讀");window.location.href="index.php";</script><?php
	}
}
?>