<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫
require_once 'php/db.php';
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
	<title>會員註冊</title>
	<link rel="icon" type="image/png" sizes="192x192"  href="img/101/favicon-96x96.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="shortcut icon" href="images/favicon.ico">
  </head>

  <body>
    <!-- 頁首 -->
    <?php
      include_once 'menu.php';
    ?>
    <!-- 網站內容 -->
    <div class="content">
		<div class="row">
			<div class="col-xs-3"></div>
			<div class="col-xs-6"><h1 class= "alert-info text-center">會員註冊</h1></div>
			<div class="col-xs-3"></div>
		</div>
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-sm-offset-4">
            <form class="register" method="post" action="php/add_user.php"  >
              <div class="form-group">
                <label for="username">帳號</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="請輸入帳號" required>
              </div>
              <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="請輸入密碼" required>
              </div>
              <div class="form-group">
                <label for="confirm_password">確認密碼</label>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="請再次輸入密碼" required>
              </div>
              <div class="form-group">
                <label for="name">暱稱</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="請輸入您的暱稱" required>
              </div>
              <div class="form-group">
                <label for="name">E-mail</label>
                <input type="email" class="form-control" id="mail" name="mail" placeholder="請輸入您的信箱" required>
              </div>
              <div class="form-group">
                <label for="name">手機號碼</label>
                <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" placeholder="請輸入您的手機號碼" required>
              </div>
              <button type="submit" name="submit" class="btn btn-default">
                註冊
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
	<script>
    </script>
  </body>
</html>
