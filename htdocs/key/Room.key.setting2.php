<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)

	Login Page
-->
<html>
	<head>
		<title>設定房門密碼</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />	
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="../index.php">首頁<span></span></a></div>
				<a href="#"></a>
			</header>

		<!-- Nav -->
			

		<!-- One -->
		<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>此為設定房門密碼頁面</p>
						<h2>設定完後請記得自己的密碼</h2>
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
							<form action="Room.key.setting2.php" method="post">
							<?php for($i=0;$i<=13;$i++) echo "&nbsp"; ?> 
							請輸入 4~6 位數密碼：<br/> <br/><input type="text" name="aaa" pattern="[0-9]*"><br/>
							<input type="submit" value="儲存密碼" name="submit">
							<?php

								if(isset($_POST['aaa']))
								{
									echo "<br/>";
									if(4 > strlen(strval($_POST['aaa'])) )
									{
										echo "Password is less than 4 digits !!";
									}
									else if(6 < strlen(strval($_POST['aaa'])))
									{
										echo "Password is more than 6 digits !!";
									}
									else
									{
										$tmp = strval($_POST['aaa']);
										$key_pass = hash('sha256',$tmp);
										
										$sql = "UPDATE berry SET pass= '$key_pass' WHERE num=2;";
										include("../dbset.inc.php");
										if(mysqli_query($dblink, $sql))
										{
											//if success 跳出對話匡並跳轉
											echo "<script>alert('設定成功！');parent.location.href='../generic.html';</script>";
										}
										else
											echo "Error";
									}
								}
							?>
							</form>
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