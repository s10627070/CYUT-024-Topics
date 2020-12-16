<?php
session_start();



if(isset($_POST["place_order"]))  
{  

     print_r ($_SESSION["shopping_cart"]);
    
    if(!empty($_SESSION["shopping_cart"]))  
    {  
         $total = 0;  
         foreach($_SESSION["shopping_cart"] as $keys => $values)  
         {  
          echo $values['product_id'];
          echo '<br>';
          echo $values['product_name'];
          echo '<br>';
          echo $values['product_price'];
          echo '<br>';
          echo $values['product_quantity'];
          echo '<br>';
          $total = $total + ($values["product_quantity"] * $values["product_price"]);
          echo $total;
          echo '<br>';
         }
    }
         
}

?>
