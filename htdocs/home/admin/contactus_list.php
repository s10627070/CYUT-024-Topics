<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，另外後台都會用 session 判別暫存資料，所以要請求 db.php 因為該檔案最上方有啟動session_start()。
require_once '../php/db.php';
require_once '../php/functions.php';
//print_r($_SESSION); //查看目前session內容

//如過沒有 $_SESSION['is_login'] 這個值，或者 $_SESSION['is_login'] 為 false 都代表沒登入
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
	//直接轉跳到 login.php
	header("Location: login.php");
}

//取得所有文章
$contactus = get_all_contactus();
//print_r ($contactus);
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>後台顧客訊息列表</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="shortcut icon" href="../images/favicon.ico">
  </head>

  <body>
    <!-- 頁首 -->
		<?php include_once 'menu.php'; ?>
		
    <!-- 網站內容 -->
    <div class="content">
      <div class="container">
        <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
        <div class="row">
          <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
          <div class="col-xs-12" style ="margin-top:20px;">
            <!-- 資料列表 -->
            <table class="table table-hover">
              <tr>
                <th>姓名</th>
                <th>手機號</th>
                <th>信箱</th>
                <th>訊息內容</th>
                <th>傳送日期</th>
              </tr>
              <?php if($contactus):?>
                <?php foreach($contactus as $contactus):?>
                  <tr>
                    <td><?php echo $contactus['name'];?></td>
                    <td><?php echo $contactus['tel'];?></td>
                    <td><?php echo $contactus['mail'];?></td>
                    <td><?php echo $contactus['mes'];?></td>
                    <td><?php echo $contactus['create_date'];?></td>
                  </tr>
                <?php endforeach;?>
              <?php else:?>
                <tr>
                  <td colspan="5">無資料</td>
                </tr>
              <?php endif;?>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- 頁底 -->
    <?php include_once 'footer.php'; ?>
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  </body>
</html>
