<?php
    // Pour accéder à cette page l'utilisateur doit être authentifié entant qu'administrateur
    $REQUIREDLOGIN = true;
    $REQUIREDADMIN = true;

    // Inclusion des fichiers nécessaires
    require_once './includes/checkAll.php';

    // Déclare les variables
    $categoriesInput = '';
    $name = "";
    $msg = "";

    // Si le bouton du formulaire a été cliqué
    if (isset($_POST['submit']))
    {
        // Filtre le nom
        $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_SPECIAL_CHARS);
        $categoriesInput = intval(filter_input(INPUT_POST, "categories", FILTER_VALIDATE_INT));

        // Affiche une erreur si la catégorie existe sinon on crée l'article
        if (CategoryExists($name))
        {
            $msg = "<p id='error'><i class='fa-solid fa-triangle-exclamation fa-xl me-2'></i> Cette catégorie existe déjà.</p>";
        }
        else
        {
            // Récupère la catégorie qu'on a selectionné (utilisé pour afficher le message de succes)
            $category =  GetCategory(intval($categoriesInput));

            // Met à jour la catégorie
            UpdateCategory(intval($categoriesInput), $name);

            $msg = "<p id='success'> La catégorie <strong> $category->name </strong> à été modifier en <strong> $name </strong>. </p>";
            $name = '';
        }
    }

    function ShowCategories($categoriesInput)
    {
        // Récupère toutes les catégories
        $categories = GetCategories();

        $result = "";

        // Affiche chaque catégorie dans la combo box
        foreach ($categories as $category)
        {
            $result .= "<option value='$category->id'";
            if ($categoriesInput == $category->id)
            {
                $result .= " selected";
            }
            $result .= ">$category->name</option>";
        }
        $result .="</select>";
        echo $result;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une catégorie</title>

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
        <h2 class="mb-5">Modifier une catégorie</h2>
        <div class="my-3" id='errorMsg' role='alert'><?=$msg?></div>

        <form method="post" onsubmit="return validateForm()">
        
            <div class="my-4">
                <label for="categories" class="form-label">Choisissez une catégorie à modifier</label>
                <select name='categories' id="categories" class='form-select filterControl' value='$categoriesInput'>
                    <option value='0' selected>---</option>
                    <?=ShowCategories($categoriesInput)?>
                <div id="categoriesHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="name" class="form-label">Nouveau nom de la catégorie</label>
                <input name="name" type="name" class="form-control" id="name" onkeyup="toUpperCase()" value="<?=$name?>">
                <div id="nameHelp" class="form-text text-danger"></div>
            </div>

            <div class="d-flex flex-row-reverse my-3">
                <button name="submit" type="submit" class="btn btn-primary submitBtn mb-3" value="submit">Modifier le nom de la catégorie</button>
            </div>
        </form>
    </main>
    <script src="./assets/libraries/bootstrap/bootstrap.js"></script>
    <script src="./assets/js/validateUpdateCategory.js"></script>
</body>
</html>