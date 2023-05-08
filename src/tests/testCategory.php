<?php
require_once '../model/category.php';

$categoryName = "APPAREILS";
$msg = "";

var_dump(GetCategories()); // Récupère l'intégralité des catégories
var_dump(GetCategory(1)); // Récupère la catégorie correspondant à l'id donnée en paramètre
UpdateCategory(1, "APPAREILS"); // Met à jour le nom de la catégorie liée à l'id 1

// Permet de vérifier si le nom de la catégorie existe ou non dans la base de données
if (CategoryExists($categoryName) == true)
{
    $msg = "existe";
}
else
{
    $msg = "n'existe pas alors on peut créer la catégorie";
    AddCategory($categoryName);
}

echo($msg);