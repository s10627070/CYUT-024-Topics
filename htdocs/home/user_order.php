<?php
require_once 'php/db.php';
require_once 'php/functions.php';
if (!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
  header("Location: login.php");
}
if ($_SESSION['login_user_id'] !=$_GET['i'] ){
   header("Location: login.php");
  }
$orderdetail = get_user_order($_GET['i']);
//print_r($orderdetail);
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>我的訂單</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
  </head>

  <body>
		<?php include_once 'menu.php';?>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <h3 align= "center">我的訂單<h3>
          </div>
          <div class="col-xs-12">
            <table class="table table-hover">
              <tr>
                <th >訂單編號</th>
                <th>訂單建立時間</th>
                <th>訂單狀態</th>
              </tr>
              <?php if($orderdetail):?>
                <?php foreach($orderdetail as $order):?>
                  <tr>
                    <td><a href='user_order_detil.php?i=<?php echo $order['ordersid']; ?>'><?php echo $order['ordersid']; ?></a></td>
                    <td><?php echo $order['create_date']; ?></td>
                    <?php if( $order['ship'] == 0){?>
                    <td><a style="color:red;">尚未出貨</a></td>
                    <?php } else{?>
                      <td><a style="color:green;">已出貨</a></td>
                    <?php }?>
                  </tr>
                <?php endforeach; ?>
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
    <?php
      include_once 'footer.php';
 ?>
  </body>
</html>
