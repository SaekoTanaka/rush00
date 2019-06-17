<?php

include_once("inventory.php");

function put_basket_item($item, $quantity)
{
	$name = $item["name"];
	$image = $item["image"];
	$price = $quantity * $item["price"];
	$html = file_get_contents("templates/basket_view_item.html");
	if ($html == FALSE)
		return ;
	$placeholders = ["__NAME__", "__IMAGE__", "__PRICE__", "__QUANTITY__"];
	$replacements = [$name, $image, $price, $quantity];
	echo str_replace($placeholders, $replacements, $html);
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
// TODO testing only
$basket = [["id"=>1, "quantity"=>1], ["id"=>4, "quantity"=>42]];
$cost = 0;
foreach ($basket as $basket_item)
{
	$item = inventory_get_item($basket_item["id"]);
	put_basket_item($item, $basket_item["quantity"]);
	$cost += $basket_item["quantity"] * $item["price"];
}
put_basket_price($cost);

?>
