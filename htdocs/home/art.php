<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫
require_once 'php/db.php';
//載入 functions.php 檔案，透過裡面的方法取得資料庫的資料
require_once 'php/functions.php';
//購物車開始
//require_once 'mycart.php';
//print_r($_SESSION);
$art = get_art($_GET['p']);

$status="";
$con = $_SESSION['link'];
if (isset($_POST['id']) && $_POST['id']!=""){
$id = $_POST['id'];
//$result = mysqli_query($con,"SELECT * FROM `art` WHERE `id`='$id'");
//$row = mysqli_fetch_assoc($result);
$name = $art['name'];
$id = $art['id'];
$price = $art['price'];
$image = $art['image_path'];

$cartArray = array(
	$id=>array(
	'name'=>$name,
	'id'=>$id,
	'price'=>$price,
	'quantity'=>1,
	'image_path'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>產品已添加到您的購物車！</div>";
	
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($id,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		產品已經添加到您的購物車！</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>產品已添加到您的購物車！</div>";
	}

	}
}


 
?>
<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<title>Art</title>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" sizes="192x192"  href="img/101/favicon-96x96.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="shortcut icon" href="images/favicon.ico">
	</head>

	<body>
		<!-- 頁首 -->
		<?php //include_once 'menu.php';  ?>
		<!-- 網站內容 -->
       
		<div class="content">
			<div class="container">
				<!-- 建立第一個 row 空間，裡面準備放格線系統 -->
				<div class="row">
					<!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
					<div class="col-xs-12">
                    <div class="alert text-center">
                    
						<?php if($art):?>
                            
							<h1><?php echo $art['name']; ?></h1>
                                <?php foreach($art as $row):?>
                                <img src='<?php echo $art['image_path']; ?>'
                                <?php endforeach; ?>
                                <br><br>
                                <p>名稱:<?php echo $art['name']; ?></p>
                                <p>尺寸:<?php echo $art['size']; ?></p>
                                <p>媒材:<?php echo $art['material']; ?></p>
                                <p>創作年代:<?php echo $art['create_year']; ?></p>
								<p>價格:<?php echo $art['price']; ?></p>
								
								<?php
											echo "
											<form method='post' action=''>
											<input type='hidden' name='id' value=".$art['id']." />
											<input type='hidden' name='id' value=".$art['image_path']." />
											<input type='hidden' name='id' value=".$art['name']." />
											<input type='hidden' name='id' value=".$art['price']." />
											<button type='submit' class='buy'>加入購物車</button>
											</form>";
											echo $status;
											 

								?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		
		<!-- 頁底 -->
    <?php //include_once 'footer.php'; ?>
	</body>
</html>

