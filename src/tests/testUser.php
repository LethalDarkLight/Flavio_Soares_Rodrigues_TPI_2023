<?php
require_once '../api/user.php';
require_once '../api/tools.php';
StartNewSession();

// Test la fonction RegisterUser dans le cas ou tout est correcte (email unique non verrifier ici)
// RegisterUser("Du-pont", "Marcel", "MarcelDp@hotmail.ch", '$2y$10$fvm40snO.vBP8Wen8xt6qeRMsEU7.kqqHyPeP8WxEggx.pleBK0zS', "homme", "Av. des Grandes-Communes 2", "", 53, 1213); // retourne : true

// Test la fonction RegisterUser dans le cas ou les information ne sont pas toute correcte avec un champ vide qui ne peut pas être vide et un autre qui est un int remplacer par un string (email unique non verrifier ici)
// RegisterUser("De la porte", "Pierrot", "PierrotDLP@hotmail.ch", '$2y$10$fvm40snO.vBP8Wen8xt6qeRMsEU7.kqqHyPeP8WxEggx.pleBK0zS', "homme", "", "", "je suis du text", 1213); // retourne : false 

EmailExists("MarcelDp@hotmail.ch"); 
LoginUser("MarcelDp@hotmail.ch", "Super");
//session_destroy();
var_dump($_SESSION);