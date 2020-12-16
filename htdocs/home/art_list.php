<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫
require_once 'php/db.php';

//載入 functions.php 檔案，透過裡面的方法取得資料庫的資料
require_once 'php/functions.php';

$datas = get_publish_art();
?>
<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<title>藝術品列表</title>
    <link rel="icon" type="image/png" sizes="192x192"  href="img/101/favicon-96x96.png">
		<meta charset="utf-8">
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

		<!-- 網站內容 -->
		<div class="content">
			<div class="container">
				<!-- 建立第一個 row 空間，裡面準備放格線系統 -->
                <div class="row">
                <?php if(!empty($datas)):?>
                <?php foreach($datas as $row):?>
                <!-- 使用 bootstrap 的 Thumbnails 來呈現 http://getbootstrap.com/components/#thumbnails -->
                <!-- 在 xs 尺寸，佔12格，在 sm 以上站 3 隔，一排可放4個。可參考 http://getbootstrap.com/css/#grid 說明-->
                <div class="col-xs-12 col-sm-4">
                  <div class="thumbnail">
                    <img src='<?php echo $row['image_path']; ?>' class="img-responsive" width="400">
                    <p>名稱:<?php echo $row['name']; ?></p>
                    <p>尺寸:<?php echo $row['size']; ?></p>
                    <p>媒材:<?php echo $row['material']; ?></p>
                    <p>創作年代:<?php echo $row['create_year']; ?></p>
                    <p>價格:<?php echo $row['price']; ?></p>
                    <?php
                      if(isset($_SESSION['is_login']) && $_SESSION['is_login'])
                      {
                        echo '<a href="art.php?p=';
                        echo $row['id']; 
                        echo '" class="btn btn-primary stretched-link">購買</a>';
                       
                      }
                    ?> 
                  </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <h3 class="text-center">尚無藝術品</h3>
                <?php endif; ?>
              </div>
			</div>
		  </div>
		<!-- 頁底 -->

	</body>
</html>
