<?php
require_once '../model/image.php';

$imageURL = "../images/LogoGYM.png"; // Récupère le chemin (local)
$imageContent = file_get_contents($imageURL); // Récupère le contenu de l'image
$imageName = uniqid() ."-". basename($imageURL); // Récupère le nom de l'image et créer un nom unique
$imageType = getimagesize($imageURL)['mime']; // récupère le type d'image

var_dump($imageContent);

// AddEnc64Image($imageContent, $imageName, $imageType, 1, 2);
// GetImages($articlesId);
// GetMainImage($articlesId);
// DeleteImage($imageId);