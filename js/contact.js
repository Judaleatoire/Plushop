/**
 * Vérifie les informations remplies dans le formulaire de contact
 * Si aucune erreur envoi au fichier validate_contact.php pour verifier une seconde fois
 * 
 * author : Amandine Chantome
 *   
*/


let form = document.getElementById("form");


//verifie que la valeur envoyé correspond au pattern de vérification associé
function test(value, test) {
    return test.test(value);
}

//ecrit les erreurs dans une div au dessus
function errorMessage(message) {
    let element = document.getElementById("error");
    element.innerText = message;
    element.classList.remove("hidden");
}

//fonction qui calcul l'age
function getAge(ms) {
    var today = new Date();
    var birthDate = new Date(ms);
    var age = today.getFullYear() - birthDate.getFullYear();// age = année aujourd'hui - année anniversaire
    var m = today.getMonth() - birthDate.getMonth(); // m = mois aujourd'hui - mois anniversaire
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { // si m negatif OU m = 0 ET date d'anniversaire pas ancore passée => age-1
        age--;
    }
    return age;
}

//calcul la difference entre les mois et verifie que le jour selectionné est bien dans le mois suivant la date du jour.
function monthDiff(d2) {
    var today = new Date();
    var rdv = new Date(d2);
    var months;
    months = (rdv.getFullYear() - today.getFullYear()) * 12; //donne la difference entre deux années en mois
    months -= today.getMonth(); //on enlève a cette difference les premiers mois jusqu'a la date du jour (pour ne pas les avoir en double)
    months += rdv.getMonth(); //on ajoute les mois entre janvier et le mois du rdv
    var days = today.getDate() - rdv.getDate(); 

    if(months != 0) {
        if (months == 1 && days >= 0) { //s'il y a exactement un mois d'ecart ou moins on renvoi 1
            return 1;
        }
        else return 0;
    } 
    else if(months < 1 && days < 0) return 1;
    else return 0;
    
}




form.onsubmit = (e) => {
    e.preventDefault();
    let errors = []; // une liste qui récupère les erreurs

    let lastName = document.getElementById("nom");
    let firstname = document.getElementById("prenom");
    let email = document.getElementById("email");
    let homme = document.getElementById("homme");
    let femme = document.getElementById("femme");
    let fonction = document.getElementById("fonction");
    let date = document.getElementById("date");
    let dateC = document.getElementById("dateC");

    if (!test(lastName.value, /^[a-zA-Z\u00C0-\u017F]+$/)) {
        errors.push("Le nom n'est pas valide, ex: Dupond");
    }

    if (!test(firstname.value, /^[a-zA-Z\u00C0-\u017F]+$/)) {
        errors.push("Le prénom n'est pas valide, ex: Louis ");
    }


    if (!test(email.value, /\b[\w\.-]+@[\w\.-]+\.\w*\b/)) {
        errors.push("Le mail n'est pas valide, , ex : e.mail@mail.com");
        email.classList.add("form-error");
    }

    if (homme.checked === false && femme.checked === false) {
        errors.push("le genre n'a pas été choisi !");
    }

    let time = date.valueAsNumber; // millisecond
    if (getAge(time) <= 14) {
        errors.push("Vous devez avoir plus de 14 ans");
    }

    let month = dateC.valueAsNumber;
    if (monthDiff(month) == 0) {
        errors.push("Date de rendez-vous incorrecte, elle doit se situer dans le mois qui suit");
    }


    let fonctions = ["enseignant", "cadre", "artisant", "ouvrier", "autre"];
    if (!fonctions.includes(fonction.value)) {
        errors.push("La fonction n'est pas dans la liste");
    }

    if (errors.length >= 1) {
        let msg = "";
        errors.forEach(x => msg += x + "\n");
        window.scrollTo({ top: 0, behavior: "smooth" });
        errorMessage(msg);
    } else {
        errorMessage("");
        // si pas d'erreurs
        //envoi une requete a validate_contact.php
        fetch("php/validate_contact.php", {
            method: "POST",
            body: new FormData(form) //recupère les données du formulaire
        }).then(x => {
            if (x.ok) { //s'il n'y a pas d'erreurs
                return x.json(); //renvoi message ok
            }
        }).then(response => {
            if (response?.errors) { //s'il existe des erreurs
                errorMessage(response.errors.join("\n")); //on ecrit les messages d'erreurs reçus
            } else {
                // correct already send the mail
            }
        }).catch(e => console.error(e)) //gère les erreurs d'execution des then

    }
}
