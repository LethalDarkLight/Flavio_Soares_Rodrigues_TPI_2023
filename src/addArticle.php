<?php
// Pour accéder à cette page l'utilisateur doit être authentifié entant qu'administrateur
$REQUIREDLOGIN = true;
$REQUIREDADMIN = true;

require_once './includes/checkAll.php';
require_once ROOT. 'tools/addArticleTools.php';

// Initialisation des variables    
$name = "";
$description = "";
$price = 0;
$category = 0;
$stock = 0;
$featured = 0;
$msg = "";

// Si le bouton du formulaire a été cliqué
if (isset($_POST['submit']))
{
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);                    // Nom
    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);      // Description
    $price = doubleval(filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT));               // Prix                                                         
    $category = intval(filter_input(INPUT_POST, "categories", FILTER_VALIDATE_INT));            // Catégorie
    $stock = intval(filter_input(INPUT_POST, "stock", FILTER_VALIDATE_INT));                    // Stock
    $featured = isset($_POST['featured']) ? 1 : 0;                                              // Mis en avant

    // Si l'article existe on affiche un message d'erreur
    if (ArticleExists($name))
    {
        // Affiche un message d'erreur
        $msg = "<p id='error'><i class='fa-solid fa-triangle-exclamation fa-xl me-2'></i> Cet article existe déjà</p>";
    }
    else
    {
        $files = $_FILES['files']; // Récupère les images

        // Ajoute un article
        if (AddArticle($name, $description, $price, $stock, $featured, $category))
        {
            $articleId = GetArticle($name)->id; // Récupère l'id de l'article qui vien d'être créer
            
            // Permet de vérifier que $_FILES contient un fichier
            if (!empty($files['name'][0]))
            {
                // Parcours l'ensemble des fichiers
                for ($i = 0; $i < count($files['name']); $i++)
                {
                    $fileName = uniqid();                                       // Nom du fichier (unique)
                    $fileContent = file_get_contents($files["tmp_name"][$i]);   // Contenu de l'image
                    $fileType = $files['type'][$i];                             // Type de fichier

                    // Image principale (true pour la première insertion) puis false
                    $mainImage = ($i === 0);
                    
                    // Ajoute les images
                    AddEnc64Image($fileContent, $fileName, $fileType, intval($mainImage), $articleId);
                }
                $msg = "<p id='success'>L'article à été ajouté avec success</p>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article</title>

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
        <h2 class="mb-5">Ajouter un article</h2>
        <div class="my-3" id='errorMsg' role='alert'><?=$msg?></div>

        <form method="post" onsubmit="return validateForm()" enctype="multipart/form-data">

            <div class="my-4">
                <label for="name" class="form-label">Nom de l'article <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input type="text" name="name" id="name" class="form-control">
                <div id="nameHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="description" class="form-label">Description <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <textarea id="description" name="description"></textarea>
                <div id="descriptionHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="price" class="form-label">Prix <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input type="number" id="price" class="form-control" name="price" step="0.05" min="0">
                <div id="priceHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="image" class="form-label">Image <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input type="file" id="image" name="files[]" class="form-control" accept="image/*" multiple>
                <div id="imageHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="categories" class="form-label">Catégorie <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <select id="categories" class="form-select" name="categories">
                    <option value="0" selected>---</option>
                    <?=ShowCategories($category)?>
                </select>
                <div id="categoryHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="stock" class="form-label">Quantité en stock <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input type="number" id="stock" class="form-control" name="stock" min="0">
                <div id="stockHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="featured" class="form-check-label">Mis en avant </i></label>
                <input type="checkbox" id="featured" class="form-check-input" name="featured">
            </div>

            <div class="my-4">
                <input name="submit" type="submit" class="btn btn-primary submitBtn mb-3" value="Valider">
            </div>
        </form>
    </main>

<script src="./assets/libraries/tinyMCE/tinymce/tinymce.min.js"></script>
<script src="./assets/libraries/tinyMCE/parametreTinymce.js"></script>
<script src="./assets/js/validateAddArticle.js"></script>
<script src="./assets/libraries/bootstrap/bootstrap.js"></script>

</body>
</html>