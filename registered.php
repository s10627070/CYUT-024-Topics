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
					<li><a href="generic.html">登入</a></li>
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
							<?php
							$error = "";
							$msg = "";
							$uname = "";
							$user = "";
							$showform = true;
							$email = "";
							$cityA = ['基隆市', '嘉義市', '台北市', '嘉義縣', '新北市', '台南市', '桃園縣', '高雄市', '新竹市', '屏東縣', '新竹縣', '台東縣', '苗栗縣', '花蓮縣', '台中市', '宜蘭縣', '彰化縣', '澎湖縣', '南投縣', '金門縣', '雲林縣', '連江縣'];
							$salt1 = '$hT7^Fg%6';
							$salt2 = 'L8&5G5Dgd5';
							$date = '';
							$date2 = '';
							$passport="";
							if (isset($_POST["submit"])) {
								$passport = $_POST['passport'];
								$uname = $_POST['uname']; //姓名
								$user = $_POST['user']; //帳號
								$pass = $_POST['pass']; //密碼
								$ID = $_POST['ID']; //生分證密碼
								$uppercase = preg_match('@[A-Z]@', $pass);
								$lowercase = preg_match('@[a-z]@', $pass);
								$number = preg_match('@[0-9]@', $pass);
								$specialChars = preg_match('@[^\w]@', $pass);
								$pass1 = $_POST['pass1']; //重新輸入
								$gdsel = $_POST['gdsel'];
								if (is_array($_POST['asel'])) {
									foreach ($_POST['asel'] as $cvalue) {
										$acity = $cvalue;
									}
								}
								$cityA = $_POST['acountl'];
								if (is_array($_POST['acountl'])) {
									foreach ($_POST['acountl'] as $svalue) {
										$acount = $svalue;
									}
								}
								$countA = $_POST['rooml'];
								
								if (is_array($_POST['rooml'])) {
									foreach ($_POST['rooml'] as $rvalue) {
										$aroom = $rvalue;
									}
								}
								?>
								<?php
								$roomA = $_POST['rooml'];
								//$scheck =implode(" ",$langA);
								$email = $_POST['email'];
								
								include ('dbset.inc.php');
								$sql = "SELECT * FROM userdata where UserAcc = '$user'";
								$result = mysqli_query($dblink, $sql);
								$row = @mysqli_fetch_row($result);
								$result = $dblink->query("select * from userdata where email='$email'");
								$row=mysqli_fetch_array($result);
								$data = $result->fetch_all();
								$email1=@$row['email'];
								require'passporttest.php';
								$passport = $_POST['passport'];
								$passportrow = checkId($_POST['passport']);
								if($passportrow!='1')
								{
									echo "<script>alert('身分證錯誤'); location.href ='registered.php';</script>";
								}
								else{
								if (empty($user)) {
									$error = "帳號欄位空白<br/>";
									} else {
										if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $user)) {
											$error = "帳號僅允許 A-Za-z0-9.<br/>";
										} else {if ($row[1] == $user) {
												$error = "帳號重複，請更改<br/>";
											}
											else{
											if ($email1 == $email) {
												$error = "信箱重複，請更改<br/>";
											} else {
												if ($pass != $pass1) {
													$error = "密碼輸入不相同<br/>";
												} 
													 else {
														if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
															$error = "信箱不合法<br/>";
															}
														else{
														$hash = $salt1 . $user . $salt2 . $pass;
														$pass2 = sha1($hash);
														$showform = false;
														$fsex = $_SESSION["sex"];
														$msg.= "姓名: " . $uname . "<br/>";
														$msg.= "帳號: " . $user . "<br/>";
														$msg.= "密碼: " . $pass2 . "<br/>";
														$msg.= "居住地: " . $acity . "<br/>";
														$msg.= "郵件: " . $email . "<br/>";
														$sql = "SELECT * FROM userdata where useracc = '$user'";
														require ("dbset.inc.php");
														$result = mysqli_query($dblink, $sql);
														$row = @mysqli_fetch_row($result);
														$sql = "INSERT INTO userdata(UserAcc,UserPass,UserName,email,city,passport) VALUES('$user','$pass2','$uname','$email','$acity','$passport')";
														if (mysqli_query($dblink, $sql)) {
															?><script type="text/javascript">alert("註冊成功");window.location.href="../generic.html";</script><?php
														} 
														else {
															echo '新增失敗!';	
														}
														
														
													}
													}	
												}
												}	
											}
										}
										}
									}							
							?>
							<?php if ($showform) {
							?>
							<div style="color:red"><?php echo $error ?></div>
							<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
							<?php
								$cityA = ['基隆市', '嘉義市', '台北市', '嘉義縣', '新北市', '台南市', '桃園縣', '高雄市', '新竹市', '屏東縣', '新竹縣', '台東縣', '苗栗縣', '花蓮縣', '台中市', '宜蘭縣', '彰化縣', '澎湖縣', '南投縣', '金門縣', '雲林縣', '連江縣'];
								echo '姓名:' . '<input type="text" name="uname" value="' . $uname . '"required>' . '<br>';
								echo '帳號:' . '<input type="text" name="user"  value="' . $user . '" required>' . '<br>'; //帳號
								echo '密碼:' . '<input type="password" name="pass" value="' . $pass . '" required >'; //密碼
								echo '<br>重新輸入密碼:' . '<input type="password" name="pass1" value="' . $pass1 . '" required > '; //重新輸入密碼
								echo '<br>身分證:EX範例:A123456789' . '<input type="text" id="passport" name="passport" placeholder="請輸入身分證" required>' . '<br>'; //身分證
								echo '選擇城市:';
								if ($_POST["submit"] == '送出') {
									$asel = $_POST["asel"];
								}
								echo '<select class="form-control selectpicker" name="asel[]">';
								echo '<option value="" disabled selected>城市</option>';
								for ($z = 0;$z < count($cityA);$z++) {
									echo '<option value="' . $cityA[$z] . '"';
									if (!empty($_POST['asel'])) {
										if (in_array("$cityA[$z]", $_POST['asel'])) echo "selected";
									}
									echo '>' . $cityA[$z];
								}
								echo '</select>';
								echo '<br>';
								echo '信箱:' . '<input type="email" name="email" value="' . $email . '" required>' . "<br>";
								if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
								}
								echo '<input type="submit" name="submit" value="註冊使用者" /> ';
								echo '</form>';
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