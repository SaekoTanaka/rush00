<?php

include_once("whoami.php");
include_once("account.php");
include_once("permissions.php");

function destroy_user($user)
{
	load_data("accounts.txt", $accounts);
	if ($accounts === FALSE)
	{
		echo "ERROR: Failed to load accounts.".PHP_EOL;
		return FALSE;
	}
	$user_lower = strtolower($user);
	for ($i = 0; $i < count($accounts); $i++)
		if (strtolower($accounts[$i]["login"]) == $user_lower)
			array_splice($accounts, $i, 1);
	if (save_data("accounts.txt", $accounts))
		return TRUE;
	echo "ERROR: Unable to save account information.".PHP_EOL;
	return FALSE;
}

session_start();

if (!array_key_exists("rm_login", $_POST))
	exit("ERROR: Must specify user to delete.".PHP_EOL);
$rm_user = $_POST["rm_login"];
$user = whoami();
if ($user == FALSE)
	exit("ERROR: Must be logged in to delete users.".PHP_EOL);
if ($user != $rm_user)
	if (!check_permissions($PER_MODIFY_USER))
		exit("ERROR: You do not have the permissions to delete another user.".PHP_EOL);
if (destroy_user($rm_user))
{
	$_SESSION["loggued_on_user"] = "";
	header("Location:index.html");
	echo "OK\n";
}

?>
