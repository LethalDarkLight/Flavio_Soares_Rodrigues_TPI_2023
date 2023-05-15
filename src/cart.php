<?php

// This page requires to be authenticated
$REQUIREDLOGIN = true;

require_once './includes/checkAll.php';

/**
 * Affiche les articles du panier avec leurs informations.
 * @return string Le code HTML contenant les éléments du panier.
*/


/*if (isset($_POST['deleteCartItem']) && $_POST['deleteCartItem'] === $article->id)
{
    DeleteCartItem($articleId);
}*/


// Récupère les articles du panier pour l'utilisateur connecté
$cartItems = GetCartItems(ESessionManager::GetConnectedUserId());


function ShowCartItems($cartItems)
{
    // Variables pour le calcul du prix total et de la quantité totale
    $totalPrice = 0;
    $totalQuantity = 0;

    $result = "";

    // Parcourt chaque élément du panier
    foreach ($cartItems as $cartItem) 
    {
        // Récupère les informations de l'article
        $article = GetArticleById($cartItem->articlesId);

        // Récupère l'image principale de l'article
        $mainImage = GetMainImage($cartItem->articlesId);

        $formatedPrice = number_format($article->price, 2, '.', " ");

        // Calcul du prix total pour cet article
        $totalPriceForOneArticle = $article->price * $cartItem->quantity;

        // Formatage du prix avec 2 décimales et un séparateur de milliers
        $formattedPriceForOneArticle = number_format($totalPriceForOneArticle, 2, '.', " ").' CHF';

        // Mise à jour du prix total et de la quantité totale
        $totalPrice += $totalPriceForOneArticle;
        $totalQuantity += $cartItem->quantity;


        // Construction du code HTML pour l'article du panier
        $result .= "
        <div class='mx-1 d-flex flex-row align-items-end justify-content-center p-3 w-100'
            id='article$cartItem->articlesId'
            data-price='$article->price'>
            <img class='rounded mx-auto d-block w-25' src='$mainImage->content' alt='$mainImage->name'>
            <div class='w-50 mx-auto text-center'>
                <p class='fs-4 text-center'><strong>$article->name</strong></p>
                <p class='fs-5 text-center my-3'><strong>$formatedPrice</strong> <span>CHF</span></p>
                <input type='number' class='form-control my-3 text-center mx-auto' style='width:100px' id='articleQuantity$cartItem->articlesId' data-Id='$cartItem->articlesId' name='quantity' min='0' step='1' value='$cartItem->quantity'>
            </div>
            <div class='d-flex flex-row flex-wrap text-center mx-auto w-25'>
                <p class='fs-5 text-center w-100'>Total : <span id='articleTotal$cartItem->articlesId'>$formattedPriceForOneArticle</span></p>
                <button name='deleteCartItem' type='submit' class='btn btn-danger mb-3 w-100' value='$article->id'>Supprimer</button>
            </div>
        </div>
        <div class='border border-2 rounded w-100 my-2'></div>";
    }

    // Formatage du prix avec 2 décimales et un séparateur de milliers
    $formattedTotalPrice = number_format($totalPrice, 2, '.', " ").' CHF';
    // Construction du code HTML pour le total du panier
    $result .="
    <div class='d-flex flex-column justify-content-center w-100'>
        <p class='fs-5 text-center'>Total <strong>".count($cartItems)." article(s)</strong> : <span id='totalPrice' data-totalPrice='$totalPrice'>$formattedTotalPrice</span></p>
        <button name='order' type='submit' class='btn btn-primary submitBtn mb-5 w-50 mx-auto' value='order'>Commander</button>
        <button name='order' type='submit' class='btn btn-primary submitBtn mb-5 w-50 mx-auto' id='save'>Sauvegarder</button>
    </div>";
    
    // Retourne le code HTML contenant les éléments du panier
    return $result;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <!-- Fontawesome -->
    <link href="assets/libraries/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="assets/libraries/fontawesome/css/brands.css" rel="stylesheet">
    <link href="assets/libraries/fontawesome/css/solid.css" rel="stylesheet">
    <link href="assets/libraries/fontawesome/css/regular.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/libraries/bootstrap/bootstrap.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?=ShowNavbar()?>
    <main class="mt-5 mx-auto">
        <h2>Mon panier</h2>
        <div class="d-flex flex-wrap justify-content-center mx-auto">
            <?=ShowCartItems($cartItems)?>
        </div>
    <script src="./assets/libraries/bootstrap/bootstrap.js"></script>
</body>
<script>
    var id = <?php echo ESessionManager::GetConnectedUserId();?>;
    var articles = [];
<?php
    foreach ($cartItems as $cartItem) 
    {
?>        

        article = {
        "id": <?php echo $cartItem->articlesId;?>, // id de l'article
        "quantity": <?php echo $cartItem->quantity;?>, // quantité de l'article
        };
        articles.push(article);
<?php
    }
?>

<?php
    foreach ($cartItems as $cartItem) 
    {
?>        

        // Écouteur d'événement pour la modification de la quantité d'un article 
        element = document.querySelector("#articleQuantity<?php echo $cartItem->articlesId;?>");
        element.addEventListener("change", (event) => {

        let previousQuantity = parseInt(event.target.attributes.value.value); 
        // Récupère l'élément de quantité
        let quantity = parseInt(event.target.value); // Convertit la valeur de quantité en entier
        let articleId = parseInt(event.target.getAttribute("data-Id"));
        articles.forEach( (item) => {
            if (item.id == articleId)
                item.quantity = quantity;
        });

        // Récupère l'élément d'article pour obtenir le prix
        let el = document.querySelector("#article<?php echo $cartItem->articlesId;?>");
        let price = parseFloat(el.getAttribute("data-price")); // Récupère le prix converti en nombre à virgule flottante
        
        // Calcule le total précédent avant changement de la quantité
        let previousTotal = previousQuantity * price;
        // Calcule le total en multipliant la quantité par le prix
        let total = quantity * price;

        let deltaTotal = total - previousTotal;

        // Récupère l'élément d'affichage du total et met à jour sa valeur formatée
        el = document.querySelector("#articleTotal<?php echo $cartItem->articlesId;?>");
        let tot = new Intl.NumberFormat('fr-CH', { style: 'currency', currency: 'CHF' }).format(total);
        el.innerHTML = tot; // Met à jour le contenu HTML de l'élément avec le total formaté

        // Mettre la nouvelle quantité
        event.target.attributes.value.value = quantity;

        // Mettre à jour le total
        el = document.getElementById('totalPrice');
        let currentTotal = parseFloat(el.getAttribute("data-totalPrice"));
        let newTotal = currentTotal + deltaTotal;
        tot = new Intl.NumberFormat('fr-CH', { style: 'currency', currency: 'CHF' }).format(newTotal);
        el.innerHTML = tot; // Met à jour le contenu HTML de l'élément avec le total formaté
        // Garder le nouveau total
        el.setAttribute("data-totalPrice", newTotal);


    });
<?php
    }
?>
// Event pour éviter de fermer la page ou changer
window.addEventListener('beforeunload', (event) => {
  event.returnValue = `Etes-vous sûr de vouloir quitter?`;
});

document.querySelector("#save").addEventListener("click", (event) => {
    saveCart(id, articles);
});





/**
 * Exécuter la requête ajax pour sauvegarder le panier de l'utilisateur
 *
 * @param int id        L'id de d'utilisateur
 * @param array cart    Le tableau des articles du panier
 */
function saveCart(id, cart)
{
    let jsonObj = {};

    jsonObj.id = id;
    jsonObj.cart = cart;

    //let searchParams = new URLSearchParams(jsonObj);

    fetch('./tools/saveCart.php', {
        method: 'POST',
        headers: {
            //'Content-Type': 'application/x-www-form-urlencoded'
            'Content-Type': 'application/json; charset=utf-8'
        },
        //body: searchParams.toString()
        body: JSON.stringify(jsonObj)
    })

    .then(function (response){
        return response.json();
    })
    .then(function (data) {
        switch (data.ReturnCode)
        {
            case 0: // C'est tout bon
                //window.location = "./index.php";
                break;

            case 1: // Les champs ne sont pas tous remplie
                //document.getElementById("errorMsg").style.display = "block";
                //document.getElementById("errorMsg").innerHTML = data.Message;
                break;
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
</script>
</html>