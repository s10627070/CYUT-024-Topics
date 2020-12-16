<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，因為此檔案放在 admin 裡，要找到 db.php 就要回上一層 ../php 裡面才能找到
require_once 'php/db.php';
//如過有 $_SESSION['is_login'] 這個值，以及 $_SESSION['is_login'] 為 true 都代表已登入
if(isset($_SESSION['is_login']) && $_SESSION['is_login'])
{
  
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>忘記密碼</title>
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
    <?php
      include_once 'menu.php';
    ?>
    <!-- 網站內容 -->
    <div class="row">
            <div class="col-xs-3"></div>
            <div class="col-xs-6"><h1 class= "alert-info text-center">忘記密碼</h1></div>
            <div class="col-xs-3"></div>
        </div><br>
    <div class="content">
      <div class="container">
        <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
        <div class="row">
          <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
          <div class="col-xs-12 col-sm-4 col-sm-offset-4">
            <form method="post" action="php/forget_pas.php" >
              <div class="form-group">
                <h3 align = "center"><label for="email">信箱</label><h3>
                <input type="text" class="form-control" id="email" name="email" placeholder="請輸入Email" required>
              </div>
              <button type="submit" class="btn btn-primary col-xs-12">送出</button><br><br><br>
              <div class= "col-xs-12" align = "center"><a href = "login.php">返回登入頁</a><div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- 在表單送出前，檢查確認密碼是否輸入一樣 -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  </body>
</html>
