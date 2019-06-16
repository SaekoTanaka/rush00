<?php

include("whoami.php");

session_start();

$user = whoami();
if ($user === FALSE)
	echo "Not currently logged in.".PHP_EOL;
else
	echo "Logged in as ". $user . PHP_EOL;
if (array_key_exists("basket", $_SESSION))
	echo "You have a basket with " . count($_SESSION["basket"]) . " items.".PHP_EOL;
else
	echo "You have no basket".PHP_EOL;

?>
