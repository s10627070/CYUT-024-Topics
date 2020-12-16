<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫
require_once 'php/db.php';

//載入 functions.php 檔案，透過裡面的方法取得資料庫的資料
require_once 'php/functions.php';
$datas  = get_all_art();
?>
<!DOCTYPE html> 
<html> 
  <head>
    <title>賞器品茶</title>
    <link rel="icon" type="image/png" sizes="192x192"  href="img/101/favicon-96x96.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>
         body{
           background-color:#E1DBD6;
           }
      </style>
  </head> 
  
  <body> 
    <?php require_once 'menu.php'; ?>
		<div class="content">
			<div class="container">
            <div class="row">
                <?php require_once 'cart/shopping_cart.php'; ?>
           </div>
			</div>
		  </div>
  <?php require_once 'footer.php'; ?>
  </body>
</html>