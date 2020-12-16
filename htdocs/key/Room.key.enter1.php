<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)

	Login Page
-->
<html>
	<head>
		<title>輸入房門密碼</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />	
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="../index.php"><span></span></a></div>
				<a href="#"></a>
			</header>

		<!-- Nav -->
			

		<!-- One -->
		<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>房門密碼為您入住登記設定的4~6位數字</p>
						<h2>出門及進門後請記得關緊房門</h2>
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
							<form action="Room.key.enter1.php" method="post">
							
							<?php 
							?>

							<?php
                             
                        	for($i=0;$i<=13;$i++) echo "&nbsp";  

								$sql = "SELECT pass,state FROM berry WHERE num=1;";
                                include("../dbset.inc.php");
                                $as = mysqli_query($dblink, $sql);
                                $row = mysqli_fetch_row($as); //origin
                                $key_pass = strval($_POST['aaa']);
								//$key_pass = hash('sha256',$tmp);       
								echo '請輸入 4~6 位數房門密碼：<br/> <br/><input type="text" name="aaa" pattern="[0-9]*"><br/>'; //textbox
										include("door.php");
                                        door_key(1,$key_pass);
										$key_pass = NULL;
								
		
                                        
                                        
                                        //compare input with origin pass
                                        
                                  
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