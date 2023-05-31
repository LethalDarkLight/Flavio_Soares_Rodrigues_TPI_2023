<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']."/Flavio_Soares_Rodrigues_TPI_2023/src/");

require_once ROOT.'session/SessionManager.php';

// Test si la session est valide
if (ESessionManager::IsValid() === false)
{
    echo 'Session not valid';
}

// Mettre un utilisateur dans la session
ESessionManager::SetUser(250, false);

$userId = ESessionManager::GetConnectedUserId();

if ($userId === false)
{
    echo 'pas connecté';
}
if (ESessionManager::IsConnectedUserAdmin())
{
    echo 'Utilisateur est admin';
}
else
{
    echo 'Utilisateur est pas admin';
}

ESessionManager::Clear();

$userId = ESessionManager::GetConnectedUserId();
if ($userId === false)
{
    echo 'pas connecté';
}

