<?php

//  Le fichier de gestion des sessions
require_once ROOT.'session/SessionManager.php';

// Navbar
require_once ROOT.'includes/nav.php';

// phpmailer
require_once ROOT.'includes/mailer.php';

// Les fichiers concernant les appels à la base de données
require_once ROOT.'model/user.php';
require_once ROOT.'model/article.php';
require_once ROOT.'model/category.php';
require_once ROOT.'model/image.php';
require_once ROOT.'model/cartItem.php';
require_once ROOT.'model/city.php';