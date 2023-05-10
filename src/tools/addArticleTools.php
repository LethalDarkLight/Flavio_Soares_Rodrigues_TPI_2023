<?php
/*
*   Cette page contient les fonctions d'affichage liée à la page addArticle.php
*/

// Affiche les catégories dans le combo box
function ShowCategories($value)
{
    // Récupère toutes les catégories
    $categories = GetCategories();
    
    // Affiche chaque catégorie dans la combo box
    foreach ($categories as $category)
    {
        echo "<option value='$category->id'";
        if ($value == $category->id) {
            echo " selected";
        }
        echo ">$category->name</option>";
    }
}