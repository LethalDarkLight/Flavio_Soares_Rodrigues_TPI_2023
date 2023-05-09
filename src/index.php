<?php
require_once './includes/web.inc.all.php';
require_once ROOT.'includes/checkAll.php';

// Test si la session est valide
if (ESessiontManager::IsValid() === false)
{
    echo 'Session not valid';
}
else
{
    echo 'Session valid';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    
</body>
</html>