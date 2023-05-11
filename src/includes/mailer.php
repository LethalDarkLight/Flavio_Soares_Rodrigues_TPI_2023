<?php

// Constantes requise pour l'envois de mail
require_once ROOT.'config/phpmailerparam.php';

// Importe les classes de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once ROOT.'assets/libraries/PHPMailer/src/PHPMailer.php';
require_once ROOT.'assets/libraries/PHPMailer/src/SMTP.php';
require_once ROOT.'assets/libraries/PHPMailer/src/Exception.php';

/**
    * Envoyer un e-mail à l'adresse de l'utilisateur

    * @param string $email     L'adresse e-mail de l'utilisateur
    * @param string $subject   Le sujet de l'e-mail
    * @param string $body      Le contenu de l'e-mail

    * @return bool Vrai si envoyé, Faux en cas d'erreur.
*/
function sendEmail($email, $suject, $body)
{
    // Créer une instance ; passer `true` active les exceptions
    $mail = new PHPMailer(true);
 
    try
    {
        /* Paramètres du serveur

            - Activer la sortie de débogage détaillée
            - DEBUG_OFF pour aucune sortie de débogage
            - DEBUG_SERVER pour une sortie de débogage
        */
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        // Configuration du serveur SMTP
        $mail->isSMTP();                       // Utiliser SMTP pour l'envoi
        $mail->Host         = MAIL_SERVER;     // Définir le serveur SMTP pour l'envoi
        $mail->SMTPAuth     = true;            // Activer l'authentification SMTP
        $mail->Username     = MAIL_USERNAME;   // Nom d'utilisateur SMTP
        $mail->Password     = MAIL_PASSWORD;   // Mot de passe SMTP
        $mail->SMTPSecure   = MAIL_TRANS;      // Activer le chiffrement TLS implicite
        $mail->Port         = MAIL_PORT;       // Port TCP pour la connexion ; utilisez 587 si vous avez défini `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Destinataires
        $mail->setFrom(MAIL_USERNAME);
        $mail->addAddress(strtolower($email));
        $mail->addReplyTo(MAIL_USERNAME);

        // Contenu
        $mail->isHTML(true);            // Définir le format de l'e-mail en HTML
        $mail->CharSet = MAIL_ENCODE;   // Encodage du mail
        $mail->Subject = $suject;
        $mail->Body    = $body;
        $mail->send();
    }
    catch (Exception $e)
    {
        return false;
    }
    // Terminé
    return true;
}
