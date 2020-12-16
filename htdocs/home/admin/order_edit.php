<?php
require_once '../php/db.php';
require_once '../php/functions.php';
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login'])
{

	header("Location: login.php");
}
$data = get_orderdetail($_GET['i']);
$order = get_order($_GET['i']);
//print_r ($order);
if(is_null($data))
{
	//如果文章是null就轉回列表頁
	header("Location: order_list.php");
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>後台出貨管理</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="shortcut icon" href="../images/favicon.ico">
  </head>
  <body>
    <!-- 頁首 -->
		<?php include_once 'menu.php'; ?>
		
        <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <h3 align="center"">訂單編號&emsp;<?php echo $order['ordersid'];?></h3><br>
          </div>
          <div class="col-xs-12">
            <!-- 資料列表 -->
            <table class="table table-hover" style="text-align:center;">
              <tr>
                <th style="text-align:center;">商品名稱</th>
                <th style="text-align:center;">單價</th>
                <th style="text-align:center;">數量</th>
              </tr>
              <?php if($data):?>
                <?php $total=0; foreach($data as $row): $total=$row['price']*$row['quantity']+$total;?>
                  <tr>
                    <td><?php echo  $row['productname'];?></td>
                    <td><?php echo $row['price'];?></td>
                    <td><?php echo  $row['quantity'];?></td>
                  </tr>
                <?php endforeach;?>
              <?php else:?>
                <tr>
                  <td colspan="5">無資料</td>
                </tr>
              <?php endif;?>
            </table>
            <h3 align="center">顧客資訊</h3>
            <table class="table table-hover">
              <tr>
                <th style="text-align:center;">姓名</th>
                <th style="text-align:center;">電子郵件</th>
                <th style="text-align:center;">地址</th>
                <th style="text-align:center;">電話</th>
                <th style="text-align:center;">支付方式</th>
              </tr>
              <?php if($order):?>
                  <tr>
                    <td style="text-align:center;"><?php echo $order['customername']; ?></td>
                    <td style="text-align:center;"><?php echo $order['customeremail']; ?></td>
                    <td style="text-align:center;"><?php echo $order['customeraddress']; ?></td>
                    <td style="text-align:center;"> <?php echo $order['customerphone']; ?></td>
                    <td style="text-align:center;"><?php echo $order['paytype']; ?></td>
                  </tr>
              <?php else: ?>
                <tr>
                  <td colspan="7">無資料</td>
                </tr>
              <?php endif; ?>
            </table>
            <br><br>
          </div>
          <form id="update_order" class="col-xs-12">
            <div class="form-group col-xs-12" align="center">
                <div class="col-xs-6"><h3>訂單總金額 ：</h3></div>
                <div class="col-xs-6"><h3 style="color:red"><u><?php echo $total;?></u></h3></div>
                <input type="input" class="form-control" style="display:none" id="orderid" value="<?php echo $order['ordersid'];?>">
            </div>
            <div class="form-group col-xs-12" align="center">
                <label class="radio-inline" id="publish">
                  <input type="radio"  name="publish" value="1" <?php echo ($order['ship'] == 1)?"checked":"";?>> 出貨
                </label>
                <label class="radio-inline">
                  <input type="radio"  name="publish" value="0" <?php echo ($order['ship'] == 0)?"checked":"";?>> 取消出貨
                </label>
            </div>
            <div class="form-group col-xs-12" align="center">
            <button type="submit" class="btn btn-primary" align="center">送出</button>
            </div>
            </form>
        </div>
      </div>
    </div>
    <br><br><br><br>
    <!-- 頁底 -->
    <?php include_once 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
    	$(document).on("ready", function(){
   
    		$("#update_order").on("submit", function(){
                console.log($("#orderid").val());
				$.ajax({
	            type : "POST",
	            url : "../php/update_order.php", //因為此檔案是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 add_article.php
	            data : {
	                id:$("#orderid").val(),
	                publish:$("input[name='publish']:checked").val()
	            },
	            dataType : 'html' //設定該網頁回應的會是 html 格式
	          }).done(function(data) {
	            //成功的時候
	            if(data == "yes")
	            {
	              //註冊新增成功，轉跳到登入頁面。
	              alert("更新成功，點擊確認回列表");
	              window.location.href = "order_list.php";
	            }
	            else
	            {
	              alert("更新錯誤");
	            }
	            
	          }).fail(function(jqXHR, textStatus, errorThrown) {
	            //失敗的時候
	            alert("有錯誤產生，請看 console log");
	            console.log(jqXHR.responseText);
	          });
    			
    			return false;
    		});
    	});
    </script>
  </body>
</html>
