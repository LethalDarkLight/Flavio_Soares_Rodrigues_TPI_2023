<?php
/*Page qui déconnecte l'utilisateur de la session*/

// Inclue le fichiers nécessaire
require_once './includes/checkAll.php';

// Supprime la session
ESessiontManager::Clear();

// Redirection vers la page de login
header("Location: login.php");
exit();