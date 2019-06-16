<?php

include("file.php");

function create_user(&$accounts, $user, $pass)
{
	$account = array();
	$salt = bin2hex(random_bytes(8));
	$pepper = bin2hex(random_bytes(8));
	$password = hash("whirlpool", $salt . $pass . $pepper);
	$account["login"] = $user;
	$account["passwd"] = $password;
	$account["salt"] = $salt;
	$account["pepper"] = $pepper;
	$account["permissions"] = 0;
	$accounts[] = $account;
}

if (!load_data("accounts.txt", $accounts))
	exit("ERROR: Error connecting to server.\n");
if (!array_key_exists("submit", $_POST) or $_POST["submit"] != "OK")
	exit("ERROR: Invalid parameters.\n");
$new_user = $_POST["login"];
$new_user_lower = strtolower($new_user);
foreach ($accounts as $account)
	if (strtolower($account["login"]) == $new_user_lower)
		exit("ERROR: Username already exists.\n");
if (empty($_POST["passwd"]))
	exit("ERROR: Password cannot be empty.\n");
create_user($accounts, $new_user, $_POST["passwd"]);
save_data("accounts.txt", $accounts);
header("Location:index.html");
echo "OK\n";

?>
