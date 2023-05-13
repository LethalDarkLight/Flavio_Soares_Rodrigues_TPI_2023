<?php
require_once ROOT.'db/database.php';
require_once ROOT.'containers/User.php';
require_once ROOT.'session/SessionManager.php';

/**
 * Insère un nouvel utilisateur dans la table USERS de la base de données.
 * @param string $name Nom de l'utilisateur.
 * @param string $surname Prénom de l'utilisateur.
 * @param string $email Adresse e-mail de l'utilisateur.
 * @param string $password Mot de passe de l'utilisateur.
 * @param string $gender Genre de l'utilisateur.
 * @param string $adress1 Adresse de l'utilisateur (ligne 1).
 * @param string $adress2 Adresse de l'utilisateur (ligne 2).
 * @param int $city ID de la ville de l'utilisateur.
 * @param string $zipCode Code postal de l'utilisateur.
 * @return bool Retourne TRUE si l'inscription réussit, sinon FALSE.
*/
function RegisterUser($name, $surname, $email, $password, $gender, $address1, $address2, $city, $zipCode)
{
    // Insère un nouvel utilisateur dans la table "USERS" de la base de données
    $sql = "INSERT INTO `USERS` (`NAME`, `SURNAME`, `EMAIL`, `PASSWORD`, `GENDER`, `ADDRESS1`, `ADDRESS2`, `CITIES_ID`, `ZIP_CODE`)
    VALUES(:name, :surname, :email, :pw, :gender, :address1, :address2, :cityID, :zipCode)";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Crée un tableau des valeurs à exécuter
        $params = array(
            ":name" => $name,
            ":surname" => $surname,
            ":email" => $email,
            ":pw" => $password,
            ":gender" => $gender,
            ":address1" => $address1,
            ":cityID" => $city,
            ":zipCode" => $zipCode
        );

        // Vérifie si $address2 est vide
        if (!empty($address2))
        {
            $params[":address2"] = $address2;
        }
        else
        {
            // Si $address2 est vide, assigne une valeur nulle à :address2 dans le tableau des valeurs
            $params[":address2"] = null;
        }

        // Exécute la requête en utilisant les valeurs passées en paramètre
        $statement->execute($params);
    }
    catch (PDOException $e)
    {
        // Retourne false en cas d'erreur
        return false;
    }
    // Retourne true si tout s'est bien passé
    return true;
}

/**
 * Récupère un utilisateur grâce à son email donné en paramètre
 * @param string $email L'email de l'utilisateur à récupérer
 * @return mixed L'utilisateur récupéré sous forme d'objet User, ou false si une erreur est survenue
 */
function GetUser($email)
{
    // Requête SQL qui récupère les données de l'utilisateur
    $sql = "SELECT `USERS`.`ID`, `USERS`.`NAME`, `SURNAME`, `EMAIL`, `PASSWORD`, `GENDER`, `ADDRESS1`, `ADDRESS2`, CITIES.NAME as CITY, `ZIP_CODE`, `IS_ADMIN`
    FROM `USERS`
    INNER JOIN CITIES ON USERS.CITIES_ID = CITIES.ID
    WHERE EMAIL = :email";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL en utilisant l'email passé en paramètre
        $statement->execute(array(":email" => $email));

        // Récupère la première ligne de résultat
        $row = $statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT);

        // Créer un objet User à partir des données récupérées
        return new User(
            intval($row['ID']),         // ID        : l'identifiant unique de l'utilisateur (entier)
            $row['NAME'],               // NAME      : le nom de l'utilisateur (chaîne de caractères)
            $row['SURNAME'],            // SURNAME   : le prénom de l'utilisateur (chaîne de caractères)
            $row['EMAIL'],              // EMAIL     : l'adresse email de l'utilisateur (chaîne de caractères)
            $row['PASSWORD'],           // PASSWORD  : le mot de passe haché de l'utilisateur (chaîne de caractères)
            intval($row['GENDER']),     // GENDER    : le genre de l'utilisateur (entier)
            $row['ADDRESS1'],           // ADDRESS1  : la première adresse de l'utilisateur (chaîne de caractères)
            $row['ADDRESS2'],           // ADDRESS2  : la deuxième adresse de l'utilisateur (optionnel) (chaîne de caractères)
            $row['CITY'],               // CITY      : le nom de la ville où habite l'utilisateur (chaîne de caractères)
            intval($row['ZIP_CODE']),   // ZIP_CODE  : le code postal de l'utilisateur (entier)
            boolval($row['IS_ADMIN'])   // IS_ADMIN  : un booléen qui indique si l'utilisateur est un administrateur ou non (booléen)
        );
    }
    catch (PDOException $e)
    {
        // En cas d'erreur, retourne false
        return false;
    }
}

/**
 * Vérifie si un email est déjà présent dans la base de données.
 *
 * @param string $email L'adresse email à rechercher.
 * @return bool True si l'email existe, False sinon.
 */
function EmailExists($email)
{
    // Requête SQL pour récupérer l'email dans la table USERS
    $sql = "SELECT `EMAIL` FROM USERS WHERE `EMAIL` = :email";
    
    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL avec l'email en paramètre
        $statement->execute(array(":email" => $email));
        
        // Vérifie le nombre de lignes de résultats pour déterminer si l'email existe
        return boolval($statement->rowCount() > 0);
    }
    catch(PDOException $e)
    {
        // En cas d'erreur, retourne False
        return false;
    }
}

/**
 * Vérifie les informations de connexion d'un utilisateur.
 * Si les informations sont valides, enregistre l'utilisateur dans une session.
 *
 * @param string $email L'adresse email de l'utilisateur.
 * @param string $password Le mot de passe de l'utilisateur.
 * @return string Un message d'erreur ou une chaîne vide si l'authentification a réussi.
 */
function LoginUser($email, $password)
{
    // Vérifie que l'email existe dans la base de données
    if (EmailExists($email))
    {
        // Récupère l'utilisateur correspondant à l'email
        $user = GetUser($email);

        // Vérifie que le mot de passe est correct en utilisant la fonction password_verify() de PHP
        if (password_verify($password, $user->password))
        {
            // Créer une session avec l'utilisateur
            ESessionManager::SetUser($user->id, $user->isAdmin);

            // Retourne true si tout c'est bien passé
            return true;
        }
        else
        {
            // Retourne false si il y a une erreur
            return false;
        }
    }
    else
    {
        // Retourne false si il y a une erreur
        return false;
    }
}