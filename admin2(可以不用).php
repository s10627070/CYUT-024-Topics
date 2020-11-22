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
				

				
				</ul>
			</nav>
			<section class="banner full">
				<article>
					<img src="images/room1.jpg" alt="" />
					<div class="inner">
						<header>
							<p>查詢訂單</p>
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
										$zzz='';
										include_once ('dbset.inc.php');
										global $dblink;
										$date1=$_POST['date1'];
										$checkname=$_POST['checkname'];
										//$dblink->set_charset('UTF-8'); // 設定資料庫字符集
										$result = mysqli_query($dblink,"select date1,date2,type from room where type ='豪華房(1000)' ");
										$row1=mysqli_fetch_all($result);
										$data = $result->fetch_all();
										echo count($row1);
										echo '<br>';
										if($_POST['date1']!=''){
										 $date1=$_POST['date1'];
										  $checkname=$_POST['checkname'];
										 $data=$dblink->query("select date1,date2,type from room where type ='豪華房(1000)' "); 
										 echo count($row1);
										 echo '<br>';
										}else{
										 $data=$dblink->query("select date1,date2,type from room where type ='豪華房(1000)' ");
										}
										
										foreach($row1 as $i){
										echo $i[0]." ";
										echo $i[1]."</br>";
										}
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

										
										<td style="text-align: center;">入住日期</td>
										<td style="text-align: center;">退房日期</td>
										<td style="text-align: center;">房型</td>

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