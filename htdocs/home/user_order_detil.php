<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫，另外後台都會用 session 判別暫存資料，所以要請求 db.php 因為該檔案最上方有啟動session_start()。
require_once 'php/db.php';
require_once 'php/functions.php';
//print_r($_SESSION); //查看目前session內容

//如過沒有 $_SESSION['is_login'] 這個值，或者 $_SESSION['is_login'] 為 false 都代表沒登入
if (!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
  header("Location: login.php");
}
else{
  $id = $_GET['i'];
  $orders = get_user_orders($id);
  $user_order = user_order($id);
  if($orders){
    if ($_SESSION['login_user_id'] !=$orders['uid'] ){
      header("Location: /");
     }
  }
  else{
    header("Location: / ");
  }
}


//print_r ($user_order);
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>我的詳細訂單</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="shortcut icon" href="../images/favicon.ico">
  </head>
  <style>
    th,td{
      font-size:20px;
    }
  </style>
  <body>
    <!-- 頁首 -->
		<?php
      include_once 'menu.php';
 ?>
		
    <!-- 網站內容 -->
    <div class="content">
      <div class="container">
        <!-- 建立第一個 row 空間，裡面準備放格線系統 -->
        <div class="row">
          <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
          <div class="col-xs-12">
            <h3 align="center" >訂單<?php echo  $_GET['i']; ?></h3><br>
          </div>
          <div class="col-xs-12"style="border-top:5px gray dotted; ">
            <!-- 資料列表 -->
            <table class="table table-hover" style=" margin-top:10px;">
              <tr>
                <th >收件地址</th>
              </tr>
              <?php if($orders):?>
                  <tr>
                    <td style="color:gray;"><?php echo $orders['customername']; ?><br><?php echo $orders['customerphone']; ?><br><br><?php echo $orders['customeraddress']; ?></td>
                  </tr>
              <?php else: ?>
                <tr>
                  <td colspan="3">無資料</td>
                </tr>
              <?php endif; ?>
            </table>
          </div>
        </div>
        <div class="row">
          <!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
          <div class="col-xs-12">
            <h3 align="center" style="border-top:5px gray dotted; "><br>訂單內容</h3>
          </div>
          <div class="col-xs-12">
            <!-- 資料列表 -->
            <table class="table table-hover">
              <tr>
                <th width="50%">產品名稱</th>
                <th width="20%" >數量</th>
                <th  width="30%" style="text-align:right" >單價</th>
              </tr>
              <?php if($orders):?>
                <?php foreach($user_order as $row):?>
                  <tr>
                    <td><?php echo $row['productname']; ?></td>
                    <td>&ensp;&ensp;<?php echo $row['quantity']; ?></td>
                    <td  align="right"><?php echo $row['price']; ?></td>
                  </tr>  
                <?php endforeach; ?>
                <tr>
                <td></td>
                <td>總計</td>
                <td align="right"  style="border-top:1.5px black double;" ><h4  style="color:red;"><u><?php echo $orders['total']; ?></u></h4></td>
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td align="right" ><h4><div class="col-sm-6" style="padding:0; margin-top:15px;">付款方式</div><div class="col-sm-6" style="padding:0; margin-top:15px;"><?php echo $orders['paytype']; ?></div></h4></td>
                </tr>
              <?php else: ?>
                <tr>
                  <td colspan="9">無資料</td>
                </tr>
              <?php endif; ?>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- 頁底 -->
    <?php
      include_once 'footer.php';
 ?>
  </body>
</html>
