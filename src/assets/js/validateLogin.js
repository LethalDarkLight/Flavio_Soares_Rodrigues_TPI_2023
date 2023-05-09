/**
 * Fonction qui valide la saisie de l'utilisateur lors de la connexion
 * et affiche les messages d'erreur appropriés.
 * 
 * @return {boolean} True si la validation est réussie, False sinon.
 */
function validateLogin()
{
    // Saisie utilisateur
    let email = document.getElementById("email"); // Récupère l'élément input pour l'email
    let password = document.getElementById("password"); // Récupère l'élément input pour le mot de passe

    // Message d'erreur
    let emailErrorMsg = document.getElementById("emailHelp"); // Récupère l'élément div pour afficher le message d'erreur de l'email
    let passwordErrorMsg = document.getElementById("passwordHelp"); // Récupère l'élément div pour afficher le message d'erreur du mot de passe
    let errorMsg = document.getElementById("errorMsg");


    // Vérification du mot de passe
    if (password.value === "")
    {
        // Affiche un message d'erreur
        passwordErrorMsg.innerText = "Le mot de passe est requis.";

        // Met le focus sur l'input de l'email 
        password.focus();
    }
    else
    {
        // Efface le message d'erreur du mot de passe
        passwordErrorMsg.innerText = "";
    }

    // Vérification de l'email
    if (email.value === "")
    {
        // Affiche un message d'erreur
        emailErrorMsg.innerText = "L'email est requis.";

        // Met le focus sur l'input de l'email
        email.focus();
    }
    else if (!isValidEmail(email.value))
    {
        // Affiche un message d'erreur
        emailErrorMsg.innerText = "Veuillez saisir un email valide.";

        // Met le focus sur l'input de l'email
        email.focus(); 
    }
    else
    {
        // Efface le message d'erreur de l'email
        emailErrorMsg.innerText = "";
    }

    // Si les messages d'erreur sont vides on retourne true sinon false
    if (emailErrorMsg.innerText === "" && passwordErrorMsg.innerText === "")
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