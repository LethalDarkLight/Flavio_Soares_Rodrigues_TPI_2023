<?php

// Affiche les villes dans le combo box
function ShowCities()
{
    // Récupère toutes les villes
    $cities = GetCities();
    
    // Affiche chaque ville dans la combo box
    foreach ($cities as $value)
    {
        echo "<option value=".$value->id.">".$value->name ."</option>";
    }
}

