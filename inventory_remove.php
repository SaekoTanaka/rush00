<?php

include_once("permissions.php");
include_once("whoami.php");
include_once("inventory.php");

session_start();

if (!array_key_exists("id", $_POST))
	exit("ERROR: Invalid parameters.".PHP_EOL);
$user = whoami();
if ($user == FALSE)
	exit("ERROR: Must be logged in to modify the inventory.".PHP_EOL);
if (!check_permissions($PER_INVENTORY))
	exit("ERROR: You do not have the permissions to modify the inventory.".PHP_EOL);
if (inventory_remove($_POST["id"]))
	exit("OK".PHP_EOL);
else
	exit("ERROR".PHP_EOL);

?>
