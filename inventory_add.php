<?php

include("inventory.php");

if (
	!array_key_exists("name", $_POST) or
	!array_key_exists("image", $_POST) or
	!array_key_exists("price", $_POST)
)
	exit("ERROR: Invalid parameters.".PHP_EOL);
if (array_key_exists("tags", $_POST))
	$tags = $_POST["tags"];
else
	$tags = null;
if (inventory_add($_POST["name"], $_POST["image"], $_POST["price"], $tags))
	exit("OK".PHP_EOL);
else
	exit("ERROR".PHP_EOL);

?>
