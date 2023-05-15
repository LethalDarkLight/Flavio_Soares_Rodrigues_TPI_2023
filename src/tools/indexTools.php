<?php

function ShowFeaturedArticles()
{
    // Récupère tous les articles mis en vedette
    $featuredArticles = GetFeaturedArticles();

    $result = "";

    foreach ($featuredArticles as $article)
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