<?php
    require_once '../php/db.php';
    require_once '../php/functions.php';
    $art =get_art(5);
    //print_r ($art);
    $data = get_user($_SESSION['login_user_id']);
    //print_r ( $data);
    if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
        echo '<script>alert("請先登入");window.location.href="../login.php"</script>' ;}
?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="UTF-8">
    <title>購物車</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="icon" type="image/png" sizes="192x192"  href="../img/101/favicon-96x96.png"> 
</head>
<body>
<?php require_once 'cart_menu.php'; ?>
<br><h2 align="center">我的購物車 </h2>
<br>
<div  class= "row " id="cart" >
    <div class= "col-xs-2"></div>
    <div class="col-xs-8 table-responsive " id="order_table">
        <?php if(!empty($_SESSION["shopping_cart"])) {?>
            <table class="table table-bordered col-sm-12" >
                <tr  > 
                    <th width="35%" style="text-align:center">
                        商品
                    </th>
                    <th width="5%" style="text-align:center">
                        數量
                    </th>
                    <th width="20%" style="text-align:center">
                        單價
                    </th>
                    <th width="20%" style="text-align:center">
                        總計
                    </th>
                    <th width="5%"style="text-align:right">
                    </th>
                </tr>
                <?php $total=0 ; foreach($_SESSION["shopping_cart"] as $keys=>$values) {   $art =get_art($values["product_id"]); //print_r ($art);?>
                    <tr style="border-top: 2px #91877F solid;">
                        <td >
                            <div class = "col-sm-6"><img src="../<?php echo $art["image_path"]; ?>"  class="img-thumbnail"  width="150px" height="105px" /></div>
                            <div class = "col-sm-6" style="margin-top:2.5em; text-align:center;"><?php echo $values[ "product_name"]; ?></div>
                            
                        </td>
                        <td  >
                            <input onKeypress="return (/[\d]/.test(String.fromCharCode(event.keyCode)))"  type="number" min="1" max="<?php echo $art["stock"]; ?>" name="quantity" id="quantity<?php echo $values["product_id"]; ?>" value="<?php echo $values["product_quantity"]; ?>"
                            data-product_id="<?php echo $values["product_id"]; ?>" class="form-control quantity " style="width: 50px; margin-top:2.5em;"/>
                        </td>
                        <td align="center" >
                            <div class = "col-sm-12" style="margin-top:2.5em;"></div>
                            $ <?php echo number_format($values["product_price"],0); ?>
                        </td>
                        <td align="center">
                        <div class = "col-sm-12" style="margin-top:2.5em;">$ <?php echo number_format($values["product_quantity"] * $values["product_price"], 0); ?></div>
                        </td>
                        <td>
                            <div class = "col-sm-12" style="margin-top:2.5em;"><button name="delete" class="btn btn-danger btn-xs delete" id="<?php echo $values["product_id"]; ?>">取消</button></div> 
                        </td>
                    </tr>
                    <?php  $total = $total + ($values["product_quantity"] * $values["product_price"]); }?> 
                    <tr style="border-top: 2px #91877F solid;">
                        <td colspan="3" ><h4><div class="col-sm-12" align="right">總金額：<div></h4></td>
                        <td ><div class="col-sm-2" style="color:red; "><h4><u>$<?php echo number_format($total, 0); ?></u><h4><div></td>
                        <td > <div class="col-sm-2"><button  class="btn  btn-xs  btn-info " id="clear_cart"  style="margin-top:0.5em;" ><span class="glyphicon glyphicon-trash"></span>&ensp; 清空</button></div></td>
                    </tr> 
                    <tr> 
                        <td style="border-top: 2px #91877F solid; border-bottom: 2px #91877F solid;" colspan="5"> 
                        <h3 align="center">運送資訊</h3>
                        <div class="col-xs-12 col-sm-6 col-sm-offset-3" style="border-top: 2px #91877F dashed;"><br>
                            <form method="post" action="../php/add_order.php">
                                <div class="form-group">
                                <label class="control-label" for="name">姓名：</label>
                                <input class="form-control" type="text" name="customername" id="customername"  value="<?php echo $data["name"];?>" placeholder="請輸入您的姓名..." required>
                                </div>
                                <div class="form-group">
                                <label class="control-label" for="email">信箱：</label>
                                <input class="form-control" type="email" name="customeremail" id="customeremail"  value="<?php echo $data['mail'];?>" placeholder="請輸入E-mail..." > 
                                </div>
                                <div class="form-group">
                                <label class="control-label" for="phone">電話：</label>
                                <input class="form-control" type="tel" name="customerphone" id="customerphone" value="<?php echo $data["phone"];?>" pattern="[0-9]{10}"  placeholder="請輸入您的電話..." required>
                                </div>
                                <div class="form-group">
                                <label class="control-label" for="address">收件地址：</label>
                                <input class="form-control" name="customeraddress" type="text" id="customeraddress" placeholder="請輸入您的住址..." required>
                                </div>
                                <div class="form-group">
                                <label class="control-label" for="paytype">付款方式：</label>
                                <select name="paytype" id="paytype" class="form-control">
                                    <option value="ATM匯款" selected>ATM匯款</option>
                                    <option value="線上刷卡">線上刷卡</option>
                                </select>
                                </div><br>
                                <div class="form-group">
                                <input class="form-control" type="submit" name="place_order" class="btn btn-warning" value="送出訂單"/>
                                </div>                
                            </form> 
                        </td>
                        </div>
                    </tr>

                    <?php } else{ echo'<h3 class="text-center col-xs-12" style="color:#91877F;">目前購物車是空的。</h3>'; } ?>
        </table>
    </div>                            
</div> 
<?php require_once '../footer.php' ?>
</body>
</html>                                               
<script>  
 $(document).ready(function(data){ 
    $('input[name=quantity]').on('keypress', function(){  
        location.reload();
    });
      $(document).on('click', '.delete', function(){  
           var product_id = $(this).attr("id");  
           var action = "remove";  
           if(confirm("您確定要取消這項商品嗎?"))  
           {  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                          location.reload();
                     }  
                });  
           }  
           else  
           {  
                return false;  
           }  
      });  
      $(document).on('keyup', '.quantity', function(){  
            event.target.value = event.target.value.replace(/\-/g,""); 
           var product_id = $(this).data("product_id");  
           var quantity = $(this).val();  
           var action = "quantity_change";  
           if(quantity != '')  
           {  
                $.ajax({  
                     url :"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, quantity:quantity, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                     }  
                });  
           }  
      }); 
      $(document).on('click', '#clear_cart', function(){
		var action = 'empty';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action},
			success:function()
			{
                alert("購物車已清空");
                window.location.href="/";
			}
		});
	});

 });  
 </script>
   <script>
    /*setInterval(function() {
        $("#order_table").load(location.href+" #order_table>*");
        $("ul").load(location.href+" ul>*");
      }, 1300);*/
  </script>
