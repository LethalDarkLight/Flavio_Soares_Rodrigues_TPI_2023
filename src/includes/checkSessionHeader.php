<?php

// Si la session n'est pas valide (utilisateur pas connecté) on le renvois à la page de login
if (ESessiontManager::IsValid() === false)
{
	header("Location: login.php");
	exit();
}

// Si pour acceder à la page il faut être admin 
if (isset($REQUIREDADMIN) && $REQUIREDADMIN === true)
{
	// Si l'utilisateur n'est pas admin on le redirige 
	if (ESessiontManager::IsConnectedUserAdmin() === false)
	{
		header("Location: unauthorized.php");
		exit();
	}
}
?>
