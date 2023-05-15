<?php
require_once ROOT.'db/database.php';
require_once ROOT.'containers/CartItem.php';

function AddCartItem($userId, $articleId)
{
    // Si l'article n'existe pas dans le panier on l'ajoute sinon on augmente sa quantité de 1
    if(!CartItemExists($userId, $articleId))
    {
        // Requête SQL qui insert un article dans le panier
        $sql = "INSERT INTO `CART_ITEMS` (`USERS_ID`, `ARTICLES_ID`, `QUANTITY`) VALUES (:userId, :articleId, 1)";
    }
    else
    {
        // Requête SQL qui augmente la quantité de 1
        $sql = "UPDATE CART_ITEMS
        SET QUANTITY = QUANTITY + 1
        WHERE USERS_ID = :userId
        AND ARTICLES_ID = :articleId";
    }

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL pour ajouter un article dans le panier
        $statement->execute(array(':userId' => $userId, 'articleId' => $articleId));
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
    
    // Retourne true si la création a été effectuée avec succès
    return true;
}

/**
 * Récupère les articles présents dans le panier d'un utilisateur.
 *
 * @param int $userId L'ID de l'utilisateur
 * @return array|false Le tableau d'objets CartItem représentant les articles du panier, ou false en cas d'erreur.
 */
function GetCartItems($userId)
{
    // Initialise le tableau d'articles du panier
    $cartItemArray = array();

    // Requête SQL pour récupérer les données des articles du panier
    $sql = "SELECT `USERS_ID`, `ARTICLES_ID`, `QUANTITY`
    FROM `CART_ITEMS`
    WHERE `USERS_ID` = :userId";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try {
        // Exécute la requête SQL pour récupérer les articles du panier
        $statement->execute(array(':userId' => $userId));

        // Parcourt tous les résultats de la requête pour créer un tableau d'objets CartItem
        while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
        {
            // Crée un objet CartItem à partir des données récupérées
            $cartItem = new CartItem(
                intval($row['USERS_ID']),        // USERS_ID   : l'identifiant unique de l'utilisateur (entier)
                intval($row['ARTICLES_ID']),     // ARTICLES_ID : l'identifiant unique de l'article (entier)
                intval($row['QUANTITY']),        // QUANTITY   : la quantité de l'article dans le panier (entier)
            );

            // Ajoute l'objet CartItem créé au tableau d'articles du panier
            array_push($cartItemArray, $cartItem);
        }
    } catch (PDOException $e) {
        // En cas d'erreur, retourne false
        return false;
    }

    // Retourne le tableau d'objets CartItem représentant les articles du panier
    return $cartItemArray;
}

/**
 * Supprime un article du panier en fonction de son ID.
 * @param int $articleId L'ID de l'article à supprimer.
 * @return bool Retourne true si la suppression a été effectuée avec succès, sinon false.
 */
function DeleteCartItem($articleId)
{
    // Requête SQL qui supprime un article du panier en fonction de son ID
    $sql = "DELETE FROM `CART_ITEMS` WHERE `ARTICLES_ID` = :articleId";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête en passant l'ID de l'article en paramètre
        $statement->execute(array(":articleId" => $articleId));

        // Retourne true pour indiquer que la suppression a réussi
        return true;
    }
    catch (PDOException $e)
    {
        // Retourne false pour indiquer que la suppression a échoué
        return false;
    }
}

/**
 * Vérifie si un article est déjà présent dans le panier d'un utilisateur.
 *
 * @param int $userId L'ID de l'utilisateur
 * @param int $articleId L'ID de l'article
 * @return bool True si l'article est présent dans le panier, sinon False.
 */
function CartItemExists($userId, $articleId)
{
    // Requête SQL pour vérifier si l'article est présent dans le panier
    $sql = "SELECT `USERS_ID`, `ARTICLES_ID` FROM CART_ITEMS WHERE `USERS_ID` = :userId AND `ARTICLES_ID` = :articleId";
    
    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête avec l'ID utilisateur et l'ID article fournis
        $statement->execute(array(":userId" => $userId, ":articleId" => $articleId));
        
        // Vérifie s'il y a des lignes correspondantes
        return boolval($statement->rowCount() > 0);
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne False
        return false;
    }
}