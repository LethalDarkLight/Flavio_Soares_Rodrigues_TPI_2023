<?php
    // Pour accéder à cette page l'utilisateur doit être authentifié entant qu'administrateur
    $REQUIREDLOGIN = true;
    $REQUIREDADMIN = true;

    // Inclusion des fichiers nécessaires
    require_once './includes/checkAll.php';

    // Déclare les variables
    $name = "";
    $msg = "";

    // Si le bouton du formulaire a été cliqué
    if (isset($_POST['submit']))
    {
        // Filtre le nom
        $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_SPECIAL_CHARS);

        // Affiche une erreur si la catégorie existe sinon on crée l'article
        if (CategoryExists($name))
        {
            $msg = "<p id='error'><i class='fa-solid fa-triangle-exclamation fa-xl me-2'></i> Cette catégorie existe déjà.</p>";
        }
        else
        {
            AddCategory($name);
            $msg = "<p id='success'> La catégorie $name à été ajouter. </p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une catégorie</title>

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
    <main class="mx-auto mt-5">
        <h2 class="mb-5">Ajouter une nouvelle catégorie</h2>
        <div class="my-3" id='errorMsg' role='alert'><?=$msg?></div>

        <form method="post" onsubmit="return validateForm()">
            <div class="my-4">
                <label for="name" class="form-label">Nom de la catégorie <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input name="name" type="name" class="form-control" id="name" onkeyup="toUpperCase()" value="<?=$name?>">
                <div id="nameHelp" class="form-text text-danger"></div>
            </div>

            <div class="d-flex flex-row-reverse my-3">
                <button name="submit" type="submit" class="btn btn-primary submitBtn mb-3" value="submit">Ajouter la catégorie</button>
            </div>
        </form>
    </main>
    <script src="./assets/libraries/bootstrap/bootstrap.js"></script>
    <script src="./assets/js/validateAddCategory.js"></script>
</body>
</html>