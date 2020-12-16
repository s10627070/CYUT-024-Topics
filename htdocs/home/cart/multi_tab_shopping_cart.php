<?php   
//require_once 'db.php';
require_once 'php/functions.php';
 //$connect = $_SESSION['link'] ;
 $datas  = get_all_art();
 //print_r ($datas);
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>藏家閣</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
               <ul class="nav nav-tabs">  
                     <li class="active"><a data-toggle="tab" href="#products">產品介紹</a></li>  
                     <li><a data-toggle="tab" href="#cart">購物車 <span class="badge"><?php if(isset($_SESSION["shopping_cart"])) { echo count($_SESSION["shopping_cart"]); } else { echo '0';}?></span></a></li>  
                </ul>  
           <div class="container" style="width:800px;">  

                <div class="tab-content">  
                     <div id="products" class="tab-pane fade in active">  
                     <?php  
                     /*$query = "SELECT * FROM art ORDER BY id ASC";  
                     $result = mysqli_query($connect, $query);  */
                     
                     
                     foreach($datas as $row): 
                     {  
                     ?>  
                     <div class="col-md-4" style="margin-top:12px;">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">  
                               <img src="<?php echo $row["image_path"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                               <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>  
                               <input type="text" name="quantity" id="quantity<?php echo $row["id"]; ?>" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" id="name<?php echo $row["id"]; ?>" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" id="price<?php echo $row["id"]; ?>" value="<?php echo $row["price"]; ?>" />  
                               <input type="button" name="add_to_cart" id="<?php echo $row["id"]; ?>" style="margin-top:5px;" class="btn btn-warning form-control add_to_cart" value="加入購物車" />  
                          </div>  
                     </div>  
                     <?php  
                     } endforeach;  
                     ?>  
                     </div>  <div id="cart" class="tab-pane fade">  
                          <div class="table-responsive" id="order_table">  
                               <?php if(!empty($_SESSION["shopping_cart"]))  {?>
                               <table class="table table-bordered">  
                                    <tr>  
                                         <th width="40%">產品名稱</th>  
                                         <th width="10%">數量</th>  
                                         <th width="20%">單價</th>  
                                         <th width="15%">小計</th>  
                                         <th width="5%"></th>  
                                    </tr>  
                                    <?php  
                                             $total = 0;  
                                             foreach($_SESSION["shopping_cart"] as $keys => $values)  
                                             {                                               
                                        ?>  
                                        <tr>  
                                             <td><?php echo $values["product_name"]; ?></td>  
                                             <td><input type="text" name="quantity[]" id="quantity<?php echo $values["product_id"]; ?>" value="<?php echo $values["product_quantity"]; ?>" data-product_id="<?php echo $values["product_id"]; ?>" class="form-control quantity" /></td>  
                                             <td align="right">$ <?php echo $values["product_price"]; ?></td>  
                                             <td align="right">$ <?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?></td>  
                                             <td><button name="delete" class="btn btn-danger btn-xs delete" id="<?php echo $values["product_id"]; ?>">取消</button></td>  
                                        </tr>  
                                        <?php  
                                                  $total = $total + ($values["product_quantity"] * $values["product_price"]);  
                                             }  
                                        ?>  
                                        <tr>  
                                             <td colspan="3" align="right">總金額</td>  
                                             <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                                             <td></td>  
                                        </tr>  
                                        <tr>  
                                             <td colspan="5" align="center">  
                                                  <form method="post" action="cart/test.php">  
                                                       <input type="submit" name="place_order" class="btn btn-warning" value="送出訂單" />  
                                                  </form>  
                                             </td>  
                                        </tr>  
                                    <?php  
                                    } 
                                    else{
                                       
                                         echo '<h3 class="alert-warning text-center">目前購物車是空的。</h3>';
                                       
                                    } 
                                    ?>  
                               </table>  
                          </div>  
                     </div>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(data){  
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
                          //alert("已添加到購物車");  
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
 });  
 </script>
