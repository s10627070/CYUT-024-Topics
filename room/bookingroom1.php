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
					$user1=$_SESSION["uname"];
					include_once ('../dbset.inc.php');
					$sql = "SELECT pay FROM room where type='豪華房' and UserName= '$user1'";
					$result = mysqli_query($dblink, $sql);
					$rowpay = $result->fetch_assoc();
					$pay=@$rowpay['pay'];			
					$pass = $dblink->query("SELECT pass FROM berry WHERE type ='豪華房' ");
					$passrow=mysqli_fetch_array($pass);
					$password1 = $pass->fetch_all();
					$pwd = @$passrow['pass'];		
					if(($_SESSION["user"]==""))
					{
					echo "<p style='color:gray;'>請先登入!</p>";
					echo '<li><a href="../generic.html">登入</a></li>';
					echo '<li><a href="../registered.php">註冊</a></li>';
					}
					else{
					//若使用者已經是登入狀態擁有SESSION值，則前往以下網頁
					echo "<p style='color:gray;'>Welcome!</p>";
					echo "<p style='color:gray;'>".$_SESSION["uname"]."</p>";//登入後出現
					echo '<li><a href="../resetpass.php">更改密碼</a></li>';
					echo '<li><a href="../logout.php">登出</a><li>';
					if($pay=='已付款'){
						echo '<li><a href="checkoutroom1.php">退房</a><li>';
					}
					else{
					echo '<li><a href="cancel2.php">取消訂房</a><li>';
					}
					
					}
					if($pwd!=null){
					echo '<li><a href="../key/Room.key.setting1.php">忘記房門密碼</a><li>';
					}
					?>
				</ul>
			</nav>

		<!-- 這裡播放房間圖片要嘛？ -->

			<section class="banner full">
				<article>
					<img src="../images/room1.jpg" alt="" />
					<div class="inner">
						<header>
							<p>這裡可以做介紹</p>
							<h2>豪華房</h2>
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
								<img src="../images/room1.jpg" alt="" />	
								</div>
								<div class="content">
									<header class="align-center">
										<p>打房間介紹</p>
										<h2>豪華房</h2>
										<h2>訂房資訊</h2>
									</header>
									<p>  </p>
									<footer class="align-center">
									<div style="color:red"><?php echo $msg ?></div>
									<?php
									$error = "";
									$msg = "";
									$uname = "";
									$user = "";
									$phone ="";
									$showform = true;
									$salt1 = '$hT7^Fg%6';
									$salt2 = 'L8&5G5Dgd5';
									$date1 = '';
									$date2 = '';
									$user1=$_SESSION["uname"];
									include_once ('../dbset.inc.php');
									$sql = "SELECT type,UserName,sum,phone,date1,date2,pay FROM room where type='豪華房' and UserName= '$user1' and sum='已訂房'";
									$result = mysqli_query($dblink, $sql);
									$row = $result->fetch_assoc();
									$num=@$row['num'];
									$UserName=@$row['UserName'];
									$type=@$row['type'];
									$phone=@$row['phone'];
									$sum=@$row['sum'];
									$date1=@$row['date1'];
									$date2=@$row['date2'];
									$pay=@$row['pay'];

									$sql = "SELECT pass,num FROM berry WHERE num='1'";
									$result = mysqli_query($dblink, $sql);
									$rowas = $result->fetch_assoc();
									$pass =@$rowas['pass'];
									
									echo "訂購人: " .$_SESSION["uname"]. "<br/>";
									echo "房間名稱: ". $type ."<br/>";
									echo "入住日期: ". $date1 . "PM: 3:00以後"."<br/>";
									echo "退房日期: ". $date2 . "AM: 11:30以前"."<br/>";
									echo "電話:+886" .$phone ."<br/>";	
									?>
									<form action="bookingroom1.php" method="post">
									<?php
									//======== room key button =================================================
									
									if($pay == "已付款" && $pass !=NULL)
									{
										$key_pass = strval($_POST['aaa']);
										       
										echo '請輸入 4~6 位數房門密碼：<input type="text" name="aaa" pattern="[0-9]*"><br/>'; //textbox
										include("../key/door.php");
										door_key(1,$key_pass);
										$key_pass=NULL;
									}
									//=========================================================================
									
									echo '</form>';
									
									?>
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