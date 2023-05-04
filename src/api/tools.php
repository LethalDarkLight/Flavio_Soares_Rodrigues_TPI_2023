<?php

// Démarre une nouvelle session
function StartNewSession()
{
    // Démarre une session
    session_start();

    // Si la variable de session 'idUser' n'existe pas, initialise la session avec les valeurs par défaut.
    if (!isset($_SESSION['idUser']))
    {
        $_SESSION = [
            'idUser' => '',
            'connected' => false,
            'admin' => false,
        ];
    }
}