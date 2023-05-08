<?php
require_once '../db/database.php';
require_once '../containers/Image.php';

/**
 * Insère une image encodée en base64 dans la base de données.
 *
 * @param string $content Contenu de l'image encodé en base64.
 * @param string $fileType Type de fichier de l'image.
 * @param string $fileName Nom de fichier de l'image.
 *
 * @return bool Retourne true si l'insertion a réussi, false sinon.
 */
function AddEnc64Image($content, $fileName, $fileType, $mainImage, $articlesId)
{
    // Encodage de l'image en base64
    $encoded64Content = 'data:'.$fileType.';base64, '.base64_encode($content);

    // Requête SQL pour insérer une image dans la base de données
    $sql = "INSERT INTO `IMAGES` (`CONTENT`, `NAME`, `TYPE`, `MAIN_IMAGE`, `ARTICLES_ID`) VALUES(:encoded64Content, :fName, :fType, :mainImage, :articlesId)";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Execute la requête SQL avec les paramètres nécessaire
        $statement->execute(array(
        ":encoded64Content" => $encoded64Content,
        ":fName" => $fileName,
        ":fType" => $fileType,
        ":mainImage" => $mainImage,
        ":articlesId" => $articlesId));
    }
    // En cas d'erreur, retourne false
    catch (PDOException $e)
    {
        return false;
    }
    // Retourne true si tout s'est bien passé
    return true;
}

/**
 * Récupère toutes les images associées à un article donné.
 * @param int $articlesId L'identifiant de l'article
 * @return array|bool Un tableau d'objets Image représentant les images associées à l'article, ou false en cas d'erreur
 */
function GetImages($articlesId)
{
    // Initialise le tableau d'images
    $arrayImage = array();

    // Requête SQL qui récupère les images d'un article
    $sql = "SELECT `ID`, `CONTENT`, `NAME`, `TYPE`, `MAIN_IMAGE`, `ARTICLES_ID` FROM `IMAGES`
    WHERE `ARTICLES_ID` = :articlesId";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête SQL en utilisant l'email passé en paramètre
        $statement->execute(array(":articlesId" => $articlesId));

        // Parcourt tous les résultats de la requête pour créer un tableau d'objets Image
        while ($row = $statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
        {
            // Crée un objet Image à partir des données de la ligne courante
            $img = new Image(
                intval($row['ID']),             // ID           : Identifiant de l'image (entier)
                $row['CONTENT'],                // CONTENT      : Contenu de l'image encodé en base64 (chaîne de caractères)
                $row['NAME'],                   // NAME         : Nom de l'image (chaîne de caractères)
                $row['TYPE'],                   // TYPE         : Type MIME de l'image (chaîne de caractères)
                boolval($row['MAIN_IMAGE']),    // MAIN_IMAGE   : Indique si l'image est la principale pour l'article associé (booléen)
                intval($row['ARTICLES_ID'])     // ARTICLES_ID  : Identifiant de l'article associé (entier)
            );

            // Ajoute l'objet Image créé au tableau d'images
            array_push($arrayImage, $img);
        }
    }
    catch(PDOException $e)
    {
		return false;
    }
    // retourne le tableau d'images
    return $arrayImage;
}

/**
 * Récupère l'image principale de l'article (l'image qui est mise en avant)
 * @param int $articlesId L'identifiant de l'article
 * @return Image|bool une Image représentant l' image principale associée à l'article, ou false en cas d'erreur
 */
function GetMainImage($articlesId)
{
    // Requête SQL qui récupère l' image principale d'un article
    $sql = "SELECT `ID`, `CONTENT`, `NAME`, `TYPE`, `MAIN_IMAGE`, `ARTICLES_ID` FROM `IMAGES`
    WHERE `ARTICLES_ID` = :articlesId
    AND `MAIN_IMAGE` = 1";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        $statement->execute(array(":articlesId" => $articlesId));

        // Récupère la première ligne de résultat
        $row = $statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT);

        // Créer un objet Image à partir des données récupérees
        return new Image(
            intval($row['ID']),             // ID           : Identifiant de l'image (entier)
            $row['CONTENT'],                // CONTENT      : Contenu de l'image encodé en base64 (chaîne de caractères)
            $row['NAME'],                   // NAME         : Nom de l'image (chaîne de caractères)
            $row['TYPE'],                   // TYPE         : Type MIME de l'image (chaîne de caractères)
            boolval($row['MAIN_IMAGE']),    // MAIN_IMAGE   : Indique si l'image est la principale pour l'article associé (booléen)
            intval($row['ARTICLES_ID'])     // ARTICLES_ID  : Identifiant de l'article associé (entier)
        );
    }
    catch(PDOException $e)
    {
		return false;
    }
}

/**
 * Supprime une image de la base de données.
 *
 * @param int $imageId L'identifiant de l'image à supprimer
 * @return bool true si la suppression a réussi, false sinon
 */
function DeleteImage($imageId)
{
    // Requête SQL qui supprime une image en fonction de son ID
    $sql = "DELETE FROM `IMAGES` WHERE `ID` = :imageId";

    // Prépare la requête SQL
    $statement = EDatabase::prepare($sql);

    try
    {
        // Exécute la requête en passant l'ID de l'image en paramètre
        $statement->execute(array(":imageId" => $imageId));

        // Retourne true pour indiquer que la suppression a réussi
        return true;
    }
    catch(PDOException $e)
    {
        // Retourne false pour indiquer que la suppression a échoué
        return false;
    }
}