<?php

include_once("account.php");

session_start();

function login()
{
	if (!array_key_exists("login", $_POST) or !array_key_exists("passwd", $_POST))
		return false;
	return auth($_POST["login"], $_POST["passwd"]);
}

if (login())
{
	$_SESSION["loggued_on_user"] = $_POST["login"];
	$account = get_account($_POST["login"]);
	if (array_key_exists("permissions", $account))
		$_SESSION["user_permissions"] = $account["permissions"];
	else
		$_SESSION["user_permissions"] = 0;
	echo "OK".PHP_EOL;
}
else
{
	$_SESSION["loggued_on_user"] = "";
	echo "ERROR".PHP_EOL;
}

?>
