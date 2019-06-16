<?php

include("file.php");

function get_account($username)
{
	$login = strtolower($username);
	if (!load_data("accounts.txt", $accounts))
		return ["error"=>"failed to open account information"];
	foreach ($accounts as &$account)
	{
		if (!array_key_exists("login", $account))
			continue;
		if (strtolower($account["login"]) == $login)
			return $account;
	}
	return ["error"=>"account does not exist"];
}

function check_permissions($required_permissions)
{
	if (!array_key_exists("user_permissions", $_SESSION))
		return ($required_permissions == 0);
	$user_permissions = $_SESSION["user_permissions"];
	return !((~$user_permissions) & $required_permissions);
}

function auth($login, $passwd)
{
	$account = get_account($login);
	if (array_key_exists("error", $account))
		return false;
	if (
		!array_key_exists("salt", $account) or
		!array_key_exists("pepper", $account) or
		!array_key_exists("passwd", $account)
	)
		return false;
	$hash = hash("whirlpool", $account["salt"] . $passwd . $account["pepper"]);
	return ($hash == $account["passwd"]);
}

?>
