<?php   
require_once 'php/db.php';
require_once 'php/functions.php';
 //$connect = $_SESSION['link'] ;
 $datas  = get_publish_art();
 //print_r ($datas);
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>藏家閣</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
           
           <style> .thumbnail:hover{transform: scale(1.05);}}
          
          </style>
      </head>  
      <body>  
      <h2 align="center">藝術家作品 <?php require_once 'nav.php'?></h2>
      <div class="container">
          <div class="row" >
           <div class="col-xs-1"></div>     
           <div class="container col-xs-12 col-sm-10" >  
                <div class="tab-content" >  
                     <div id="products" class="tab-pane fade in active" >  
                     <?php  
                     foreach($datas as $row): //onclick="location.href='tea.php?p=<?php echo $row['id'];
                     {  
                     ?>  
                     <div class="col-xs-12 col-sm-4" style="margin-top:12px;  " > 
                     <div class="thumbnail" style="border:2px solid #cccccc; background-color:#CDC5C2; border-radius:5px; padding:16px; height:28em;" align="center" >  
                              <div class="col-sm-12 col-xs-12" style="height:22em; ">
                               <a href="tea.php?p=<?php echo $row['id'];?>" style="text-decoration:none; color:black;" target="_blank" >
                               <img src='<?php echo $row['image_path']; ?>' width="280px" height="200px" class="rounded"><br>  
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4> 
                               <h5>尺寸:<?php echo $row['size']; ?></h5> 
                               <h5>媒材:<?php echo $row['material']; ?></h5> 
                               <h5>年份:<?php echo $row['create_year']; ?></h5>
                               </a>
                               <?php
                               if(isset($_SESSION['is_login']) && $_SESSION['is_login']){?>
                                   <h4 class="text-danger" >$ <?php echo number_format($row["price"],0); ?></h4>
                                   <input type="number" name="stock" class="stock" id="stock" class="form-control" value="<?php echo $row["stock"]; ?>"style="display: none" />
                                   <input type="number" name="quantity" id="quantity<?php echo $row["id"]; ?>" class="form-control" value="1" min = "1" max = "<?php echo $row["stock"]; ?>" style="display: none" /> 
                                   <input type="hidden" name="hidden_name" id="name<?php echo $row["id"]; ?>" value="<?php echo $row["name"]; ?>" /> 
                                   <input type="hidden" name="hidden_price" id="price<?php echo $row["id"]; ?>" value="<?php echo $row["price"]; ?>" />
                              </div>
                              <div class="col-sm-12 col-xs-12" >
                                   <!--<a href="tea.php?p=<?php echo $row['id'];?>" target="_blank"><button type="button" class="btn btn-primary">詳細資料</button></a>-->
                                   <input type="button" name="add_to_cart" id="<?php echo $row["id"]; ?>" style="margin-top:5px;" class="btn btn-warning form-control add_to_cart" value="加入購物車" />
                               <?php 
                               }
                               else{ echo '<br><h4 class="text text-warning">登入後即可<br>觀看詳細資料</h4>';}
                               ?>
                               </div>
                          </div>  

                     </div>  
                     <?php  
                     } endforeach;  
                     ?>  
                     </div>  
                     <div id="popover_content_wrapper" style="display: none; ">
                          <span id="cart_details"></span>
                         <div align="center" style = "width:250px;" >
                              <a href="cart/cart.php" target="_blank" class="btn btn-default">
                              <span class="fa fa-shopping-cart"></span> 查看我的購物車
                              </a>
                              <a href="#" class="btn btn-default" id="clear_cart">
                              <span class="glyphicon glyphicon-trash"></span> 全部清空
                              </a>
                         </div>
			     </div>
                </div>  
               </div>
              <div class="col-xs-1"></div>
           </div> 
          </div>
      </body>  
 </html>
 <?php
      //print_r ($datas);
      /*$shopCodeArr=array();     //用來存哪些選項的陣列
      $shopCount=0;
      foreach($datas as $row){
          $shopCodeArr[$shopCount]=$row['stock'];
          $shopCount++;
      }
      print_r ($shopCodeArr);
     
      for($i=0;$i<count($shopCodeArr);$i++)
      {
          echo "<script type=\"text/javascript\">";
          echo "document.getElementById(\"shopList\").options[$i]=new Option(\"$shopCodeArr[$i]\",\"$shopCodeArr[$i]\");";
          echo "</script>";
      }*/
 
 ?>  
 <script>  
 $(document).ready(function(){
load_product();

load_cart_data();

function load_product()
{
     $.ajax({
          url:"cart/fetch_item.php",
          method:"POST",
          success:function(data)
          {
               $('#display_item').html(data);
          }
     });
}

function load_cart_data()
{
     $.ajax({
          url:"cart/fetch_cart.php",
          method:"POST",
          dataType:"json",
          success:function(data)
          {
               $('#cart_details').html(data.cart_details);
               $('.total_price').text(data.total_price);
               $('.badge').text(data.total_item);
          }
     });
     }
     $('#cart-popover').popover({
          html : true,
     container: 'body',
     content:function(){
          return $('#popover_content_wrapper').html();
     }
     });

     $('.add_to_cart').click(function(){  
     var product_id = $(this).attr("id");  
     var product_name = $('#name'+product_id).val();  
     var product_price = $('#price'+product_id).val();  
     var product_quantity = $('#quantity'+product_id).val();  
     var action = "add";  
     if(product_quantity > 0)  
     {  
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
                    location.reload()
               }  
          });  
     }  
     else  
     {  
          alert("請輸入數量")  
     }  
     });  
     $(document).on('click', '.delete', function(){  
     var product_id = $(this).attr("id");  
     var action = "remove";  
     if(confirm("您確定要取消這項商品嗎?"))  
     {  
          $.ajax({  
               url:"cart/action.php",  
               method:"POST",  
               dataType:"json",  
               data:{product_id:product_id, action:action},  
               success:function(data){  
                    load_cart_data();
                    $('#cart-popover').popover('hide');
                    $('#order_table').html(data.order_table);  
                    $('.badge').text(data.cart_item);  
                    
               }  
          });  
     }  
     else  
     {  
          return false;  
     }  
     });  
     $(document).on('keyup', '.quantity', function(){  
     var product_id = $(this).data("product_id");  
     var quantity = $(this).val();  
     var action = "quantity_change";  
     if(quantity != '')  
     {  
          $.ajax({  
               url :"cart/action.php",  
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
			url:"cart/action.php",
			method:"POST",
			data:{action:action},
			success:function()
			{
				load_cart_data();
				$('#popover_content_wrapper').popover('hide');
				alert("您的購物車已清空");
			}
		});
	});

});


 </script>
