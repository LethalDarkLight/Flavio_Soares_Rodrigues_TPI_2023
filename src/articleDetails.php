<?php

if (!isset($_GET['articleName']))
{ 
    header("Location: index.php");
	exit();
}

// Inclusion des fichiers nécessaires
require_once './includes/checkAll.php';
require_once ROOT.'tools/articleDetailsTools.php';

// Récupère tous les articles mis en vedette
$article = GetArticle($_GET['articleName']);
$msg = "";

if (isset($_POST['addToCart']))
{
    if(AddCartItem(ESessionManager::GetConnectedUserId(), $article->id))
    {
        $msg = "<p id='success'>L'article à été ajouter au panier</p>";
    }
}
else
{
    $msg = "";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <!-- Fontawesome -->
    <link href="assets/libraries/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="assets/libraries/fontawesome/css/brands.css" rel="stylesheet">
    <link href="assets/libraries/fontawesome/css/solid.css" rel="stylesheet">
    <link href="assets/libraries/fontawesome/css/regular.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/libraries/bootstrap/bootstrap.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?=ShowNavbar()?>
    <main class="w-100 mt-5">
        <div class="my-3" id='errorMsg' role='alert'><?=$msg?></div>
        <div class="d-flex justify-content-center mx-auto">
            <?=ShowArticleDetails($article)?>
        </div>
    </main>
    <script src="./assets/libraries/bootstrap/bootstrap.js"></script>
</body>
</html>