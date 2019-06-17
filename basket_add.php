<?php

session_start();

if (!array_key_exists("id", $_POST) or !array_key_exists("quantity", $_POST))
	exit("Invalid parameters.".PHP_EOL);
if (array_key_exists("basket", $_SESSION))
	$basket = $_SESSION["basket"];
else
	$basket = array();
for ($i = 0; $i < count($basket); $i++)
{
	$item = &$basket[$i];
	if ($item["id"] == $_POST["id"])
	{
		$item["quantity"] += $_POST["quantity"];
		if ($item["quantity"] < 0)
			exit("You cannot buy less than 0 of an item.".PHP_EOL);
		if ($item["quantity"] == 0)
			array_splice($basket, $i, 1);
		$_SESSION["basket"] = $basket;
		header("Location: basket.php");
		//exit("OK".PHP_EOL);
	}
}
// TODO verify that id is in stock
if ($_POST["quantity"] <= 0)
	exit("You cannot buy less than 0 of an item.".PHP_EOL);
$item = array();
$item["id"] = $_POST["id"];
$item["quantity"] = $_POST["quantity"];
$basket[] = $item;
$_SESSION["basket"] = $basket;
exit("OK".PHP_EOL);

?>
