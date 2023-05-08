<?php
/**
 * @copyright XXXXX 2003-2016
 */
// Test if the session is valid
if (ESessiontManager::IsValid() === false)
{
	header("Location: login.php");
	exit();
}

// Test if must be admin
if (isset($REQUIREDADMIN) && $REQUIREDADMIN === true)
{
	if (ESessiontManager::IsConnectedUserAdmin() === false)
	{
		header("Location: notauthorized.php");
		exit();
	}
}
?>
