/**
 * Fonction qui valide la saisie de l'utilisateur lors de la connexion
 * et affiche les messages d'erreur appropriés.
 * 
 * @return {boolean} True si la validation est réussie, False sinon.
 */
function validateLogin()
{
    // Saisie utilisateur
    let emailInput = document.getElementById("email"); // Récupère l'élément input pour l'email
    let passwordInput = document.getElementById("password"); // Récupère l'élément input pour le mot de passe

    // Message d'erreur
    let emailErrorMsg = document.getElementById("emailHelp"); // Récupère l'élément div pour afficher le message d'erreur de l'email
    let passwordErrorMsg = document.getElementById("passwordHelp"); // Récupère l'élément div pour afficher le message d'erreur du mot de passe
    let errorMsg = document.getElementById("errorMsg");

    // Vérification de l'email
    if (emailInput.value === "")
    {
        // Affiche un message d'erreur
        emailErrorMsg.innerText = "L'email est requis.";

        // Met le focus sur l'input de l'email
        emailInput.focus();
    }
    else if (!isValidEmail(emailInput.value))
    {
        // Affiche un message d'erreur
        emailErrorMsg.innerText = "Veuillez saisir un email valide.";

        // Met le focus sur l'input de l'email
        emailInput.focus(); 
    }
    else
    {
        // Efface le message d'erreur de l'email
        emailErrorMsg.innerText = "";
    }

    // Vérification du mot de passe
    if (passwordInput.value === "")
    {
        // Affiche un message d'erreur
        passwordErrorMsg.innerText = "Le mot de passe est requis.";

        // Met le focus sur l'input de l'email 
        passwordInput.focus();
    }
    else
    {
        // Efface le message d'erreur du mot de passe
        passwordErrorMsg.innerText = "";
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

/**
 * Vérifie si l'adresse email est valide en utilisant une expression régulière.
 *
 * @param {string} email - L'adresse email à vérifier.
 * @returns {boolean} - true si l'adresse email est valide, false sinon.
 */
function isValidEmail(email)
{
    // Expression régulière pour vérifier le format de l'email
    let emailRegex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    // Renvoie vrai si le format est valide, faux sinon
    return emailRegex.test(email);
}

function checkCondition() {
    // envoyer une requête Ajax pour vérifier si la condition est vraie
    $.ajax({
      type: "POST",
      url: "http://localhost/Flavio_Soares_Rodrigues_TPI_2023/src/login.php",
      data: { parametre1: valeur1, parametre2: valeur2 },
      dataType: "json",
      success: function(response) {
        if (response.error) {
          // Si une erreur est renvoyée, afficher le message d'erreur dans une boîte de dialogue ou un autre élément de la page
          alert(response.message);
        } else {
          // Si la condition est vraie, faire quelque chose d'autre
        }
      }
    });
  }