let featured = document.getElementById("featured");

// Permet de valider les entrer dans le formulaire
function validateForm()
{
    // Saisie de l'utilisateur
    let name = document.getElementById("name");                 // Récupère le nom 
    let description = tinymce.get("description").getContent();   // Récupère la description
    let price = document.getElementById("price");               // Récupère le prix
    let image = document.getElementById("image");               // Récupère les images
    let category = document.getElementById("categories");       // Récupère la categorie
    let stock = document.getElementById("stock");               // Récupère la quantité en stock

    // Message d'erreur afficher dans une div
    let nameErrorMsg = document.getElementById("nameHelp"); 
    let descriptionErrorMsg = document.getElementById("descriptionHelp"); 
    let priceErrorMsg = document.getElementById("priceHelp");
    let imageErrorMsg = document.getElementById("imageHelp"); 
    let categoryErrorMsg = document.getElementById("categoryHelp"); 
    let stockErrorMsg = document.getElementById("stockHelp");
    let errorMsg = document.getElementById("errorMsg");

    toggleCheckboxValue(featured);

    // Vérification de la quantité en stock
    if (stock.value.length <= 0)
    {
        // Affiche un message d'erreur
        stockErrorMsg.innerText = "Veuillez saisir une quantité.";
        stock.focus();
    }
    else
    {
        // Efface le message d'erreur
        stockErrorMsg.innerText = "";
    }

    // Vérification de la categorie
    if (category.value === "0")
    {
        // Affiche un message d'erreur
        categoryErrorMsg.innerText = "Veuillez choisir une catégorie.";
        category.focus();
    }
    else
    {
        // Efface le message d'erreur
        categoryErrorMsg.innerText = "";
    }

    // Vérification des images
    if (image.files.length == 0)
    {
        // Affiche un message d'erreur
        imageErrorMsg.innerText = "Veuillez saisir une image.";
        image.focus();
    }
    else
    {
        // Efface le message d'erreur
        imageErrorMsg.innerText = "";
    }

    // Vérification du prix
    if (price.value.length <= 0)
    {
        // Affiche un message d'erreur
        priceErrorMsg.innerText = "Le prix doit être plus grand que 0.";
        price.focus();
    }
    else
    {
        // Efface le message d'erreur
        priceErrorMsg.innerText = "";
    }

    // Vérification de la description
    if (description.length < 10)
    {
        // Affiche un message d'erreur
        descriptionErrorMsg.innerText = "La description doit contenir au moins 10 caractères.";
        tinymce.get("description").focus(); // Définit le focus sur le champ de texte
    }
    else
    {
        // Efface le message d'erreur
        descriptionErrorMsg.innerText = "";
    }

    // Vérification du nom
    if (name.value.length < 10 || name.value.length > 200)
    {
        // Affiche un message d'erreur
        nameErrorMsg.innerText = "Le nom de l'article doit contenir entre 10 et 200 caractères.";
        name.focus();
    }
    else
    {
        // Efface le message d'erreur
        nameErrorMsg.innerText = "";
    }

    // Si les messages d'erreur sont vides on retourne true sinon false
    if (nameErrorMsg.innerText === "" && descriptionErrorMsg.innerText === "" && priceErrorMsg.innerHTML === "" && imageErrorMsg.innerText === "" && categoryErrorMsg.innerText === "" && stockErrorMsg.innerText === "")
    {
        // Renvoie vrai, la saisie est valide
        return true; 
    }
    else
    {
        // Efface le message d'erreur générer avec php
        errorMsg.innerHTML = "";

        // Renvoie faux, il y a des erreurs de saisie
        return false;
    }
}

// Regarde la valeur de la check box et change la valeur de featured
function toggleCheckboxValue(featured)
{
    if (featured.checked)
    {
        featured.value = "1";
    }   
    else
    {
        featured.value = "0";
    }
}