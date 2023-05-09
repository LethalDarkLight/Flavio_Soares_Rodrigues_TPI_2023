<?php
// Pour accéder à cette page l'utilisateur doit être authentifié entant qu'administrateur
$REQUIREDLOGIN = true;
$REQUIREDADMIN = true;

require_once './includes/checkAll.php';

echo 'Hello je suis admin';