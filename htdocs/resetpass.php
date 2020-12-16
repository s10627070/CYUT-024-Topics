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
								
							</header>
							<form action="reset.php" method="post" onsubmit="return alter()"> 
							信箱:(註冊時信箱)<input type="email" name="email"  id="email" required><br/>
				
							請輸入舊密碼(輸入舊密碼，若忘記舊密碼，請使用<a href="forget.php">忘記密碼</a>，找回密碼。)<input type="password" name="pass" id ="pass" required /><br/>
							新密碼<input type="password" name="pass1" id="pass1" required /><br/>
							確認新密碼<input type="password" name="assertpassword" id="assertpassword" required /><br/>
							<div class="form-group m-0">
							<button type="submit" class="btn btn-primary btn-block">
							修改密碼
							</button>
							</div>
							</form>
							<script type="text/javascript"> 
							document.getElementById("email").value="<?php echo '${_SESSION["email"]}';?>" 
							</script> 
							<script type="text/javascript"> 
							function alter() { 
							var email=document.getElementById("email").value; 
							var pass=document.getElementById("pass").value; 
							var pass1=document.getElementById("pass1").value; 
							var assertpassword=document.getElementById("assertpassword").value; 
							var regex=/^[/s] $/; 
							if(preg_match('/[^a-z_\-0-9]/i', $email)){ 
							alert("信箱名稱格式不對"); 
							return false; 
							} 
							if(regex.test(pass)||pass.length==0){ 
							alert("密碼格式不對"); 
							return false; 
							} 
							if(regex.test(pass1)||pass1.length==0) { 
							alert("新密碼格式不對"); 
							return false; 
							} 
							if (assertpassword != pass1||assertpassword==0) { 
							alert("兩次密碼輸入不一致"); 
							return false; 
							} 
							return true; 
							} 
							</script> 
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