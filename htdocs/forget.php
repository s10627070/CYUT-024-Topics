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
				<div class="logo"><a href="index.php">回 <span>首頁</span></a></div>
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
						<p>Welcome To</p>
						<h2>無人旅館</h2>
					</header>
				</div>
			</section>

		<!-- Two 內容   -->
			<section id="two" class="wrapper style2">
				<div class="inner">
					<div class="box">
						<div class="content">
							<header class="align-center">
							<body class="my-login-page">
							<h2 class="card-title">找回密碼</h2>
							<form method="POST" action="send_email.php" class="my-login-validation" novalidate="">
								<div class="form-group">
									<span style="font-size:1cm;"><font color="blue">註冊信箱</font></span>
									
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<font color="blue">
									<div class="invalid-feedback">
										請填寫信箱地址
									</div>
									<div class="form-text text-muted" >
										系統會送出重設密碼郵件至註冊信箱，請於5分鐘內重設密碼，逾時請重新申請。
									</div>
									</font>
								</div>
								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										重設密碼
									</button>
								</div>
								<font color="red">
								<div class="mt-4 text-center">
									修改密碼? <a href="resetpass.php">點我連結修改密碼</a>
								</div>
								</font>
							</form>
							</header>
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