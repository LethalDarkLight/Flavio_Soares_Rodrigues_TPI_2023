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