<?php
// Constante pour avoir le chemin absolu
define('ROOT', $_SERVER['DOCUMENT_ROOT']."/Flavio_Soares_Rodrigues_TPI_2023/src/");

require_once ROOT.'includes/web.inc.all.php';

// Si il faut être connecté on appel checkSessionHeader qui gère les redirections
if (isset($REQUIREDLOGIN) && $REQUIREDLOGIN === true)
{
    include_once ROOT.'/includes/checkSessionHeader.php';
}
?>