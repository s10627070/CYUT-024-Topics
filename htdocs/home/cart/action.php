<?php  
require_once '../php/db.php';
require_once '../php/functions.php';
 
 if(isset($_POST["product_id"]))  
 {  
      $order_table = '';  
      $message = '';  
      if($_POST["action"] == "add")  
      {  
           if(isset($_SESSION["shopping_cart"]))  
           {  
                $is_available = 0;  
                foreach($_SESSION["shopping_cart"] as $keys => $values)  
                {  
                     if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
                     {  
                          $is_available++;  
                          $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];  
                     }  
                }  
                if($is_available < 1)  
                {  
                     $item_array = array(  
                          'product_id'               =>     $_POST["product_id"],  
                          'product_name'               =>     $_POST["product_name"],  
                          'product_price'               =>     $_POST["product_price"],  
                          'product_quantity'          =>     $_POST["product_quantity"]  
                     );  
                     $_SESSION["shopping_cart"][] = $item_array;  
                }  
           }  
           else  
           {  
                $item_array = array(  
                     'product_id'               =>     $_POST["product_id"],  
                     'product_name'               =>     $_POST["product_name"],  
                     'product_price'               =>     $_POST["product_price"],  
                     'product_quantity'          =>     $_POST["product_quantity"]  
                );  
                $_SESSION["shopping_cart"][] = $item_array;  
           }  
      }  
      if($_POST["action"] == "remove")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["product_id"] == $_POST["product_id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     $message = '<label class="text-success">已移除商品</label>';  
                }  
           }  
      } 
      if($_POST["action"] == "quantity_change")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
                {  
                     $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_POST["quantity"];  
                }  
           }  
      } 
      $order_table .= '  
           '.$message.'  
           <table class="table table-bordered">  
               <tr>
                    <th width="50%" style="text-align:center">
                         產品名稱
                    </th>
                    <th width="10%" style="text-align:center">
                         數量
                    </th>
                    <th width="10%" style="text-align:right">
                         單價
                    </th>
                    <th width="10%" style="text-align:right">
                         小計
                    </th>
                    <th width="5%"style="text-align:right">
                    </th>
               </tr> 
           ';  
      if(!empty($_SESSION["shopping_cart"]))  
      {  
           $total = 0;  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {   $art =get_art($values["product_id"]);
               $stock =$art["stock"];
                $order_table .= '  
                     <tr>  
                          <td>'.$values["product_name"].'</td>  
                          <td><input type="number" min="1" max="'.$stock.'"  name="quantity[]" id="quantity'.$values["product_id"].'" value="'.$values["product_quantity"].'" class="form-control quantity" data-product_id="'.$values["product_id"].'" /></td>  
                          <td align="right">$ '.$values["product_price"].'</td>  
                          <td align="right">$ '.number_format($values["product_quantity"] * $values["product_price"], 2).'</td>  
                          <td><button name="delete" class="btn btn-danger btn-xs delete" id="'.$values["product_id"].'">取消</button></td>  
                     </tr>  
                ';  
                $total = $total + ($values["product_quantity"] * $values["product_price"]);  
           }  
           $order_table .= '  
                <tr>  
                     <td colspan="3" align="right"> 總金額</td>  
                     <td align="right">$ '.number_format($total, 2).'</td>  
                     <td>
                     <button  class="btn  btn-xs  btn-info " id="clear_cart" ><span class="glyphicon glyphicon-trash"></span>&ensp; 清空</button>
                     </td> 
                </tr>  
                <tr>
                            <td colspan="5" align="center">
                                <form method="post" action="../php/add_order.php">
                                <table width="90%" border="0" align="center" cellpadding="4" cellspacing="1">
                                    <tr>
                                        <th width="20%" bgcolor="#ECE1E1"><p>姓名</p></th>
                                        <td bgcolor="#F6F6F6"><p>
                                            <input type="text" name="customername" id="customername" placeholder="請輸入您的姓名..." required>
                                            <font color="#FF0000">*</font></p></td>
                                    </tr>
                                    <tr>
                                        <th width="20%" bgcolor="#ECE1E1"><p>電子郵件</p></th>
                                        <td bgcolor="#F6F6F6"><p>
                                            <input type="email" name="customeremail" id="customeremail" placeholder="請輸入E-mail..." > 
                                            <font color="#FF0000">*</font></p></td>
                                    </tr>
                                    <tr>
                                        <th width="20%" bgcolor="#ECE1E1"><p>電話</p></th>
                                        <td bgcolor="#F6F6F6"><p>
                                            <input type="text" name="customerphone" id="customerphone" pattern="[0-9]{10}"  placeholder="請輸入您的電話..." required>
                                            <font color="#FF0000">*</font></p></td>
                                    </tr>
                                    <tr>
                                        <th width="20%" bgcolor="#ECE1E1"><p>住址</p></th>
                                        <td bgcolor="#F6F6F6"><p>
                                            <input name="customeraddress" type="text" id="customeraddress" size="40" placeholder="請輸入您的住址..." required>
                                            <font color="#FF0000">*</font></p></td>
                                    </tr>
                                    <tr>
                                        <th width="20%" bgcolor="#ECE1E1"><p>付款方式</p></th>
                                        <td bgcolor="#F6F6F6"><p>
                                            <select name="paytype" id="paytype">
                                            <option value="ATM匯款" selected>ATM匯款</option>
                                            <option value="線上刷卡">線上刷卡</option>
                                            </select>
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" bgcolor="#F6F6F6"><p><font color="#FF0000">*</font> 表示為必填的欄位</p></td>
                                    </tr>
                                    </table>
                                    <input type="submit" name="place_order" class="btn btn-warning" value="送出訂單"/>
                                </form>
                            </td>
                        </tr>  
           ';  
      }  
      $order_table .= '</table>';  
      $output = array(  
           'order_table'     =>     $order_table,  
           'cart_item'          =>     count($_SESSION["shopping_cart"])  
      );  
      echo json_encode($output);  
 }
 if($_POST["action"] == 'empty')
 {
      unset($_SESSION["shopping_cart"]);
 }   
 ?>
