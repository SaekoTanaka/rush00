<?php

include("inventory.php");

function put_basket_item($item, $quantity)
{
	$name = $item["name"];
	$image = $item["image"];
	$price = $quantity * $item["price"];
echo <<<EOD
<div class="item_info">
	<p>$name</p>
	<img src="$image" />
	<p>$quantity</p>
	<p class="cost">$$price</p>
	<form action="#1" method="post">
		<input class="delete" type="button" name="delete" value="delete">
	</form>
</div>	

EOD;
}

function put_basket_price($price)
{
	echo "<p>Total price: " . $price . "</p>";
}

session_start();

if (array_key_exists("basket", $_SESSION))
	$basket = $_SESSION["basket"];
else
	$basket = array();
$cost = 0;
foreach ($basket as $basket_item)
{
	$item = inventory_get_item($basket_item["id"]);
	put_basket_item($item, $basket_item["quantity"]);
	$cost += $basket_item["quantity"] * $item["price"];
}
put_basket_price($cost);

?>
