<?php
require_once '../php/db.php';
require_once '../php/functions.php';

$datas  = get_all_art();
print_r ($datas);
/*$query = "SELECT * FROM art ORDER BY id DESC";
$statement = $connect->prepare($query);
if($statement->execute())
{
	$result = $statement->fetchAll();

}*/
$output = '';
foreach($datas as $row)
{
	$output .= '
	<div class="col-xs-10" style="margin-top:12px;">  
		<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">
			<img src="../'.$row["image_path"].'"class="img-responsive" /><br />
			<h4 class="text-info">'.$row["name"].'</h4>
			<h4 class="text-danger">$ '.$row["price"] .'</h4>
			<input type="hidden" name="hidden_name" id="name'.$row["id"].'" value="'.$row["name"].'" />
			<input type="hidden" name="hidden_price" id="price'.$row["id"].'" value="'.$row["price"].'" />
			<input type="button" name="add_to_cart" id="'.$row["id"].'" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Cart" />
		</div>
	</div>
	';
}
echo $output;


?>