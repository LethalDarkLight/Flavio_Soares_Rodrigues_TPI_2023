<?php

function ShowNavbar()
{
    $searchFilter = "";
    $categoriesFilter = 0;
    $minPriceFilter = "";
    $maxPriceFilter = "";

    // Récupère toutes les catégories
    $categories = GetCategories();

    if (isset($_GET['filterSubmit']))
    {
        $searchFilter = filter_input(INPUT_GET, "searchFilter", FILTER_SANITIZE_SPECIAL_CHARS);
        $categoriesFilter = intval(filter_input(INPUT_GET, "categoriesFilter", FILTER_VALIDATE_INT));
        $minPriceFilter = filter_input(INPUT_GET, "minPriceFilter", FILTER_VALIDATE_INT);
        $maxPriceFilter = filter_input(INPUT_GET, "maxPriceFilter", FILTER_VALIDATE_INT);
    }

    if (isset($_GET['filterErase']))
    {
        $searchFilter = "";
        $categoriesFilter = 0;
        $minPriceFilter = "";
        $maxPriceFilter = "";
    }

    $result = "
    <header>
        <nav class='navbar navbar-dark bg-dark navbar-expand-xxl py-0'>
            <div class='container-fluid'>
                <a class='navbar-brand' href='index.php'><img style='width:203px; height:130px' class='my-0' src='./assets/images/LogoGYM.png' alt='Logo'></a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='d-flex flex-column w-100'>
                    <div class='collapse navbar-collapse my-2 w-100' id='navbarSupportedContent'>";

                        if (ESessionManager::IsValid() === false)
                        {
                            $result .= "
                            <ul class='navbar-nav ms-auto mb-lg-0 d-flex w-100'>
                                <li class='nav-item mx-2 my-1 filterContainer'>
                                    <a class='btn btn-primary navigationBtn' aria-current='page' href='login.php'><i class='fa-solid fa-lg fa-arrow-right-to-bracket'></i> Se connecter</a>
                                </li>
                                <li class='nav-item mx-2 my-1 filterContainer'>
                                    <a class='btn btn-primary navigationBtn' href='register.php'><i class='fa-solid fa-lg fa-user-plus'></i> S'enregister</a>
                                </li>
                            </ul>";
                        }

                        if (ESessionManager::IsValid() === true && ESessionManager::IsConnectedUserAdmin() === false)
                        {
                            $result .= "
                            <ul class='navbar-nav ms-auto mb-lg-0 d-flex w-100'>
                                <li class='nav-item mx-2 my-1 filterContainer'>
                                    <a class='btn btn-primary navigationBtn' aria-current='page' href='cart.php'><i class='fa-solid fa-lg fa-cart-shopping'></i> Mon panier</a>
                                </li>
                                <li class='nav-item mx-2 my-1 filterContainer'>
                                    <a class='btn btn-primary navigationBtn' href='logout.php'><i class='fa-solid fa-lg fa-arrow-right-from-bracket'></i> Se déconnecter</a>
                                </li>
                            </ul>";
                        }

                        if (ESessionManager::IsValid() === true && ESessionManager::IsConnectedUserAdmin() === true)
                        {
                            $result .= "
                            <ul class='navbar-nav ms-auto mb-lg-0 d-flex w-100'>
                                <li class='nav-item mx-2 my-1 filterContainer'>
                                    <a class='btn btn-primary navigationBtn' aria-current='page' href='addArticle.php'><i class='fa-solid fa-lg fa-plus'></i> Ajouter un article</a>
                                </li>
                                <li class='nav-item mx-2 my-1 filterContainer'>
                                    <a class='btn btn-primary navigationBtn' aria-current='page' href='addCategory.php'><i class='fa-solid fa-lg fa-plus'></i> Ajouter une catégorie</a>
                                </li>
                                <li class='nav-item mx-2 my-1 filterContainer'>
                                    <a class='btn btn-primary navigationBtn' aria-current='page' href='updateCategory.php'><i class='fa-solid fa-lg fa-pencil'></i> Modifier une catégorie</a>
                                </li>
                                <li class='nav-item mx-2 my-1 filterContainer'>
                                    <a class='btn btn-primary navigationBtn' href='logout.php'><i class='fa-solid fa-lg fa-arrow-right-from-bracket'></i> Se déconnecter</a>
                                </li>
                            </ul>";
                        }
                        
                    $result .= "</div>
                    <div class='collapse navbar-collapse border-top border-3 border-white ms-2 me-2 rounded my-1' id='navbarSupportedContent'></div>
                    <div class='collapse navbar-collapse my-2 w-100' id='navbarSupportedContent'>
                        <form method='get' class='form-inline w-100'>
                            <ul class='navbar-nav me-auto mb-lg-0 w-100'>
                                <li class='nav-item mx-2 d-flex flex-row filterContainer'>
                                    <input class='form-control search' name='searchFilter' type='text' placeholder='Rechercher un article...' value='$searchFilter'>
                                </li>
                                <li class='nav-item mx-2 filterContainer'>
                                    <select name='categoriesFilter' class='form-select filterControl' value='$categoriesFilter'>
                                    <option value='0' selected>Catégories</option>";

                                    // Affiche chaque catégorie dans la combo box
                                    foreach ($categories as $category)
                                    {
                                        $result .= "<option value='$category->id'";
                                        if ($categoriesFilter == $category->id) {
                                            $result .= " selected";
                                        }
                                        $result .= ">$category->name</option>";
                                    }

                                    $result .="</select>
                                </li>
                                <li class='nav-item mx-2 filterContainer'>
                                    <input class='form-control filterControl' name='minPriceFilter' type='number' placeholder='Prix min' min='0' value='$minPriceFilter'>
                                </li>
                                <li class='nav-item mx-2 filterContainer'>
                                    <input class='form-control filterControl' name='maxPriceFilter' type='number' placeholder='Prix max' min='0' value='$maxPriceFilter'>
                                </li>
                                <li class='nav-item mx-2 filterControl filterContainer'>
                                    <button name='filterSubmit' class='btn btn-primary filterBtn' type='submit'><i class='fa-solid fa-magnifying-glass fa-lg'></i> Rechercher</button>
                                </li>
                                <li class='nav-item mx-2 filterControl filterContainer'>
                                    <button name='filterErase' class='btn btn-primary filterBtn' id='eraserFilterBtn' type='submit'><i class='fa-solid fa-eraser fa-lg'></i> Effacer les filtres</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>";

    echo $result;
}
?>