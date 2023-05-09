<?php

// Constante pour avoir le chemin absolu
define('ROOT', $_SERVER['DOCUMENT_ROOT']."/Flavio_Soares_Rodrigues_TPI_2023/src/");

//  Le fichier de gestion des sessions
require_once ROOT.'session/SessionManager.php';

// Les fichiers concernant les appels à la base de données
require_once ROOT.'model/user.php';
require_once ROOT.'model/article.php';
require_once ROOT.'model/category.php';
require_once ROOT.'model/image.php';
require_once ROOT.'model/cartItem.php';
require_once ROOT.'model/city.php';