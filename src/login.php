<?php
    require_once './includes/web.inc.all.php';
    require_once ROOT.'includes/checkAll.php';

    $email = filter_input(INPUT_POST,"email", FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
    $submit = filter_input(INPUT_POST,"submit", FILTER_SANITIZE_SPECIAL_CHARS);

    $msg = "";

    if ($submit == "login")
    {
        if (LoginUser($email, $password))
        {
            header("Location: index.php");
            exit();
        }
        else
        {
            $msg = "<i class='fa-solid fa-triangle-exclamation fa-xl me-2'></i> Email ou mot de passe incorrecte.";
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
        <h1 class="mb-5">Se connecter</h1>

        <div class="my-3" id='errorMsg' role='alert'><?=$msg?></div>

        <form method="post" onsubmit="return validateLogin()">
            <div class="my-4">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?=$email?>">
                <div id="emailHelp" class="form-text text-danger"></div>
            </div>

            <div class="my-4">
                <label for="password" class="form-label">Mot de passe</label>
                <input name="password" type="password" class="form-control" id="password" aria-describedby="emailHelp">
                <div id="passwordHelp" class="form-text text-danger"></div>
            </div>

            <div class="d-flex flex-row-reverse">
                <button name="submit" type="submit" class="btn btn-primary submitBtn mb-3" value="login">Se connecter</button>
            </div>
        </form>
        <div class="text-center mt-2">
            <p> Nouveau sur GYM ? <br>
                <a href="register.php">Créer votre compte GYM</a>
            </p>
        </div>
    </main>
    <script src="./assets/js/validateLogin.js"></script>
</body>
</html>