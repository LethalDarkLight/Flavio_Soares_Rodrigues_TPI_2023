<?php
/*
*   Cette page contient les fonctions d'affichage liée à la page register.php
*/

// Affiche les villes dans le combo box
function ShowCities($value)
{
    // Récupère toutes les villes
    $cities = GetCities();
    
    // Affiche chaque ville dans la combo box
    foreach ($cities as $city)
    {
        echo "<option value='$city->id'";
        if ($value == $city->id) {
            echo " selected";
        }
        echo ">$city->name</option>";
    }
}

