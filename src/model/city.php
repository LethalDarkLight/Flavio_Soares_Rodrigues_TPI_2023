<?php
require_once ROOT.'db/database.php';
require_once ROOT.'containers/City.php';

/**
 * Récupère la liste des villes sous forme d'objet City
 * @return array|false Le tableau d'objets City représentant les villes, ou false en cas d'erreur
 */
function GetCities()
{
    // Initialise le tableau de villes
    $arrayCity = array();

    // Requête SQL qui récupère les données des villes
    $sql = "SELECT `ID`, `NAME` FROM `CITIES`";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL pour récupérer les villes
        $statement->execute();

        // Parcourt tous les résultats de la requête pour créer un tableau d'objets City
        while ($row = $statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
        {
            // Crée un objet City à partir des données récupérées
            $city = new City(
                intval($row['ID']),         // ID        : l'identifiant unique de la ville (entier)
                $row['NAME']                // NAME      : le nom de la ville (chaîne de caractères)
            );

            // Ajoute l'objet City créé au tableau de villes
            array_push($arrayCity, $city);
        }
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
    
    // Retourne le tableau d'objets City représentant les villes
    return $arrayCity;
}

/**
 * Récupère une ville à partir de son identifiant unique
 * dans la base de données et retourne un objet City correspondant.
 *
 * @param int $id L'identifiant unique de la ville à récupérer (entier)
 *
 * @return City|false Un objet City correspondant à la ville demandée ou false si une erreur est survenue.
 */
function GetCity($id)
{
    // Requête SQL qui sélectionne une ville en fonction de son ID
    $sql = "SELECT `ID`, `NAME` FROM `CITIES` WHERE `ID` = :id";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL en passant l'ID en paramètre
        $statement->execute(array(":id" => $id));

        // Récupère la première ligne de résultat
        $row = $statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT);
        
        // Crée un objet City avec les données récupérées
        return new City(
            intval($row['ID']),         // ID        : l'identifiant unique de la ville (entier)
            $row['NAME']                // NAME      : le nom de la ville (chaîne de caractères)
        );
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
}