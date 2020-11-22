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
					if(($_SESSION["uname"]=="root"))
					{
					echo "<p style='color:gray;'>Welcome!</p>";
					echo "<p style='color:gray;'>".$_SESSION["uname"]."</p>";//登入後出現
					echo '<li><a href="index.php">Home</a></li>';
					echo '<li><a href="logout.php">logout</a><li>';
					echo '<li><a href="checkpay.php">已收到匯款點這</a><li>';
					}
					else{
					//若使用者已經是登入狀態擁有SESSION值，則前往以下網頁
					?><script type="text/javascript">alert("無權限閱讀");window.location.href="../index.php";</script><?php
					}
				?>
				
				</ul>
			</nav>
			<section class="banner full">
				<article>
					<img src="images/room1.jpg" alt="" />
					<div class="inner">
						<header>
							<p><h2>查詢訂單</h2></p>
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
										$date1=$_POST['date1'];
										$checkname=$_POST['checkname'];
										$dblink->set_charset('UTF-8'); // 設定資料庫字符集
										$result = $dblink->query("select UserId,email,UserPass,UserName from userdata where UserName ='$xxx'");
										$row=mysqli_fetch_array($result);
										$data = $result->fetch_all();
										if($_POST['date1']!=''){
										 $date1=$_POST['date1'];
										  $checkname=$_POST['checkname'];
										 $data=$dblink->query("select * from room where date1 like '%$date1%' and UserName like '%$checkname%'"); 
										}else{
										 $data=$dblink->query("select * from room");
										}
										
										?>
										<form id="form1" name="form1" method="post" action="">
										  <p>
										   姓名:<input type="text" name="checkname" value="" required>
										  入住日期:<input type="date" value="<?= isset($_POST['date1']) ? $_POST['date1'] : ''; ?>" name="date1" min="<?= date('Y-m-d'); ?>"required>
										  <br>
											<br>
											<input type="submit" name="button" id="button" value="搜尋" />
										  </p>
										</form>
										<p></p>
										<table width="900"  height="120" style="font-size:18px;font-family:serif;" border="1" cellpadding="5">
									   <tr>
										<td style="text-align: center;">編號</td>
										<td style="text-align: center;">房型</td>
										<td style="text-align: center;">姓名</td>
										<td style="text-align: center;">手機號碼</td>
										<td style="text-align: center;">入住日期</td>
										<td style="text-align: center;">退房日期</td>
										<td style="text-align: center;">加床</td>
										<td style="text-align: center;">應付金額</td>
										<td style="text-align: center;">訂房</td>
										<td style="text-align: center;">付錢</td>
									  </tr>
									  <?php
									  for($i=1;$i<=mysqli_num_rows($data);$i++){
									$rs=mysqli_fetch_row($data);
									?>
									  <tr>
										<td style="text-align: center;"><?php echo $rs[0]?></td>
										<td style="text-align: center;"><?php echo $rs[1]?></td>
										<td style="text-align: center;"><?php echo $rs[2]?></td>
										<td style="text-align: center;"><?php echo $rs[3]?></td>
										<td style="text-align: center;"><?php echo $rs[4]?></td>
										<td style="text-align: center;"><?php echo $rs[5]?></td>
										<td style="text-align: center;"><?php echo $rs[6]?></td>
										<td style="text-align: center;"><?php echo $rs[7]?></td>
										<td style="text-align: center;"><?php echo $rs[8]?></td>
										<td style="text-align: center;"><?php echo $rs[9]?></td>
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