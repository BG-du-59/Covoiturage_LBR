function mod(bouton) {
    switch (bouton) {
        case 0:
            etat = document.getElementById("nom").style.display;
            if (etat === "none") {
                display_block("nom", "block");
                display_block("noms", "none");
                /* affiche un seul champs modifiable à la fois */
                // display_block("prenom", "none");
                // display_block("firstname", "block");
                // display_block("mail", "none");
                // display_block("email", "block");
                // display_block("tel", "none");
                // display_block("phone", "block");
            } else {
                display_block("nom", "none");
                display_block("noms", "block");
            }
            break;
        case 1:
            etat = document.getElementById("prenom").style.display;
            if (etat === "none") {
                display_block("prenom", "block");
                display_block("firstname", "none");
                /* affiche un seul champs modifiable à la fois */
                // display_block("nom", "none");
                // display_block("noms", "block");
                // display_block("mail", "none");
                // display_block("email", "block");
                // display_block("tel", "none");
                // display_block("phone", "block");
            } else {
                display_block("prenom", "none");
                display_block("firstname", "block");
            }
            break;
        case 2:
            /* bouton modifier  le mail*/
            etat = document.getElementById("mail").style.display;
            if (etat === "none") {
                display_block("mail", "block");
                display_block("email", "none");
                /* affiche un seul champs modifiable à la fois */
                // display_block("nom", "none");
                // display_block("noms", "block");
                // display_block("prenom", "none");
                // display_block("firstname", "block");
                // display_block("tel", "none");
                // display_block("phone", "block");
            } else {
                display_block("mail", "none");
                display_block("email", "block");
            }
            break;
        case 3:
            /* bouton modifier numéro de tel*/
            etat = document.getElementById("tel").style.display;
            if (etat === "none") {
                display_block("tel", "block");
                display_block("phone", "none");

                /* affiche un seul champs modifiable à la fois */
                // display_block("mail", "none");
                // display_block("email", "block");
                // display_block("nom", "none");
                // display_block("noms", "block");
                // display_block("firstname", "block");
                // display_block("prenom", "none");
            } else {
                display_block("tel", "none");
                display_block("phone", "block");
            }
            break;
    }
    return;
}


function display_block(id, etat) {
    document.getElementById(id).style.display = etat;
    return;
}