let form = document.getElementById("form");

function test(value, test) {
    return test.test(value);
}


function errorMessage(message) {
    let element = document.getElementById("error");
    element.innerText = message;
    element.classList.remove("hidden");
}

function getAge(ms) {
    var today = new Date();
    var birthDate = new Date(ms);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function monthDiff(d2) {
    var today = new Date();
    var rdv = new Date(d2);
    var months;
    months = (rdv.getFullYear() - today.getFullYear()) * 12;
    months -= today.getMonth();
    months += rdv.getMonth();
    var days = today.getDate() - rdv.getDate;
    if (months = 1 && days >= 0 || months < 1) {
        return 1;
    }
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
        errors.push("Le nom n'est pas valide !");
    }

    if (!test(firstname.value, /^[a-zA-Z\u00C0-\u017F]+$/)) {
        errors.push("Le prénom n'est pas valide !");
    }


    if (!test(email.value, /\b[\w\.-]+@[\w\.-]+\.\w*\b/)) {
        errors.push("Le mail n'est pas valide !");
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
        errors.push("date de rendez-vous trop éloignée");
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
        // when is good 

        fetch("php/validate_contact.php", {
            method: "POST",
            body: new FormData(form)
        }).then(x => {
            if (x.ok) {
                return x.json();
            }
        }).then(response => {
            if (response?.errors) {
                errorMessage(response.errors.join("\n"));
            } else {
                // correct already send the mail
            }
        }).catch(e => console.error(e))

    }
}
