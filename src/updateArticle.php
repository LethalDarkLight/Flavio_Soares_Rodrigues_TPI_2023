<?php
// Pour accéder à cette page l'utilisateur doit être authentifié entant qu'administrateur
$REQUIREDLOGIN = true;
$REQUIREDADMIN = true;

require_once './includes/checkAll.php';
require_once ROOT. 'tools/addArticleTools.php';

// Empêche l'utilisateur d'acceder à la page via l'url 
if (!isset($_GET['id']))
{
    header("Location: login.php");
	exit();
}

$article = GetArticleById(intval($_GET['id']));
$articleId = $article->id;

//var_dump($images);

$description = $article->description;
$featuredValue = $article->featured ? 'true' : 'false';

// Initialisation des variables    
/*$name = "";
$description = "";
$price = 0;
$category = 0;
$stock = 0;*/

$msg = "";

// Si le bouton du formulaire a été cliqué
if (isset($_POST['submit']) && $_POST['submit'] == "Valider")
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
        if (UpdateArticle($articleId, $name, $description, $price, $stock, $featured, $category))
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

// Affiche les images
function ShowImages($articleId)
{
    $images = GetImages($articleId);

    $result = "";

    foreach ($images as $key => $image)
    {
        // Supprime une image lors ce que l'on clique sur le boutton supprimer
        if (isset($_POST['deleteImage']) && intval($_POST['deleteImage']) == $image->id)
        {
            DeleteImage($image->id);
        }

        $result .= "
        <div class='d-flex flex-row align-items-center'>
            <img src='$image->content' alt='$image->name' style='width:200px'>
            <form method='post' class='text-center'>
                <button name='deleteImage' type='submit' class='btn btn-danger mb-3 mx-4' style='width:200px; height:60px' value='$image->id'><i class='fa-solid fa-trash fa-lg'></i> Supprimer</button>
            </form>
        </div>";
    }
    echo $result;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un article</title>

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
<!--body onload="toggle(document.getElementById('featured'))"-->
    <?=ShowNavbar()?>
    <main class="mx-auto mt-5">
        <h2 class="mb-5">Modifier un article</h2>
        <div class="my-3" id='errorMsg' role='alert'><?=$msg?></div>

        <form method="post" onsubmit="return validateForm()" enctype="multipart/form-data">

            <div class="my-4">
                <label for="name" class="form-label">Nom de l'article <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input type="text" name="name" id="name" class="form-control" value="<?=$article->name?>">
                <div id="nameHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="description" class="form-label">Description <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <textarea id="description" name="description" value=""></textarea>
                <div id="descriptionHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="price" class="form-label">Prix <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input type="number" id="price" class="form-control" name="price" step="0.05" min="0" value="<?=$article->price?>">
                <div id="priceHelp" class="form-text text-danger"></div>
            </div>

            <div >
                <?=ShowImages($articleId)?>
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
                    <?=ShowCategories($article->categoryId)?>
                </select>
                <div id="categoryHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="stock" class="form-label">Quantité en stock <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input type="number" id="stock" class="form-control" name="stock" min="0" value="<?=$article->stock?>">
                <div id="stockHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="featured" class="form-check-label">Mise en avant </i></label>
                <input type="checkbox" id="featured" class="form-check-input" name="featured" value="<?=$article->featured?>" <?= $featuredValue === 'true' ? 'checked' : '' ?>>
            </div>

            <div class="my-4">
                <input name="submit" type="submit" class="btn btn-primary submitBtn mb-3" value="Valider">
            </div>
        </form>
    </main>

<script src="./assets/libraries/tinyMCE/tinymce/tinymce.min.js"></script>
<script src="./assets/libraries/tinyMCE/parametreTinymce.js"></script>
<script src="./assets/js/validateUpdateArticle.js"></script>
<script src="./assets/libraries/bootstrap/bootstrap.js"></script>

</body>
<script> 
    let descriptionContent = "<?php echo htmlspecialchars($description); ?>"
    window.addEventListener("load", function(){
        let el = tinymce.get('description');
        if (el)
            el.setContent(descriptionContent);
    });


</script>

</html>