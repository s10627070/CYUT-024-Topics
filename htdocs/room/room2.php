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
				
				<script src="../assets/js/time.js"></script>
				<a href="#menu">Menu</a>
			</header>
		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<?php
					if(($_SESSION["user"]==""))
					{
					echo '<li><a href="../generic.html">登入</a></li>';
					?><script type="text/javascript">alert("請先登入");window.location.href="../generic.html";</script><?php
					}
					else{
					//若使用者已經是登入狀態擁有SESSION值，則前往以下網頁
					echo "<p style='color:gray;'>Welcome!</p>";
					echo "<p style='color:gray;'>".$_SESSION["uname"]."</p>";
					echo '<li><a href="../logout.php">登出</a><li>';
					}
					?>
				</ul>
			</nav>

		<!-- 這裡播放房間圖片要嘛？ -->

			<section class="banner full">
				<article>
					<img src="../images/room2.jpg" alt="" />
					<div class="inner">
						<header>
							<p>這裡可以做介紹</p>
							<h2>一般房</h2>
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
								<img src="../images/room2.jpg" alt="" />	
								</div>
								<div class="content">
									<header class="align-center">
										<h2>一般房</h2>
									</header>
									<p>  </p>
									<footer class="align-center">
									<div style="color:red"><?php echo $msg ?></div>
							

							<div style="color:red"><?php echo $error ?></div>
							<form action="roombuy2.php" method="post">
							<?php
							$roomA=['一般房'];
							$plusA = ['0','1','2'];
							$payA=['轉帳','信用卡'];
								echo '姓名:(請填寫跟註冊時一樣的姓名)' . '<input type="text" name="uname" value="' .$_SESSION["uname"]. '"required>' . '<br>';
								echo '輸入電話:(09xxxxxxxx):' .'<br>'. '<input type="text" id="phone" name="phone" pattern="[0-9]{2}[0-9]{8}">'.'<br>';
								echo '選擇房型:';
								if ($_POST["submit"] == '送出') {
									$rooml = $_POST["rooml"];
								}
								echo '<select class="form-control selectpicker" name="rooml[]">';
								echo '<value="" disabled selected>選擇房型</option>';
								for ($h = 0;$h < count($roomA);$h++) {
									echo '<option value="' . $roomA[$h] . '"';
									if (!empty($_POST['rooml'])) {
										if (in_array("$roomA[$h]", $_POST['rooml'])) echo "selected";
									}
									echo '>' . $roomA[$h];
								}
								echo '</select>';
								echo '<br>';
								
								echo '加床:';
								echo '<select class="form-control selectpicker" name="plus[]">';
								echo '<option value="" disabled selected>0</option>';
								for ($z = 0;$z < count($plusA);$z++) {
									echo '<option value="' . $plusA[$z] . '"';
									if (!empty($_POST['plus'])) {
										if (in_array("$plusA[$z]", $_POST['plus'])) echo "selected";
									}
									echo '>' . $plusA[$z];
								}
								echo '</select>';
								echo '<br>';
								
								echo '付款方式:';
								echo '<select class="form-control selectpicker" name="pay[]">';
								echo '<option value="" disabled selected>選擇付款方式</option>';
								for ($z = 0;$z < count($payA);$z++) {
									echo '<option value="' . $payA[$z] . '"';
									if (!empty($_POST['pay'])) {
										if (in_array("$payA[$z]", $_POST['pay'])) echo "selected";
									}
									echo '>' . $payA[$z];
								}
								echo '</select>';
								echo '<br>';
								?>
								入住日期:<input type="date" value="<?= isset($_POST['date1']) ? $_POST['date1'] : ''; ?>" name="date1" min="<?= date('Y-m-d'); ?>"required>
								<?php
								echo '<br>';
								echo '<br>';
								?>
								退房日期:<input type="date" value="<?= isset($_POST['date2']) ? $_POST['date2'] : ''; ?>" name="date2" min="<?= date('Y-m-d'); ?>" max="<?=date('Y-m-d', strtotime("+20 day", time()))?>"required>
								<?php
								echo '<br>';
								echo '<input type="submit" name="submit" value="送出"/>';
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