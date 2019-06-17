<?php

include_once("account.php");

class PasswordChanger
{
	function __construct($new_pass)
	{
		$this->{"new_pass"} = $new_pass;
	}

	function modify(&$account)
	{
		$salt = bin2hex(random_bytes(8));
		$pepper = bin2hex(random_bytes(8));
		$password = hash("whirlpool", $salt . $this->{"new_pass"} . $pepper);
		$account["passwd"] = $password;
		$account["salt"] = $salt;
		$account["pepper"] = $pepper;
	}
}

if (!array_key_exists("submit", $_POST) or $_POST["submit"] != "OK")
	exit("ERROR: Invalid parameters.".PHP_EOL);
if (empty($_POST["newpw"]))
	exit("ERROR: Password cannot be empty.".PHP_EOL);
if (!auth($_POST["login"], $_POST["passwd"]))
	exit("ERROR: Invalid login.".PHP_EOL);
$change_pass = new PasswordChanger($_POST["newpw"]);
$status = modify_account($_POST["login"], $change_pass);
if ($status === TRUE)
	exit ("OK".PHP_EOL);
else
	exit ("ERROR: " . $status[$error] . PHP_EOL);

?>
