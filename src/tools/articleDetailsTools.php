<?php

function ShowArticleDetails($article)
{
    $result = "";

    $formattedPrice = number_format($article->price, 2, '.', " ");
    $description = html_entity_decode($article->description);
    
    $result .= "
    <div class='d-flex flex-column w-75 mx-1 my-2 p-2'>
        ".ShowImages($article)."
        <h2 class='text-center mb-4'><strong>$article->name</strong></h2>
        <p class='fs-5 text-center my-0'><strong>$formattedPrice</strong><span> CHF</span></p>
        <div class='mt-3 mx-2 text-center'>
            $description
        </div>";

        if (!ESessionManager::IsValid())
        {
            $result.= "<a class='btn btn-primary my-2 mx-auto detailsBtn' href='login.php'>Ajouter au panier</a>";
        }
        elseif(ESessionManager::IsConnectedUserAdmin() === false)
        {
            $result .= "
            <div class='d-flex my-2'>
                <form method='post' class='w-100 d-flex flex-wrap justify-content-center mx-auto'>
                    <button name='addToCart' type='submit' class='btn btn-primary my-2 mx-auto detailsBtn' value='addToCart'>Ajouter au panier</button>
                </form>
            </div>";
        }
        else
        {
            $result.= "<a class='btn btn-primary my-2 mx-auto detailsBtn' href='updateArticle.php?id=$article->id'>Modifier l'article</a>";
        }
        
    $result.="</div>";
    echo $result;
}

function ShowImages($article)
{
    $images = GetImages($article->id);
    $mainImage = GetMainImage($article->id);

    $result = "<div id='carouselImages' class='carousel carousel-dark slide' data-bs-interval='false'>
        <div class='carousel-indicators'>";

        // Parcours les images pour affichager la navigation dans le carousel
        foreach ($images as $key => $image)
        {
            $isMainImage = $image->mainImage ? "class='active' aria-current='true'" : "";
            $result .= "<button type='button' data-bs-target='#carouselImages' style='width:60px; height:6px' data-bs-slide-to='$key' $isMainImage aria-label='Slide $key'></button>";
        }

        $result .= "
        </div>
        <div class='carousel-inner'>";

        // Parcours les images pour les afficher dans le carousel
        foreach ($images as $image)
        {
            $isMainImage = $image->mainImage ? "active" : "";
            $result .= "
            <div class='carousel-item mb-5 $isMainImage'>
                <img class='rounded mx-auto d-block detailsImg' src='$image->content' alt='$image->name'>
            </div>";
        }

        $result .="
        </div>
        <div>
            <button class='carousel-control-prev' type='button' data-bs-target='#carouselImages' data-bs-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                <span class='visually-hidden'>Previous</span>
            </button>
        </div>

        <div>
            <button class='carousel-control-next' type='button' data-bs-target='#carouselImages' data-bs-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                <span class='visually-hidden'>Next</span>
            </button>
        </div>
    </div>";
    return $result;
}