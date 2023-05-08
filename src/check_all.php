<?php


require_once 'web.inc.all.php';

if (isset($REQUIREDLOGIN) && $REQUIREDLOGIN === true)
{
    include_once ROOT.'/check_session_header.php';
}
?>