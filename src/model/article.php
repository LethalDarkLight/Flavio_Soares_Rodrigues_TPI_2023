<?php
require_once ROOT.'db/database.php';
require_once ROOT.'containers/Article.php';

/**
 * Ajoute un nouvel article dans la base de données
 * @param string $name Le nom de l'article
 * @param string $description La description de l'article
 * @param double $price Le prix de l'article
 * @param int $stock Le stock disponible pour l'article
 * @param bool $featured Indique si l'article est à la une ou non
 * @param int $categoryId L'ID de la catégorie à laquelle l'article appartient
 * @return bool Renvoie true si l'opération a réussi, false sinon
 */
function AddArticle($name, $description, $price, $stock, $featured, $categoryId)
{
    // Requête SQL pour insérer un article dans la base de données
    $sql = "INSERT INTO `ARTICLES`(`NAME`, `DESCRIPTION`, `PRICE`, `STOCK`, `FEATURED`, `CATEGORIES_ID`)
    VALUES(:name, :description, :price, :stock, :featured, :categoryId)";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL avec les paramètres nécessaires
        $statement->execute(array(
            ":name" => $name,
            ":description" => $description,
            ":price" => $price,
            ":stock" => $stock,
            ":featured" => $featured,
            ":categoryId" => $categoryId
        ));
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
    // Retourne true si tout s'est bien passé
    return true;
}

/**
 * Récupère un article grâce à son nom donné en paramètre
 * @param string $name le nom de l'article
 * @return mixed L'article récupéré sous forme d'objet Article, ou false si une erreur est survenue
 */
function GetArticle($name)
{
    // Requête SQL qui récupère les données de l'article
    $sql = "SELECT `ID`, `NAME`, `DESCRIPTION`, `PRICE`, `STOCK`, `FEATURED`, `CREATION_DATE`, `UPDATE_DATE`, `CATEGORIES_ID`
    FROM `ARTICLES`
    WHERE `NAME` = :name";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL en utilisant l'ID passé en paramètre
        $statement->execute(array(":name" => $name));

        // Récupère la première ligne de résultat
        $row = $statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT);

        // Crée un objet Article à partir des données récupérées
        return new Article(
            intval($row['ID']),                 // ID            : l'identifiant unique de l'article (entier)
            $row['NAME'],                       // NAME          : le nom de l'article (chaîne de caractères)
            $row['DESCRIPTION'],                // DESCRIPTION   : la description de l'article (chaîne de caractères)
            doubleval($row['PRICE']),           // PRICE         : le prix de l'article (nombre à virgule flottante)
            intval($row['STOCK']),              // STOCK         : la quantité en stock de l'article (entier)
            intval($row['FEATURED']),          // FEATURED      : un booléen qui indique si l'article est à la une ou non (booléen)
            $row['CREATION_DATE'],              // CREATION_DATE : la date de création de l'article (objet DateTime)
            $row['UPDATE_DATE'],                // UPDATE_DATE   : la date de mise à jour de l'article (objet DateTime)
            intval($row['CATEGORIES_ID'])       // CATEGORIES_ID : l'ID de la catégorie à laquelle appartient l'article (entier)
        );
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
}

/**
 * Récupère un article grâce à son ID donné en paramètre
 * @param int $id L'identifiant unique de l'article
 * @return mixed L'article récupéré sous forme d'objet Article, ou false si une erreur est survenue
 */
function GetArticleById($id)
{
    // Requête SQL qui récupère les données de l'article
    $sql = "SELECT `ID`, `NAME`, `DESCRIPTION`, `PRICE`, `STOCK`, `FEATURED`, `CREATION_DATE`, `UPDATE_DATE`, `CATEGORIES_ID`
    FROM `ARTICLES`
    WHERE `ID` = :id";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL en utilisant l'ID passé en paramètre
        $statement->execute(array(":id" => $id));

        // Récupère la première ligne de résultat
        $row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

        // Crée un objet Article à partir des données récupérées
        return new Article(
            intval($row['ID']),                 // ID            : l'identifiant unique de l'article (entier)
            $row['NAME'],                       // NAME          : le nom de l'article (chaîne de caractères)
            $row['DESCRIPTION'],                // DESCRIPTION   : la description de l'article (chaîne de caractères)
            doubleval($row['PRICE']),           // PRICE         : le prix de l'article (nombre à virgule flottante)
            intval($row['STOCK']),              // STOCK         : la quantité en stock de l'article (entier)
            intval($row['FEATURED']),           // FEATURED      : un booléen qui indique si l'article est à la une ou non (entier converti en booléen)
            new DateTime($row['CREATION_DATE']),// CREATION_DATE : la date de création de l'article (objet DateTime)
            new DateTime($row['UPDATE_DATE']),  // UPDATE_DATE   : la date de mise à jour de l'article (objet DateTime)
            intval($row['CATEGORIES_ID'])       // CATEGORIES_ID : l'ID de la catégorie à laquelle appartient l'article (entier)
        );
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
}

