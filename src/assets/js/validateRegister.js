/**
 * Fonction qui valide la saisie de l'utilisateur lors de l'inscription
 * et affiche les messages d'erreur appropriés.
 * 
 * @return {boolean} True si la validation est réussie, False sinon.
 */
function validateRegister()
{
    // Saisie de l'utilisateur
    let name = document.getElementById("name");         // Récupère le nom
    let surname = document.getElementById("surname");   // Récupère le prénom
    let gender = document.getElementById("gender");     // Récupère le genre
    let address = document.getElementById("address1");  // Récupère l'adresse 1
    let city = document.getElementById("cities");         // Récupère la ville
    let zipCode = document.getElementById("zipCode");   // Récupère le code postal
    let email = document.getElementById("email");       // Récupère l'email
    let password = document.getElementById("password"); // Récupère le mot de passe

    // Message d'erreur afficher dans une div
    let nameErrorMsg = document.getElementById("nameHelp"); 
    let surnameErrorMsg = document.getElementById("surnameHelp"); 
    let genderErrorMsg = document.getElementById("genderHelp");
    let addressErrorMsg = document.getElementById("address1Help"); 
    let cityErrorMsg = document.getElementById("citiesHelp"); 
    let zipCodeErrorMsg = document.getElementById("zipCodeHelp");
    let emailErrorMsg = document.getElementById("emailHelp"); 
    let passwordErrorMsg = document.getElementById("passwordHelp"); 
    let errorMsg = document.getElementById("errorMsg"); 


    // Vérification du mot de passe
    if (password.value === "")
    {
        // Affiche un message d'erreur
        passwordErrorMsg.innerText = "Le mot de passe est requis.";

        // Met le focus sur l'input de l'email 
        password.focus();
    }
    if (!validatePassword(password))
    {
        // Affiche un message d'erreur
        passwordErrorMsg.innerText = "Le mot de passe doit contenir au minumum une majuscule, une minuscule et un chiffre";

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



    // Vérification du code postal
    if (zipCode.value === "")
    {
        // Affiche un message d'erreur
        zipCodeErrorMsg.innerText = "Le genre doit être selectionné";
        zipCode.focus();
    }
    else if (!/^\d{4}$/.test(zipCode.value))
    {
        // Affiche un message d'erreur
        zipCodeErrorMsg.innerText = "Le code postal doit être composé de 4 chiffres uniquement";
        zipCode.focus();
    }
    else
    {
        // Efface le message d'erreur
        zipCodeErrorMsg.innerText = "";
    }



    // Vérification de la ville
    if (city.value === "0")
    {
        // Affiche un message d'erreur
        cityErrorMsg.innerText = "La ville doit être selectionné";
        city.focus();
    }
    else
    {
        // Efface le message d'erreur
        cityErrorMsg.innerText = "";
    }



    // Vérification de l'adresse
    if (address.value === "")
    {
        // Affiche un message d'erreur
        addressErrorMsg.innerText = "L'adresse est requise";
        address.focus();
    }
    else
    {
        // Efface le message d'erreur
        addressErrorMsg.innerText = "";
    }



    // Vérification du genre
    if (gender.value === "0")
    {
        // Affiche un message d'erreur
        genderErrorMsg.innerText = "Le genre doit être selectionné";
        gender.focus();
    }
    else
    {
        // Efface le message d'erreur
        genderErrorMsg.innerText = "";
    }



    // Vérification du prénom
    if (surname.value === "")
    {
        // Affiche un message d'erreur
        surnameErrorMsg.innerText = "Le prénom est requis.";
        surname.focus();
    }
    else if (!/^[a-zA-Z]+$/.test(surname.value))
    {
        // Affiche un message d'erreur
        surnameErrorMsg.innerText = "Le prénom ne doit contenir que des lettres.";
        surname.focus(); 
    }
    else
    {
        // Efface le message d'erreur
        surnameErrorMsg.innerText = "";
    }



    // Vérification du nom
    if (name.value === "")
    {
        // Affiche un message d'erreur 
        nameErrorMsg.innerText = "Le nom est requis.";
        name.focus();
    }
    else if (!/^[a-zA-Z]+$/.test(name.value))
    {
        // Affiche un message d'erreur
        nameErrorMsg.innerText = "Le nom ne doit contenir que des lettres.";
        name.focus(); 
    }
    else
    {
        // Efface le message d'erreur
        nameErrorMsg.innerText = "";
    }



    // Si les messages d'erreur sont vides on retourne true sinon false
    if (emailErrorMsg.innerText === "" && passwordErrorMsg.innerText === "" && nameErrorMsg.innerHTML === "" && surnameErrorMsg === "" && genderErrorMsg === "" && addressErrorMsg === "" && cityErrorMsg === "" && zipCodeErrorMsg === "")
    {
        // Renvoie vrai, la saisie est valide
        return true; 
    }
    else
    {
        // Efface le message d'erreur générer avec php
        //errorMsg.innerHTML = "";

        // Renvoie faux, il y a des erreurs de saisie
        return false;
    }
}
    
function validatePassword(password)
{
    // Expression régulière pour valider le mot de passe
    const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    
    // Teste si le mot de passe correspond à l'expression régulière
    return passwordRegex.test(password);
}