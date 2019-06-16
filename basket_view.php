<?php

function put_basket_item($item)
{
	$item_id = $item["id"];
	$item_quantity = $item["quantity"];
echo <<<EOD
<p>$item_id</p>
<p>$item_quantity</p>

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
foreach ($basket as $item)
{
	put_basket_item($item);
	$cost += $item["id"];
}
put_basket_price($cost);

?>
