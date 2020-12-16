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
		<link rel="stylesheet" href="assets/css/main.css" />
		
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="index.php">無人旅館 <span></span></a></div>
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
				echo '<li><a href="index.php">首頁</a></li>';
				echo "<p style='color:gray;'>Welcome!</p>";
				?>
				
				</ul>
			</nav>
			<section class="banner full">
				<article>
					<img src="images/room1.jpg" alt="" />
					<div class="inner">
						<header>
							<p><h2>豪華房查詢有無房間</h2></p>
						</header>
					</div>
				</article>
					</div>
				</article>
			</section>
			<section id="one" class="wrapper style2">
				<div class="inner">
					<div class="grid-style">
										<?php
										include_once ('dbset.inc.php');
										global $dblink;

										$dblink->set_charset('UTF-8'); // 設定資料庫字符集
										$result = $dblink->query("SELECT * FROM room WHERE 1");
										$row=mysqli_fetch_array($result);
										$data = $result->fetch_all();

										 $data=$dblink->query("SELECT * FROM room WHERE type='豪華房'"); 


										
										?>
										<form id="form1" name="form1" method="post" action="">
										  <p>
										  入住日期:<input type="date" value="<?= isset($_POST['date1']) ? $_POST['date1'] : ''; ?>" name="date1" min="<?= date('Y-m-d'); ?>"required>
										  <br>
											<br>
											<input type="submit" name="button" id="button" value="搜尋" />
										  </p>
										</form>
										<p></p>
										<table width="900"  height="120" style="font-size:18px;font-family:serif;" border="1" cellpadding="5">
									   <tr>
										<td style="text-align: center;">房型</td>
										<td style="text-align: center;">已無房間</td>
										<td style="text-align: center;">已無房間</td>

									  </tr>
									  <?php
									  for($i=1;$i<=mysqli_num_rows($data);$i++){
									$rs=mysqli_fetch_row($data);
									?>
									  <tr>
										<td style="text-align: center;"><?php echo $rs[1]?></td>
										<td style="text-align: center;"><?php echo $rs[4]?></td>
										<td style="text-align: center;"><?php echo $rs[5]?></td>

									  </tr>
										  
										  <?php
										}
										?>
							</table>
						<p>&nbsp;</p>
					</div>
				</div>
			</section>
			
		<!-- 這裡播放房間圖片要嘛？ -->	
		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="https://www.facebook.com/profile.php?id=100054559314466" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="https://www.instagram.com/s10627070/" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<!---<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li> --->
					</ul>
				</div>
				<div class="copyright">
					&copy; 記得一定要完成.
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
