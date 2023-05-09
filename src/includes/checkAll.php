<?php
require_once 'web.inc.all.php';

// Si il faut être connecté on appel checkSessionHeader qui gère les redirections
if (isset($REQUIREDLOGIN) && $REQUIREDLOGIN === true)
{
    include_once ROOT.'/includes/checkSessionHeader.php';
}
?>