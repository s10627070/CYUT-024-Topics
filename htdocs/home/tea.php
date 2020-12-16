<?php
//載入 db.php 檔案，讓我們可以透過它連接資料庫
require_once 'php/db.php';
//載入 functions.php 檔案，透過裡面的方法取得資料庫的資料
require_once 'php/functions.php';
//require_once 'mycart.php';
//print_r($_SESSION);
$art = get_art($_GET['p']);
//print_r ($art);
?>
<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<title><?php echo $art['name']; ?></title>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" sizes="192x192"  href="img/101/favicon-96x96.png">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- 給行動裝置或平板顯示用，根據裝置寬度而定，初始放大比例 1 -->	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 載入 bootstrap 的 css 方便我們快速設計網站-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="shortcut icon" href="images/favicon.ico">
	</head>
	<style>
		#quantity{  
			background:#fafdfe;  
			height:25px;  
			width:50px;  
			line-height:28px;  
			border:1px solid #9bc0dd;  
			-moz-border-radius:2px;  
			-webkit-border-radius:2px;  
			border-radius:2px;  
		}  
	</style>
	<body>
		<!-- 頁首 -->
		<?php include_once 'menu.php';  ?>
		<!-- 網站內容 -->
       
		<div class="content">
			<div class="container">
				<!-- 建立第一個 row 空間，裡面準備放格線系統 -->
				<div class="row" name= "order_table">
					<!-- 在 xs 尺寸，佔12格，可參考 http://getbootstrap.com/css/#grid 說明-->
						<div class="text-center col-sm-6">
							<img src="<?php echo $art["image_path"]; ?>"  class="img-thumbnail"  width="600" height="500" style="margin-top:20px" />
						</div>
                    	<div class=" col-sm-6" >     
								<h2 align = "center">商品名稱</h2> 
								<h3 class="text-info" align = "center"><?php echo $art["name"]; ?></h3> 
								<div class="col-xs-7" align = "center">
								<h4>作者:</h4>
								<h4>尺寸:</h4>
								<h4>媒材:</h4>
								<h4>年份:</h4>
								<h4>金額:</h4>
								</div>
							   	<div  class="col-xs-5" style="text-align:left;">
								<h4 ><?php echo $art['artist']; ?></h4>
							   	<h4 ><?php echo $art['size']; ?></h4> 
								<h4><?php echo $art['material']; ?></h4>
								<h4><?php echo $art['create_year']; ?></h4>
								<h4 class="text-danger">$ <?php echo number_format($art["price"],0); ?></h4>
								<input type="number" name="stock" class="stock" id="stock" class="form-control" value="<?php echo $art["stock"]; ?>"style="display: none" />
                                <input type="hidden" name="hidden_name" id="name<?php echo $art["id"]; ?>" value="<?php echo $art["name"]; ?>" />
                                <input type="hidden" name="hidden_price" id="price<?php echo $art["id"]; ?>" value="<?php echo $art["price"]; ?>" />
								</div>
								<div class="col-sm-12" align = "center">數量：&emsp; <select  id="quantity"> </select></div>
								<div id= "stock_quantity"><h5 style="display: none" >庫存數量:&emsp;<?php echo $art["stock"]; ?></h5></div>
								<div class="col-sm-12" style="margin-top:20px"><input type="button" name="add_to_cart" id="<?php echo $art["id"]; ?>"  style="margin-top:5px;" class="btn btn-warning form-control add_to_cart" value="加入購物車" /></div>            
						</div>
				</div>
				<div class="col-sm-12" align = "center" style="margin-top:5em;"><h4>商品詳細資訊</h4></div>
				<div class="col-sm-12">
					<div class="col-sm-12" align = "center" style="border-top:2px white solid;"><br><h4><?php echo nl2br($art['Introduction']); ?></h4><br></div>
					<?php if(!empty($art["image_path1"])):?>
					<div class="col-sm-3"></div>
					<div class="col-sm-6"><img src="<?php echo $art["image_path1"]; ?>"  class="img-thumbnail"></div>
					<div class="col-sm-3" ></div>
					<div class="col-sm-12" style="border-bottom:2px white solid;" ><br> </div>
					<?php else: ?>
					<h4 class="text-center">尚無圖片</h4>
					<?php endif; ?>
					<div class="col-sm-12" align = "center"  ><br><h4>每一件藏品的價值，都是獨一無二。歡迎「預約」賞作。</h4></div>
				</div>

			</div>
		</div>

                        
		<!-- 頁底 -->
    <?php include_once 'footer.php'; ?>
	</body>
</html>
<?php
	for($i=0;$i<$art["stock"]+1;$i++){    
	echo "<script type=\"text/javascript\">";
	echo "document.getElementById(\"quantity\").options[$i]=new Option(\"$i\",\"$i\");";
	echo "</script>";
	}
?> 
<script>  
$(document).ready(function(){
	//console.log($("#quantity").val());
	$('.add_to_cart').click(function(){ 
        var product_id = $(this).attr("id");   
        var product_name = $('#name'+product_id).val();  
        var product_price = $('#price'+product_id).val();  
        var product_quantity = $('#quantity').val();  
		var stock = $('#stock').val();
		var action = "add";
		console.log(stock);
		console.log(product_quantity);
		if(product_quantity > 0)  
        {  
			if(stock >= product_quantity ){
			$.ajax({  
                  url:"cart/action.php",  
                  method:"POST",  
                  dataType:"json",  
                  data:{  
                       product_id:product_id,   
                       product_name:product_name,   
                       product_price:product_price,   
                       product_quantity:product_quantity,   
                       action:action  
                  },  
                  success:function(data)  
                  {  
                       $('#order_table').html(data.order_table);  
                       $('.badge').text(data.cart_item);  
                       alert("已添加到購物車");  
                  }  
             }); 
		}
		else{
			console.log(stock);
			alert("庫存不足");
		}
        }  
        else  
        {  
             alert("請輸入數量")  
        }  
 
   });
   
});
setInterval(function() {$(" #cart ").load(location.href+" #cart>*"); }, 2000);
setInterval(function() {$(" #stock_quantity ").load(location.href+" #stock_quantity>*"); }, 6000);

</script>

