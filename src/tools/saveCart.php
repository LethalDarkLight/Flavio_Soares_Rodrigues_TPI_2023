<?php

define('ROOT', $_SERVER['DOCUMENT_ROOT']."/Flavio_Soares_Rodrigues_TPI_2023/src/");
require_once ROOT.'includes/web.inc.all.php';

$data = file_get_contents("php://input");

if ($data === false)
{
    echo '{"ReturnCode": 1}';
    exit;
}

// Récupère le contenu de l'objet json
$object = json_decode($data, true);

// Affiche un message d'erreur si on ne reçoit pas de json
if ($object === null)
{
    echo '{"ReturnCode": 1}';
    exit;
}

// Récupère l'id de l'utilisateur
$userId = $object['id'];

// Parcours l'objet json
foreach($object['cart'] as $item)
{
    // Récupère l'id de l'article et sa quantité
    $articleId = $item['id'];
    $articleQuantity = $item['quantity'];

    // Met à jour la quantité 
    UpdateQuantity($userId, $articleId, $articleQuantity);
}

echo '{"ReturnCode": 0}';