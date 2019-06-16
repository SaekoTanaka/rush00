<?php

include("inventory.php");

if (!array_key_exists("id", $_POST))
	exit("ERROR: Invalid parameters.".PHP_EOL);
if (inventory_remove($_POST["id"]))
	exit("OK".PHP_EOL);
else
	exit("ERROR".PHP_EOL);

?>
