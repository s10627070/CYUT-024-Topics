<?php
session_start();
?>
<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)

	Login Page
-->
<html>
	<head>
		<title>無人旅館</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />	
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="index.php"><span>回首頁</span></a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">首頁</a></li>	
					<li><a href="registered.php">註冊</a></li>
				</ul>
			</nav>

		<!-- One -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>Welcome To 無人旅館</p>
						<h2>Check In</h2>
					</header>
				</div>
			</section>

		<!-- Two 內容   -->
			<section id="two" class="wrapper style2">
				<div class="inner">
					<div class="box">
						<div class="content">
							<header class="align-center">
								
							</header>
							
							<form action="checkin2.php" method="post">
							<?php
							$roomA=['豪華房','一般房'];
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
							echo '<br>姓名:<input type="text" name="name" value=""required> <br/>';
							echo '<br>身分證:<input type="text" id="passport1" name="passport1" placeholder="EX範例:A123456789" required> <br/>';
							echo '<input type="submit" name="submit" value="送出"/>';
							echo '</form>';
							?>
							</body>
							</html>
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
					</ul>
				</div>
				<div class="copyright">
					&copy; 聯絡電話 : 0975492258.
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>