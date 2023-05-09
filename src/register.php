<?php
    // Inclusion des fichiers nécessaires
    require_once './includes/web.inc.all.php';
    require_once ROOT.'includes/checkAll.php';
    require_once ROOT. 'includes/registerTools.php';

    // Vérifie si la session de l'utilisateur est valide, si oui, redirige vers la page d'accueil
    if (ESessiontManager::IsValid() === true)
    {
        header("Location: index.php");
        exit();
    }

    // Filtre les valeurs des inputs
    $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_SPECIAL_CHARS);         // Nom
    $surname = filter_input(INPUT_POST,"surname", FILTER_SANITIZE_SPECIAL_CHARS);   // Prénom
    $gender = filter_input(INPUT_POST,"gender", FILTER_SANITIZE_SPECIAL_CHARS);     // Genre
    $address1 = filter_input(INPUT_POST,"address1", FILTER_SANITIZE_SPECIAL_CHARS); // Adresse 2
    $address2 = filter_input(INPUT_POST,"address2", FILTER_SANITIZE_SPECIAL_CHARS); // Adresse 2
    $city = filter_input(INPUT_POST,"city", FILTER_SANITIZE_SPECIAL_CHARS);         // Ville
    $zipCode = filter_input(INPUT_POST,"zipCode", FILTER_SANITIZE_SPECIAL_CHARS);   // Code postal

    $email = filter_input(INPUT_POST,"email", FILTER_VALIDATE_EMAIL);               // Email
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS); // Mot de passe
    $submit = filter_input(INPUT_POST,"submit", FILTER_SANITIZE_SPECIAL_CHARS);     // Bouton de validation

    // Variable pour le message d'erreur géré avec php
    $msg = "";

    // Si le bouton du formulaire a été cliqué
    if ($submit == "register")
    {

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

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
    <main class="mx-auto mt-5">
        <h2 class="mb-5">Inscription</h2>
        <div class="my-3" id='errorMsg' role='alert'><?=$msg?></div>

        <!-- Formulaire d'inscription -->
        <form method="post" onsubmit="return validateRegister()">

            <!-- Nom -->
            <div class="my-4">
                <label for="name" class="form-label">Nom <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" value="<?=$name?>">
                <div id="nameHelp" class="form-text text-danger"></div>
            </div>

            <!-- Prénom -->
            <div class="my-4">
                <label for="surname" class="form-label">Prénom <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input name="surname" type="text" class="form-control" id="surname" aria-describedby="surnameHelp" value="<?=$surname?>">
                <div id="surnameHelp" class="form-text text-danger"></div>
            </div>

            <!-- Genre -->
            <div class="my-4">
                <label for="gender" class="form-label">Genre <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <select name="gender" id="gender" class="form-select" aria-describedby="genderHelp">
                    <option value="0" <?php if ($gender == '') echo 'selected'; ?>>---</option>
                    <option value="1" <?php if ($gender == '') echo 'selected'; ?>>Homme</option>
                    <option value="2" <?php if ($gender == '') echo 'selected'; ?>>Femme</option>
                    <option value="3" <?php if ($gender == '') echo 'selected'; ?>>Autre</option>
                </select>
                <div id="genderHelp" class="form-text text-danger"></div>
            </div>

            <!-- Adresse 1 -->
            <div class="my-4">
                <label for="address1" class="form-label">Adresse 1 <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input name="address1" type="text" class="form-control" id="address1" aria-describedby="address1Help" value="<?=$address1?>">
                <div id="address1Help" class="form-text text-danger"></div>
            </div>

            <!-- Adresse 2 -->
            <div class="my-4">
                <label for="address2" class="form-label">Address 2</label>
                <input name="address2" type="text" class="form-control" id="address2" value="<?=$address2?>">
            </div>

            <!-- Ville -->
            <div class="my-4">
                <label for="cities" class="form-label">Ville <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <select name="cities" id="cities" class="form-select" aria-describedby="citiesHelp" aria-selected="<?=$cities?>">
                    <option value="0" selected>---</option>
                    <?=ShowCities()?>
                </select>
                <div id="citiesHelp" class="form-text text-danger"></div>
            </div>

            <!-- Code postal -->
            <div class="my-4">
                <label for="zipCode" class="form-label">Code postal <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input name="zipCode" type="text" class="form-control" id="zipCode" aria-describedby="zipCode" value="<?=$zipCode?>">
                <div id="zipCodeHelp" class="form-text text-danger"></div>
            </div>

            <!-- Email -->
            <div class="my-4">
                <label for="email" class="form-label">Email <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?=$email?>">
                <div id="emailHelp" class="form-text text-danger"></div>
            </div>

            <!-- Mot de passe -->
            <div class="my-4">
                <label for="password" class="form-label">Mot de passe <i class="fa-sharp fa-solid fa-star-of-life text-primary"></i></label>
                <input name="password" type="password" class="form-control" id="password" aria-describedby="passwordHelp" minlength="8">
                <div id="passwordHelp" class="form-text text-danger"></div>
            </div>

            <!-- Bouton de validation -->
            <div class="d-flex flex-row-reverse my-3">
                <button name="submit" type="submit" class="btn btn-primary submitBtn mb-3" value="register">S'inscrire</button>
            </div>
        </form>

        <div class="text-center mt-2 card card-body">
            <h6 class="card-subtitle mb-2"> Vous possédez déjà un compte ?</h6>
            <a class="card-link text-decoration-none" href="login.php">Connectez-vous</a>
        </div>
    </main>
    <script src="./assets/js/validateEmail.js"></script>
    <script src="./assets/js/validateRegister.js"></script>
</body>
</html>