// Met les lettres en majuscule
function toUpperCase()
{
    let name = document.getElementById("name");

    // Converti en majuscule
    name.value = name.value.toUpperCase();
}

// Permet de valider les entrer dans le formulaire
function validateForm()
{
    let name = document.getElementById("name");
    let categories = document.getElementById("categories");

    let nameErrorMsg = document.getElementById("nameHelp");
    let categoriesErrorMsg = document.getElementById("categoriesHelp");
    let errorMsg = document.getElementById("errorMsg");

    // Si le champ est vide on affiche un message d'erreur 
    if (name.value === "")
    {
        // Affiche un message d'erreur 
        nameErrorMsg.innerText = "Veuillez mettre un nouveau nom";
        name.focus();
    }
    else
    {
        // Efface le message d'erreur
        nameErrorMsg.innerText = "";
    }

    // Si le champ est vide on affiche un message d'erreur 
    if (categories.value === "0")
    {
        // Affiche un message d'erreur 
        categoriesErrorMsg.innerText = "Veuillez saisir une catégorie à modifier";
        categories.focus();
    }
    else
    {
        // Efface le message d'erreur
        categoriesErrorMsg.innerText = "";
    }

    // Si les messages d'erreur sont vides on retourne true sinon false
    if (nameErrorMsg.innerText === "" && categoriesErrorMsg.innerText === "")
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