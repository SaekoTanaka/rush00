<?php

function whoami()
{
	if (!array_key_exists("loggued_on_user", $_SESSION))
		return FALSE;
	$user = $_SESSION["loggued_on_user"];
	if (empty($user))
		return FALSE;
	$account = get_account($user);
	if (array_key_exists("error", $account))
		return FALSE;	// User has been deleted while logged in
	return $user;
}

?>
