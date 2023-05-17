<?php

// This page requires to be authenticated
$REQUIREDLOGIN = true;

require_once './includes/checkAll.php';

// Récupère l'id de l'utilisateur connecté
$userId = ESessionManager::GetConnectedUserId();

// Récupère les articles du panier pour l'utilisateur connecté
$cartItems = GetCartItems($userId);

/**
 * Affiche les articles du panier avec leurs informations.
 * @return string Le code HTML contenant les éléments du panier.
*/
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
                <p class='fs-5 text-center my-3'>$formatedPrice <span>CHF</span></p>
                <input type='number' class='form-control my-3 text-center mx-auto' style='width:100px' id='articleQuantity$cartItem->articlesId' data-Id='$cartItem->articlesId' name='quantity' min='1' max='$article->stock' step='1' value='$cartItem->quantity'>
            </div>
            <div class='d-flex flex-row flex-wrap text-center mx-auto w-25'>
                <p class='fs-5 text-center w-100'>Total : <strong><span id='articleTotal$cartItem->articlesId'>$formattedPriceForOneArticle</span></strong></p>
                <form method='post' class='text-center w-100'>
                    <button name='deleteCartItem' type='submit' class='btn btn-danger mb-3 w-100' value='$cartItem->articlesId'><i class='fa-solid fa-trash fa-lg'></i> Supprimer</button>
                </form>
            </div>
        </div>
        <div class='border border-2 rounded w-100 my-2'></div>";

        // Enlève l'objet du panier si on clique sur le bouton supprimer
        if (isset($_POST['deleteCartItem']) && intval($_POST['deleteCartItem']) == $cartItem->articlesId)
        {
            DeleteCartItem(ESessionManager::GetConnectedUserId(), $cartItem->articlesId);
        }
    }

    // Formatage du prix avec 2 décimales et un séparateur de milliers
    $formattedTotalPrice = number_format($totalPrice, 2, '.', " ").' CHF';
    // Construction du code HTML pour le total du panier
    if($cartItems != null)
    {
        $result.= "
        <div class='d-flex flex-column justify-content-center w-100'>
            <p class='fs-5 text-center'>Total <strong>".count($cartItems)." </strong>article(s) : <strong><span id='totalPrice' data-totalPrice='$totalPrice'>$formattedTotalPrice</span></strong></p>
            <form method='get' action='validateOrder.php' class='text-center w-100'>
                <button name='order' id='order' type='submit' class='btn btn-primary submitBtn mb-3 my-2 w-50 mx-auto' value='order'><i class='fa-solid fa-lg fa-truck'></i> Commander</button>
            </form>
            <button name='save' type='submit' class='btn btn-success submitBtn mb-5 w-50 mx-auto' id='save'><i class='fa-solid fa-lg fa-floppy-disk'></i> Sauvegarder</button>
        </div>";
    }
    else
    {
        $result .="<div class='fs-5 alert alert-danger mt-4 w-100 text-center' role='alert'>Votre panier est vide</div>";
    }
    
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
    // Parcourir les articles du panier
    foreach ($cartItems as $cartItem) 
    {
?>        
        // Sélectionne l'élément de quantité de l'article
        element = document.querySelector("#articleQuantity<?php echo $cartItem->articlesId;?>");
        element.addEventListener("change", (event) => {

            // Obtient la quantité précédente de l'article
            let previousQuantity = parseInt(event.target.attributes.value.value); 
            
            // Obtient la nouvelle quantité de l'article
            let quantity = parseInt(event.target.value); 
            
            // Obtient l'ID de l'article
            let articleId = parseInt(event.target.getAttribute("data-Id"));
            
            // Parcourt les articles et met à jour la quantité correspondante
            articles.forEach((item) => {
                if (item.id == articleId)
                    item.quantity = quantity;
            });

            // Récupère l'élément d'article pour obtenir le prix
            let el = document.querySelector("#article<?php echo $cartItem->articlesId;?>");
            let price = parseFloat(el.getAttribute("data-price"));
            
            // Calcule le total précédent avant le changement de quantité
            let previousTotal = previousQuantity * price;
            
            // Calcule le nouveau total en multipliant la quantité par le prix
            let total = quantity * price;

            // Calcule la variation de total
            let deltaTotal = total - previousTotal;

            // Récupère l'élément d'affichage du total et met à jour sa valeur formatée
            el = document.querySelector("#articleTotal<?php echo $cartItem->articlesId;?>");
            let tot = new Intl.NumberFormat('fr-CH', { style: 'currency', currency: 'CHF' }).format(total);
            el.innerHTML = tot; // Met à jour le contenu HTML de l'élément avec le total formaté

            // Met à jour la valeur de l'attribut "value" avec la nouvelle quantité
            event.target.attributes.value.value = quantity;

            // Récupère l'élément du total global
            el = document.getElementById('totalPrice');
            let currentTotal = parseFloat(el.getAttribute("data-totalPrice"));
            
            // Calcule le nouveau total global en ajoutant la variation de total
            let newTotal = currentTotal + deltaTotal;
            
            // Met à jour l'affichage du nouveau total formaté
            tot = new Intl.NumberFormat('fr-CH', { style: 'currency', currency: 'CHF' }).format(newTotal);
            el.innerHTML = tot; // Met à jour le contenu HTML de l'élément avec le total formaté
            
            // Met à jour l'attribut "data-totalPrice" avec le nouveau total global
            el.setAttribute("data-totalPrice", newTotal);
        });
<?php
    }
?>

// Event pour éviter de fermer la page ou changer
window.addEventListener('beforeunload', (event) => {
    event.returnValue = 'Les modifications que vous avez apportées ne seront peut-être pas enregistrées.';
});

// Sauvegarde la quantité si le bouton sauvegarder est clicker
document.querySelector("#save").addEventListener("click", (event) => {
    saveCart(id, articles);
});

// Sauvegarde la quantité si le bouton commander est clicker
document.querySelector("#order").addEventListener("click", (event) => {
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

    fetch('./tools/saveCart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json; charset=utf-8'
        },
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