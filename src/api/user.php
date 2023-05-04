<?php
require_once '../db/database.php';
require_once '../containers/User.php';

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
function RegisterUser($name, $surname, $email, $password, $gender, $adress1, $adress2, $city, $zipCode)
{
    // Insère un nouvel utilisateur dans la table "USERS" de la base de données
    $sql = "INSERT INTO `USERS` (`NAME`, `SURNAME`, `EMAIL`, `PASSWORD`, `GENDER`, `ADDRESS1`, `ADDRESS2`, `CITIES_ID`, `ZIP_CODE`)
    VALUES(:userName, :surname, :email, :pw, :gender, :adress1, :adress2, :cityID, :zipCode)";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête en utilisant les valeurs passé en paramètre
        $statement->execute(array(":userName" => $name, ":surname" => $surname, ":email" => $email, ":pw" => $password,
        ":gender" => $gender, ":adress1" => $adress1, ":adress2" => $adress2, ":cityID" => $city, ":zipCode" => $zipCode));
    }
    catch (PDOException $e)
    {
        // retourne false si il y a une erreur
        return false;
    }
    // retourne true si tout c'est bien passé
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
            $row['GENDER'],             // GENDER    : le genre de l'utilisateur (chaîne de caractères)
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
 * @param string email L'adresse email à rechercher.
 * @return bool True si l'email existe, False sinon.
 */
function EmailExists($email)
{
    $query = "SELECT `EMAIL` FROM USERS WHERE `EMAIL` = :email";
    $statement = EDatabase::prepare($query);

    try
    {
        $statement->execute(array(":email" => $email));
        return boolval($statement->rowCount() > 0); // retourne true si l'adresse existe sinon false
    }
    catch(PDOException $e)
    {
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
            // Si le mot de passe est correct, enregistre l'utilisateur dans une session
            $_SESSION['idUser'] = $user->id;
            $_SESSION['admin'] = $user->isAdmin;
            $_SESSION['connected'] = true;

            return ""; // Retourne une chaîne vide en cas de succès
        }
        else
        {
            return "L'email ou le mot de passe est incorrect."; // Retourne un message d'erreur si le mot de passe est incorrect
        }
    }
    else
    {
        return "L'email ou le mot de passe est incorrect."; // Retourne un message d'erreur si l'email n'existe pas dans la base de données
    }
}