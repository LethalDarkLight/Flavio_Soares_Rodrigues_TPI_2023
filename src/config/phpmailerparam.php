<?php
/*
    Constantes requise pour l'envois de mail avec PHPMailer
*/

define('MAIL_SERVER', "smtp.office365.com");            // Adresse de serveur SMTP
define('MAIL_PORT', 587);                              	// Port 587 pour TLS ou 465 pour SSL
define('MAIL_TRANS', "STARTTLS");                       // Protocole de sécurisation des échanges de données
define('MAIL_USERNAME', "SuperUserGym@hotmail.com");    // Adresse mail de l'envoyeur
define('MAIL_PASSWORD', "TpI2022-2023");            	// Mot de passe
define('MAIL_ENCODE', "UTF-8");                // Encodage du mail