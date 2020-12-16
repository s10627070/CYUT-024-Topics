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
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	</head>
	<body>
	<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v9.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/zh_TW/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="106052338025350"
  theme_color="#fa3c4c"
  logged_in_greeting="HI"
  logged_out_greeting="HI">
      </div>
	  
		<!-- Header -->
			<header id="header" class="alt">
				<div class="logo"><a href="index.php">無人旅館 <span></span></a></div>
				<a class="menu" href="javascript:talk()">操作指南</a> 
				
				<a href="#menu">Menu</a>
			</header>
		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
				
					<?php 
					if(($_SESSION["user"]==""))
					{
					echo "<p style='color:gray;'>請先登入!</p>";
					echo '<li><a href="index.php">首頁</a></li>';
					echo '<li><a href="generic.html">登入</a></li>';
					echo '<li><a href="registered.php">註冊</a></li>';
					}
					else{
					//若使用者已經是登入狀態擁有SESSION值，則前往以下網頁
					echo "<p style='color:gray;'>歡迎!</p>";
					echo "<p style='color:gray;'>".$_SESSION["uname"]."</p>";//登入後出現
					echo '<li><a href="index.php">首頁</a></li>';
					echo '<li><a href="resetpass.php">更改密碼</a></li>';
					//echo '<li><a href="checkin.php">checkin</a></li>';
					echo '<li><a href="logout.php">登出</a><li>';
					if(($_SESSION["uname"]=="root"))
					{echo '<li><a href="admin.php">管理者</a><li>';}
					}
					?>
					<?php
					if(($_SESSION["user"]!="")){
					$user1=$_SESSION["uname"];
					include_once ('dbset.inc.php');
					$sql = "SELECT type,UserName,sum FROM room where type='豪華房' and sum= '已訂房' and UserName='$user1'";//room有訂房才顯示
					$result = mysqli_query($dblink, $sql);
					$row = $result->fetch_assoc();
					$num=@$row['num'];
					$UserName=@$row['UserName'];
					if(($user1=="$UserName"))
					{echo '<li><a href="../room/bookingroom1.php">豪華房訂房資訊</a></li>';}
					}
					?>
					<?php
					if(($_SESSION["user"]!="")){
					$user1=$_SESSION["uname"];
					include_once ('dbset.inc.php');
					$sql = "SELECT type,UserName,sum FROM room where type='一般房' and sum= '已訂房' and UserName='$user1'";//room有訂房才顯示
					$result = mysqli_query($dblink, $sql);
					$row = $result->fetch_assoc();
					$num=@$row['num'];
					$UserName=@$row['UserName'];
					if(($user1=="$UserName"))
					{echo '<li><a href="../room/bookingroom2.php">一般房訂房資訊</a></li>';}
					}
					?>
					
				</ul>
			</nav>

		<!-- 這裡播放房間圖片 -->

			<section class="banner full">
				<article>
					<img src="images/room1.jpg" alt="" />
					<div class="inner">
						<header>
							<p>最高品質的享受</p>
							<h2>豪華房</h2>
						</header>
					</div>
				</article>
				<article>
					<img src="images/room2.jpg"  alt="" />
					<div class="inner">
						<header>
						<p>高CP值的房型. 千萬不可錯過</p>
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
										<img src="images/room1.jpg" alt="" />
									</div>
									<div class="content">
										<header class="align-center">
											<p>最高品質的享受</p>
											<h2>豪華房</h2>
										</header>
										<p>每晚價格1000元，此房型只提供最頂級的服務，有私人SPA，泳池，以及其他頂級的享受，現在入住即可免費升級私人管家。
										</p>
										<footer class="align-center">
										</footer>
									</div>
							</div>
						</div>
						<div>
							<div class="box">
								<div class="image fit">
									<img src="images/room2.jpg" alt="" />
								</div>
									<div class="content">
										<header class="align-center">
											<p>最高CP值的房型，錯過不再</p>
											<h2>一般房</h2>
										</header>
										<p>雖然沒有豪華房的霸氣隆重，卻擁有不一般的典雅端莊，如果您注重的是CP值，一般房絕對是您的好選擇。</p>
										<footer class="align-center">
										</footer>
									</div>
									
							</div>
						</div>
					</div>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>有問題請洽尋總機：0975-492-258 </p>
						<h2>訂房請往下</h2>
					</header>
				</div>
			</section>

		<!-- Three -->
		
			<section id="three" class="wrapper style2">
				<div class="inner">
					<header class="align-center">
						<p class="special">點擊圖片即可訂房</p>
						<h2>訂房資訊</h2>
					</header>
					
					<div class="gallery">
						<div>
							<div class="image fit">
								<a href="../room/room1.php"><img src="images/room1.jpg" alt="" /></a>
								<h2>豪華房</h2>
							</div>
						</div>
						<div>
							<div class="image fit">
								<a href="../room/room2.php"><img src="images/room2.jpg" alt="" /></a>
								<h2>一般房</h2>
							</div>
						</div>
					</div>
				</div>
			</section>
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
					&copy; 
					<?php include("counter.php");
						echo visitors();
					?>
				</div>
			</footer>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/jsex.js"></script>




			
	</body>
</html>