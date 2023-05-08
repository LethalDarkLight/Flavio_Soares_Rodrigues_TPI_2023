<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']."/Flavio_Soares_Rodrigues_TPI_2023/src/");

require_once ROOT.'session/SessionManager.php';

// Test si la session est valide
if (ESessiontManager::IsValid() === false)
{
    echo 'Session not valid';
}

// Mettre un utilisateur dans la session
ESessiontManager::SetUser(250, false);

$userId = ESessiontManager::GetConnectedUserId();
if ($userId === false)
{
    echo 'pas connecté';
}
if (ESessiontManager::IsConnectedUserAdmin())
{
    echo 'Utilisateur est admin';
}
else
{
    echo 'Utilisateur est pas admin';
}



ESessiontManager::Clear();

$userId = ESessiontManager::GetConnectedUserId();
if ($userId === false)
{
    echo 'pas connecté';
}

