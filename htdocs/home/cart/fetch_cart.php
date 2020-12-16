<?php

//fetch_cart.php

session_start();

$total_price = 0;
$total_item = 0;

$output = '
<div class="table-responsive" id="order_table">
	<table class="table table-bordered table-striped">
		<tr>
			<th style="text-align:center">
				商品
			</th>
			<th  style="text-align:center">
				單價
			</th>
		</th>
		</tr> 
';
if(!empty($_SESSION["shopping_cart"]))
{
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		$output .= '
		<tr>
			<td>'.$values["product_name"].'</td>
			<td align="right">$ '.number_format($values["product_quantity"] * $values["product_price"], 2).'<br><button name="delete" class="btn btn-danger btn-xs delete" id="'. $values["product_id"].'">刪除</button></td>
		</tr>
		';
		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
		$total_item = $total_item + 1;
	}
}
else
{
	$output .= '
    <tr>
    	<td colspan="5" align="center">
    		您的購物車是空的
    	</td>
    </tr>
    ';
}
$output .= '</table></div>';
$data = array(
	'cart_details'		=>	$output,
	'total_price'		=>	'$' . number_format($total_price, 2),
	'total_item'		=>	$total_item
);	

echo json_encode($data);


?>