/**
 * Cette fonction récupère les 10 articles mis à la une les plus récent
 * dans la base de données et retourne un tableau d'objets Article.
 *
 * @return array|false Un tableau d'objets Article ou false si une erreur est survenue.
 */
function GetFeaturedArticles()
{
    // Initialise un tableau d'articles vide
    $arrayArticles = array();

    // Requête SQL qui récupère les articles à la une
    $sql = "SELECT `ID`, `NAME`, `DESCRIPTION`, `PRICE`, `STOCK`, `FEATURED`, `CREATION_DATE`, `UPDATE_DATE`, `CATEGORIES_ID`
    FROM `ARTICLES`
    WHERE `FEATURED` = 1
    ORDER BY `CREATION_DATE` DESC LIMIT 10";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL
        $statement->execute();

        // Parcourt tous les résultats de la requête pour créer un tableau d'objets Article
        while ($row = $statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
        {
            // Crée un objet Article avec les données récupérées
            $article = new Article(
                intval($row['ID']),             // ID           : Identifiant de l'article (entier)
                $row['NAME'],                   // NAME         : Nom de l'article (chaîne de caractères)
                $row['DESCRIPTION'],            // DESCRIPTION  : Description de l'article (chaîne de caractères)
                doubleval($row['PRICE']),        // PRICE        : Prix de l'article (nombre à virgule flottante)
                intval($row['STOCK']),          // STOCK        : Stock disponible de l'article (entier)
                boolval($row['FEATURED']),      // FEATURED     : Indique si l'article est à la une (booléen)
                $row['CREATION_DATE'],          // CREATION_DATE: Date de création de l'article (chaîne de caractères)
                $row['UPDATE_DATE'],            // UPDATE_DATE  : Date de mise à jour de l'article (chaîne de caractères)
                intval($row['CATEGORIES_ID'])   // CATEGORIES_ID: Identifiant de la catégorie associée à l'article (entier)
            );

            // Ajoute l'objet Article au tableau
            array_push($arrayArticles, $article);
        }

        // Retourne le tableau d'objets Article
        return $arrayArticles;
    }
    catch(PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
}

/**
 * Récupère les articles en fonction des filtres spécifiés.
 *
 * @param string|null $text Chaîne de caractères à rechercher dans les noms et descriptions des articles. Null si aucun filtre n'est appliqué.
 * @param int|null $categoryId Identifiant de la catégorie à laquelle appartiennent les articles. Null si aucun filtre n'est appliqué.
 * @param float|null $minPrice Prix minimum des articles. Null si aucun filtre n'est appliqué.
 * @param float|null $maxPrice Prix maximum des articles. Null si aucun filtre n'est appliqué.
 * @return array|false Tableau d'objets Article filtrés ou false en cas d'erreur
 */
function GetFilteredArticles($text, $categoryId, $minPrice, $maxPrice)
{
    // Initialise un tableau d'articles vide
    $arrayArticles = array();

    // Requête SQL qui récupère les données de l'article avec les filtres appliqués
    $sql = "SELECT `ID`, `NAME`, `DESCRIPTION`, `PRICE`, `STOCK`, `FEATURED`, `CREATION_DATE`, `UPDATE_DATE`, `CATEGORIES_ID` FROM `ARTICLES` WHERE 1=1";

    // Initialise un tableau de paramètres vide
    $params = array();

    // Si la variable $text n'est pas vide, ajoute une condition à la requête SQL et un paramètre dans le tableau des paramètres à envoyer à la requête
    if (!empty($text))
    {
        $sql .= " AND (`NAME` LIKE :t OR `DESCRIPTION` LIKE :t)";
        $queryParam = "%" . $text . "%";

        $params[":t"] = $queryParam;
    }

    // Si la variable $categoryId est supérieure à 0, ajoute une condition à la requête SQL et un paramètre dans le tableau des paramètres à envoyer à la requête
    if ($categoryId > 0)
    {
        $sql .= " AND `CATEGORIES_ID` = :category_id";
        $params[":category_id"] = $categoryId;
    }

    // Si la variable $minPrice est supérieure à 0, ajoute une condition à la requête SQL et un paramètre dans le tableau des paramètres à envoyer à la requête
    if ($minPrice > 0)
    {
        $sql .= " AND `PRICE` >= :min_price";
        $params[":min_price"] = $minPrice;
    }

    // Si la variable $maxPrice est supérieure à 0, ajoute une condition à la requête SQL et un paramètre dans le tableau des paramètres à envoyer à la requête
    if ($maxPrice > 0)
    {
        $sql .= " AND `PRICE` <= :max_price";
        $params[":max_price"] = $maxPrice;
    }

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL en envoyant le tableau des paramètres
        $statement->execute($params);

        // Parcourt tous les résultats de la requête pour créer un tableau d'objets Article
        while ($row = $statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
        {
            // Crée un objet Article avec les données récupérées
            $article = new Article(
                intval($row['ID']),             // ID           : Identifiant de l'article (entier)
                $row['NAME'],                   // NAME         : Nom de l'article (chaîne de caractères)
                $row['DESCRIPTION'],            // DESCRIPTION  : Description de l'article (chaîne de caractères)
                doubleval($row['PRICE']),       // PRICE        : Prix de l'article (nombre à virgule flottante)
                intval($row['STOCK']),          // STOCK        : Stock disponible de l'article (entier)
                boolval($row['FEATURED']),      // FEATURED     : Indique si l'article est à la une (booléen)
                $row['CREATION_DATE'],          // CREATION_DATE: Date de création de l'article (chaîne de caractères)
                $row['UPDATE_DATE'],            // UPDATE_DATE  : Date de mise à jour de l'article (chaîne de caractères)
                intval($row['CATEGORIES_ID'])   // CATEGORIES_ID: Identifiant de la catégorie associée à l'article (entier)
            );
            // Ajoute l'objet Article au tableau
            array_push($arrayArticles, $article);
        }
        // Retourne le tableau d'objets Article
        return $arrayArticles;
    }
    catch(PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
}

/**
 * Vérifie si un article avec un nom donné existe dans la table `ARTICLES`.
 *
 * @param string $name Le nom de l'article à rechercher.
 * @return bool True si l'article existe, False sinon.
 */
function ArticleExists($name)
{
    $sql = "SELECT `ID` FROM `ARTICLES` WHERE `NAME` = :n";
    $statement = EDatabase::prepare($sql);

    try
    {
        $statement->execute(array(":n" => $name));
        return boolval($statement->rowCount() > 0); // retourne true si l'article existe sinon false
    }
    catch(PDOException $e)
    {
        return false;
    }
}


///
///
/////
/////
////
function UpdateArticle($userId, $articleId, $quantity)
{
    // Requête SQL qui met à jour la quantité de l'article
    $sql = "UPDATE CART_ITEMS
    SET QUANTITY = :quantity
    WHERE USERS_ID = :userId
    AND ARTICLES_ID = :articleId";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL pour mettre à jour la quantité de l'article dans le panier
        $statement->execute(array(':userId' => $userId, ':articleId' => $articleId, ':quantity' => $quantity));
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }

    // Retourne true si la mise à jour a été effectuée avec succès
    return true;
}

/**
 * Diminue le stock d'un article.
 *
 * @param int $id Identifiant de l'article.
 * @param int $stock Quantité à déduire du stock.
 * @return bool Retourne true si la mise à jour a été effectuée avec succès, sinon false.
 */
function DecreaseStock($id, $stock)
{
    // Requête SQL qui met à jour la quantité de l'article
    $sql = "UPDATE ARTICLES
    SET STOCK = STOCK - :stock
    WHERE ID = :id";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL pour mettre à jour la quantité de l'article dans le panier
        $statement->execute(array(':id' => $id, ':stock' => $stock));
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }

    // Retourne true si la mise à jour a été effectuée avec succès
    return true;
}