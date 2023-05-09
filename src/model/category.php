<?php
require_once ROOT.'db/database.php';
require_once ROOT.'containers/Category.php';

/**
 * Récupère la liste des catégories sous forme d'objet Category
 * @return array|false Le tableau d'objets Category représentant les catégories, ou false en cas d'erreur
 */
function GetCategories()
{
    // Initialise le tableau de catégories
    $arrayCategory = array();

    // Requête SQL qui récupère les données des catégories
    $sql = "SELECT `ID`, `NAME` FROM `CATEGORIES`";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL pour récupérer les catégories
        $statement->execute();

        // Parcourt tous les résultats de la requête pour créer un tableau d'objets Category
        while ($row = $statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
        {
            // Crée un objet Category à partir des données récupérées
            $category = new Category(
                intval($row['ID']),         // ID        : l'identifiant unique de la catégorie (entier)
                $row['NAME']                // NAME      : le nom de la catégorie (chaîne de caractères)
            );

            // Ajoute l'objet Category créé au tableau de catégories
            array_push($arrayCategory, $category);
        }
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
    
    // Retourne le tableau d'objets Category représentant les catégories
    return $arrayCategory;
}

/**
 * Récupère le nom de la catégorie correspondant à l'ID spécifié
 * @param int $id L'ID de la catégorie à rechercher
 * @return Category|false L'objet Category correspondant à l'ID spécifié, ou false en cas d'erreur
 */
function GetCategory($id)
{
    // Requête SQL qui récupère le nom de la catégorie correspondant à l'ID spécifié
    $sql = "SELECT `ID`, `NAME` FROM `CATEGORIES` WHERE `ID` = :id";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL pour récupérer le nom de la catégorie
        $statement->execute(array(":id" => $id));

        // Récupère la première ligne de résultat
        $row = $statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT);
        
        // Crée un objet Category à partir des données récupérées
        return new Category(
            intval($row['ID']),         // ID        : l'identifiant unique de la catégorie (entier)
            $row['NAME']                // NAME      : le nom de la catégorie (chaîne de caractères)
        );
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
}

/**
 * Modifie le nom d'une catégorie dans la table `CATEGORIES`
 * @param int $id L'ID de la catégorie à modifier
 * @param string $name Le nouveau nom de la catégorie
 * @return bool True si la mise à jour a été effectuée avec succès, False sinon
 */
function UpdateCategory($id, $name)
{
    // Requête SQL qui modifie le nom d'une catégorie
    $sql = "UPDATE `CATEGORIES` SET `NAME` = :n WHERE `ID` = :id";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL pour modifier le nom de la catégorie
        $statement->execute(array(':n' => $name, ':id' => $id));
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
 * Vérifie si une catégorie avec un nom donné existe dans la table `CATEGORIES`.
 *
 * @param string $name Le nom de la catégorie à rechercher.
 * @return bool True si la catégorie existe, False sinon.
 */
function CategoryExists($name)
{
    // Requête SQL pour vérifier si la catégorie existe
    $sql = "SELECT `ID` FROM `CATEGORIES` WHERE `NAME` = :n";
    
    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL avec le nom de la catégorie en paramètre
        $statement->execute(array(":n" => $name));

        // Retourne true si la catégorie existe (si la requête renvoie au moins une ligne), false sinon
        return boolval($statement->rowCount() > 0);
    }
    catch(PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
}

/**
 * Crée une nouvelle catégorie dans la table `CATEGORIES`
 * @param string $name Le nom de la nouvelle catégorie
 * @return bool True si la création a été effectuée avec succès, False sinon
 */
function AddCategory($name)
{
    // Requête SQL qui insère une nouvelle catégorie dans la table `CATEGORIES`
    $sql = "INSERT INTO `CATEGORIES` (`NAME`) VALUES (:n)";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL pour créer la nouvelle catégorie
        $statement->execute(array(':n' => $name));
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
    
    // Retourne true si la création a été effectuée avec succès
    return true;
}