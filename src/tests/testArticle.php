<?php
require_once '../model/article.php';

$articleName = "Hack squat";
$msg = "";

// Permet de vérifier si le nom de l'article existe ou non dans la base de données
if (ArticleExists($articleName) == true)
{
    $msg = "existe";
}
else
{
    $msg = "n'existe pas alors on peut créer l'article";
    AddArticle($articleName, "L’équipement parfait pour le développement du bas du corps. Maximisez les bénéfices des squats avec Hack Squat", 6999.95, 3, 0, 1); // Créer un article
}
echo($msg);

var_dump(GetFilteredArticles("bell", 0, 0, 0));

var_dump(GetFilteredArticles("bell", 0, 10, 0));

var_dump(GetFilteredArticles("bell", 0, 10, 100));

echo "-----------------------------------------------------------------------------------------";
var_dump (GetArticle(1));
echo "-----------------------------------------------------------------------------------------";
var_dump(GetFeaturedArticles());