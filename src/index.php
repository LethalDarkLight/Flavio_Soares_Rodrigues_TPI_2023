<?php
// Inclusion des fichiers nécessaires
require_once './includes/checkAll.php';

function ShowFeaturedArticles()
{
    // Récupère toutes les villes
    $featuredArticles = GetFeaturedArticles();

    $result = "";
    
    // Affiche chaque ville dans la combo box
    foreach ($featuredArticles as $article)
    {
        $mainImage = GetMainImage($article->id);

        $result .= "<img src='$mainImage->content' alt='$mainImage->name'>
        <h3>$article->name</h3>
        <p>$article->price</p>";
    }
    echo $result;
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
    <?=ShowFeaturedArticles()?>

    <main class="mx-auto mt-5">

    </main>
<script src="./assets/libraries/bootstrap/bootstrap.js"></script>
</body>
</html>