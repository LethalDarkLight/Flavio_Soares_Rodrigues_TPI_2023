<?php

// Empêche l'utilisateur d'acceder à la page via l'url 
if (!isset($_GET['searchFilter']) && !isset($_GET['categoriesFilter']) && !isset($_GET['minPriceFilter']) && !isset($_GET['maxPriceFilter']))
{
    header("Location: login.php");
	exit();
}

// Inclusion des fichiers nécessaires
require_once './includes/checkAll.php';

function ShowFilteredArticles()
{
    // Récupères les filtres
    $searchFilter = filter_var($_GET['searchFilter'], FILTER_SANITIZE_SPECIAL_CHARS);
    $categoriesFilter = filter_var($_GET['categoriesFilter'], FILTER_SANITIZE_NUMBER_INT);
    $minPriceFilter = filter_var($_GET['minPriceFilter'], FILTER_SANITIZE_NUMBER_INT);
    $maxPriceFilter = filter_var($_GET['maxPriceFilter'], FILTER_SANITIZE_NUMBER_INT);

    // Récupères les articles filtré
    $filteredArticles = GetFilteredArticles($searchFilter, intval($categoriesFilter), intval($minPriceFilter), intval($maxPriceFilter));

    $result = "";

    foreach ($filteredArticles as $article)
    {
        $mainImage = GetMainImage($article->id);
        $formattedPrice = number_format($article->price, 2, '.', " ");
        
        $result .= "
        <div class='mx-1 my-2 d-flex flex-column justify-content-end border border-2 p-2 filteredArticle'>
            <img class='rounded mx-auto d-block' style='width: 300px' src='$mainImage->content' alt='$mainImage->name'>
            <p class='fs-4 text-center'><strong>$article->name</strong></p>
            <p class='fs-5 text-center my-0'><strong>$formattedPrice</strong> <span>CHF</span></p>
            <a class='btn btn-primary mt-2' href='articleDetails.php?articleName=$article->name'>Voir les détails...</a>
        </div>";
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
    <?=ShowNavbar()?>
    <main class="w-100 mt-3">
        <div class="d-flex flex-wrap justify-content-center mx-auto">
            <?=ShowFilteredArticles()?>
        </div>
    </main>
    <script src="./assets/libraries/bootstrap/bootstrap.js"></script>
</body>
</html>