<?php
// Inclusion des fichiers nécessaires
require_once './includes/checkAll.php';
require_once ROOT.'tools/indexTools.php';

// Constantes
define("HOLDER_NAME", "GYM SA");
define("RESIDENCE", "Rue de la Caille 1");
define("ZIP_CODE", "1213 Onex ");
define("COUNTRY", "Suisse");
define("IBAN", "CH35 0023 0241 9371 8929 9");

// Si il appuie sur le bouton 
if (isset($_POST['validateOrder']))
{
    $suject = "Confirmation de votre commande GYM";
    $body = "
    <div style='font-size: 16px; color: black'>
        <p>Votre commande sera traitée dans les plus brefs délais</p>
        <p>Résumé de la commande :</p>";

        // Faire une boucle qui récupères les articles du panier (Nom, prix, quantité et le total quantité*prix)
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // Afficher le montant total à payer

        $body .= "<p style='margin-top:20px;'>Heureux de vous avoir comme client,</p>
        <p style='font-weight: bold; color: #0B5ED7; font-size: 18px;'>L'équipe GYM</p>
    </div>
    ";
    $email = ""; // Récupérer l'email stocker en session
    // Envois un mail
    sendEmail($email, $suject, $body);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <!-- Fontawesome -->
    <link href="assets/libraries/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="assets/libraries/fontawesome/css/brands.css" rel="stylesheet">
    <link href="assets/libraries/fontawesome/css/solid.css" rel="stylesheet">
    <link href="assets/libraries/fontawesome/css/regular.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/libraries/bootstrap/bootstrap.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?=ShowNavbar()?>
    <main class="w-100 mt-5">
        <h2 class="mb-4">Valider votre commande</h2>
        <div class="text-center my-5 mx-3">
            <p class="my-3 fs-5">Titulaire : <strong class="text-primary"><?=HOLDER_NAME?></strong></p>
            <p class="my-3 fs-5">Domiciliation : <br>
                <?=RESIDENCE?> <br>
                <?=ZIP_CODE?><br>
                <?=COUNTRY?>
            </p>
            <p class="my-3 fs-5">IBAN : <strong><?=IBAN?></strong></p>
        </div>
        <div class="text-center my-5">
            <form method="post">
                <input type="submit" class="btn btn-primary" style="width: 300px;" name="validateOrder" value="Valider la commande">
            </form>
        </div>
    </main>
<script src="./assets/libraries/bootstrap/bootstrap.js"></script>
</body>
</html>