<?php

include_once("permissions.php");
include_once("whoami.php");
include_once("inventory.php");

session_start();

if (!array_key_exists("id", $_POST))
	exit("ERROR: Invalid parameters.".PHP_EOL);
$name = array_key_exists("name", $_POST) ? $_POST["name"] : null;
$image = array_key_exists("image", $_POST) ? $_POST["image"] : null;
$price = array_key_exists("price", $_POST) ? $_POST["price"] : null;
$user = whoami();
if ($user == FALSE)
	exit("ERROR: Must be logged in to modify the inventory.".PHP_EOL);
if (!check_permissions($PER_INVENTORY))
	exit("ERROR: You do not have the permissions to modify the inventory.".PHP_EOL);
if (array_key_exists("tags", $_POST))
	$tags = $_POST["tags"];
else
	$tags = null;
if (inventory_modify($_POST["id"], $name, $image, $price, $tags))
	exit("OK".PHP_EOL);
else
	exit("ERROR".PHP_EOL);

?>
