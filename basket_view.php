<?php

function put_basket_item($item)
{
	$item_id = $item["id"];
	$item_quantity = $item["quantity"];
echo <<<EOD
					<div class="item_info">
							<p class="cost">$$item_quantity</p>
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
foreach ($basket as $item)
{
	put_basket_item($item);
	$cost += $item["id"] * $item["quantity"];
}
put_basket_price($cost);

?>
