<?php
    $email = filter_input(INPUT_POST,"email", FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
    $submit = filter_input(INPUT_POST,"submit", FILTER_SANITIZE_SPECIAL_CHARS);

    if ($submit == "login")
    {
        echo "ok";
    }
    else
    {
        echo "not";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="assets/libraries/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <main class="mx-auto mt-5">
        <h1>Se connecter</h1>
        <form method="post">
            <div class="my-4">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text text-danger">Email ou mot de passe incorrecte</div>
            </div>

            <div class="my-4">
                <label for="password" class="form-label">Mot de passe</label>
                <input name="password" type="password" class="form-control" id="password" aria-describedby="emailHelp">
                <div id="passwordHelp" class="form-text text-danger">Email ou mot de passe incorrecte</div>
            </div>

            <div class="d-flex flex-row-reverse">
                <button name="submit" type="submit" class="btn btn-primary w-25" value="login">Se connecter</button>
            </div>
        </form>
        <div class="text-center mt-2">
            <p> Nouveau sur GYM ? <br>
                <a href="register.php">Créer votre compte GYM</a>
            </p>
        </div>
    </main>
</body>
</html>