<?php
// Inclusion des fichiers nécessaires
require_once './includes/checkAll.php';
require_once ROOT.'includes/nav.php';

function ShowFeaturedArticles()
{
    // Récupère tous les articles mis en vedette
    $featuredArticles = GetFeaturedArticles();

    $result = "<div id='myCarousel' class='d-flex mx-auto w-100'>
                <div class='carousel-inner w-100'>";

    $itemCounter = 0;
    $isActive = true;

    foreach ($featuredArticles as $key => $article)
    {
        $mainImage = GetMainImage($article->id);
        $formattedPrice = number_format($article->price, 2, '.', "'");

        if ($itemCounter % 5 == 0)
        {
            if ($isActive)
            {
                $result .= "<div class='carousel-item active d-flex justify-content-center mb-5 mt-3'>";
                $isActive = false;
            }
            else
            {
                $result .= "<div class='carousel-item d-flex justify-content-center mb-5 mt-3'>";
            }
        }

        $result .= "
            <div class='mx-1'>
                <img class='img-fluid carouselImages' src='$mainImage->content' alt='$mainImage->name'>
                <p class='fs-4 text-center'><strong>$article->name</strong></p>
                <p class='fs-5 text-center'><strong>$formattedPrice</strong> <span>CHF</span></p>
            </div>";

        $itemCounter++;

        if ($itemCounter % 5 == 0 || $key == count($featuredArticles) - 1)
        {
            $result .= "</div>";
        }
    }

    echo $result;
}

function ShowCarouselIndicator()
{
    // Récupère tous les articles mis à la une
    $featuredArticles = GetFeaturedArticles();

    $iterationCount = 0;
    $slideNumber = 1;
    $i= 0;

    $result = "<div class='carousel-indicators'>
    <button type='button' data-bs-target='#carouselFeatured' data-bs-slide-to='$i' class='active my-2 mx-2' style='width:50px; height:8px;'' aria-current='true' aria-label='Slide $slideNumber'></button>";

    // Récupérer chaque article
    foreach ($featuredArticles as $article)
    {
        if ($iterationCount % 10 == 0)
        {
            $slideNumber++;
            $i++;
            $result .= "<button type='button btn-primary' style='width:50px; height:8px;' class='my-2 mx-2' data-bs-target='#carouselFeatured' data-bs-slide-to='$i' aria-label='Slide ". $slideNumber ."'></button>";
        }
        $iterationCount++;
    }
    $result .= "</div>";
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
    <main class="w-100 mx-3 mt-5">
        <h2 class="mb-2">Nos articles à la une</h2>
        <div id='carouselFeatured' class='carousel carousel-dark carousel-fade mt-5'>
            <?=ShowCarouselIndicator()?>
            <?=ShowFeaturedArticles()?>
            <div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselFeatured" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
            </div>

            <div>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselFeatured" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </main>
<script src="./assets/libraries/bootstrap/bootstrap.js"></script>
</body>
</html>