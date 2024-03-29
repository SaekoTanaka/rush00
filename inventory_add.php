<?php

include_once("permissions.php");
include_once("whoami.php");
include_once("inventory.php");

session_start();

if (
	!array_key_exists("name", $_POST) or
	!array_key_exists("image", $_POST) or
	!array_key_exists("price", $_POST)
)
	exit("ERROR: Invalid parameters.".PHP_EOL);
$user = whoami();
if ($user == FALSE)
	exit("ERROR: Must be logged in to modify the inventory.".PHP_EOL);
if (!check_permissions($PER_INVENTORY))
	exit("ERROR: You do not have the permissions to modify the inventory.".PHP_EOL);
if (array_key_exists("tags", $_POST))
	$tags = $_POST["tags"];
else
	$tags = null;
if (inventory_add($_POST["name"], $_POST["image"], $_POST["price"], $tags))
	exit("OK".PHP_EOL);
else
	exit("ERROR".PHP_EOL);

?>
