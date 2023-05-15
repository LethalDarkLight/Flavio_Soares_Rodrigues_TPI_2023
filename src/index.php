<?php
// Inclusion des fichiers nécessaires
require_once './includes/checkAll.php';
require_once ROOT.'tools/indexTools.php';

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
    <main class="w-100 mt-3">
        <h2 class="mb-4">Nos articles à la une</h2>
        <div class="d-flex flex-wrap justify-content-center mx-auto">
            <?=ShowFeaturedArticles()?>
        </div>
    </main>
<script src="./assets/libraries/bootstrap/bootstrap.js"></script>
</body>
</html>