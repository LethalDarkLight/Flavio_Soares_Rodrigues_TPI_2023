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
    let nameErrorMsg = document.getElementById("nameHelp");
    let errorMsg = document.getElementById("errorMsg");

    // Si le champ est vide on affiche un message d'erreur 
    if (name.value === "")
    {
        // Affiche un message d'erreur 
        nameErrorMsg.innerText = "Le nom est requis.";
        name.focus();
    }
    else
    {
        // Efface le message d'erreur
        nameErrorMsg.innerText = "";
    }

    // Si les messages d'erreur sont vides on retourne true sinon false
    if (nameErrorMsg.innerText === "")
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