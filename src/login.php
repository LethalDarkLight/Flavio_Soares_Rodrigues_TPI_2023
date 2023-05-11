<?php
    // Inclusion des fichiers nécessaires
    require_once './includes/checkAll.php';

    // Vérifie si la session de l'utilisateur est valide, si oui, redirige vers la page d'accueil
    if (ESessiontManager::IsValid() === true)
    {
        header("Location: index.php");
        exit();
    }

    // Filtre les valeurs des inputs
    $email = filter_input(INPUT_POST,"email", FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
    $submit = filter_input(INPUT_POST,"submit", FILTER_SANITIZE_SPECIAL_CHARS);

    // Variable pour le message d'erreur géré avec php
    $msg = "";

    // Si le bouton du formulaire a été cliqué
    if ($submit == "login")
    {
        // Vérifie si les identifiants de connexion sont valides, si oui, redirige vers la page d'accueil
        if (LoginUser($email, $password))
        {
            header("Location: index.php");
            exit();
        }
        else
        {
            // Affiche un message d'erreur
            $msg = "<p id='error'><i class='fa-solid fa-triangle-exclamation fa-xl me-2'></i> Email ou mot de passe incorrecte.</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
        <h2 class="mb-5">Connexion</h2>
        <div class="my-3" id='errorMsg' role='alert'><?=$msg?></div>

        <!-- Formulaire de connexion -->
        <form method="post" onsubmit="return validateLogin()">

            <!-- Email -->
            <div class="my-4">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?=$email?>">
                <div id="emailHelp" class="form-text text-danger"></div>
            </div>

            <!-- Mot de passe -->
            <div class="my-4">
                <label for="password" class="form-label">Mot de passe</label>
                <input name="password" type="password" class="form-control" id="password" aria-describedby="emailHelp">
                <div id="passwordHelp" class="form-text text-danger"></div>
            </div>

            <!-- Bouton de validation -->
            <div class="d-flex flex-row-reverse my-3">
                <button name="submit" type="submit" class="btn btn-primary submitBtn mb-3" value="login">Se connecter</button>
            </div>
        </form>
        <div class="text-center mt-2 card card-body">
            <h6 class="card-subtitle mb-2"> Vous êtes nouveau sur GYM ?</h6>
                <a class="card-link text-decoration-none" href="register.php">Inscrivez-vous</a>
        </div>
    </main>
    <script src="./assets/js/validateEmail.js"></script>
    <script src="./assets/js/validateLogin.js"></script>
</body>
</html>