<?php
require_once '../php/db.php';
require_once '../php/functions.php';
if (!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{
  header("Location: login.php");
}

$orders = get_all_order();
//print_r ($orders);
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>訂單管理</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/favicon.ico">
  </head>

  <body>
		<?php
      include_once 'menu.php';
 ?>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <h3 align="center">訂單處理</h3>
          </div>
          <div class="col-xs-12">
            <table class="table table-hover">
              <tr>
                <th>訂單編號</th>
                <th>總計</th>
                <th>姓名</th>
                <th>電話</th>
                <th>支付方式</th>
                <th>訂單建立時間</th>
                <th>付款狀態</th>
                <th>付款狀態</th>
                <th>出貨處理</th>
              </tr>
              <?php if($orders):?>
                <?php foreach($orders as $order):?>
                  <tr>
                    <td><a href="order_edit.php?i=<?php $ordersid = $order['ordersid']; echo $ordersid;?>"><?php echo $order['ordersid']; ?></a></td>
                    <td><?php echo $order['total']; ?></td>
                    <td><?php echo $order['customername']; ?></td>
                    <td><?php echo $order['customerphone']; ?></td>
                    <td><?php echo $order['paytype']; ?></td>
                    <td><?php echo $order['create_date']; ?></td>
                    <?php if($order['paystatus']== 0) :?>
                      <td><a class='btn btn-danger'>未付款</a></td>
                      <td> <a href='javascript:void(0);' class='btn btn-info upd_pay'  value="1" data-id="<?php echo  $order['ordersid']; ?>">確認收款</a></td>
                    <?php else: ?>
                      <td><a class='btn btn-success'>已付款</a></td>
                      <td><a href='javascript:void(0);' class='btn btn-warning upd_pay'  value="0" data-id="<?php echo  $order['ordersid']; ?>">取消收款</a></td>
                    <?php endif; ?>
                    <?php 
                      if($order['ship'] ==0){                       
                        echo "<td><a href='order_edit.php?i=$ordersid'class='btn btn-warning'>未出貨</a></td>";
                      }
                      else{
                        $ordersid = $order['ordersid'];
                        echo "<td><a href='order_edit.php?i=$ordersid'class='btn btn-success'>已出貨</a></td>";
                      }
                    ?>
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
    <?php include_once 'footer.php';?>
  </body>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
      $(document).on("ready", function() {
        $("a.upd_pay").on("click", function() {
          var v = $(this).attr("value");
          if (v == 0) { 
            var c = confirm("您確定取消收款？");
          }
          else{
            var c = confirm("您確定收到款項了嗎？");
          }
         
          if (c) {
            $.ajax({
              type : "POST",
              url : "../php/update_pay.php", 
              data : {
              id : $(this).attr("data-id"), 
              pay: $(this).attr("value"), 
              },
              dataType : 'html' 
            }).done(function(data) {
              //成功的時候

              if (data == "yes") {
                alert("更新成功");
                location.reload();
              } else {
                alert("更新錯誤!狀態重複");
              }

            }).fail(function(jqXHR, textStatus, errorThrown) {
              //失敗的時候
              alert("有錯誤產生，請看 console log");
              console.log(jqXHR.responseText);
            });
          }

          return false;
        });
      });
    </script>
</html>

