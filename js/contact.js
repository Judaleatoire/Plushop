let form = document.getElementById("form");

function test(value, test){
    return test.test(value);
}

function errorMessage(message){
    let element = document.getElementById("error");
    element.innerText = message;
    element.classList.remove("hidden");
    
    setTimeout(() =>{
        element.classList.add("hidden");
    }, 10 * 1000)
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

function calend(){
    var d = new Date();
    var dC = document.getElementById("dateC");
    var tmp = dC.strtotime() - d.strtotime();
    if (tmp > 2629800){
        alert("La date selectionnée n'est pas valide");
    }
}

form.onsubmit = (e) => {
    e.preventDefault();
    let errors = []; // une liste qui récupère les erreurs
    let inputs = document.querySelectorAll("#form input");

    let lastName = document.getElementById("nom");
    let firstname = document.getElementById("prenom");

    let email = document.getElementById("email");

    let homme = document.getElementById("homme");
    let femme = document.getElementById("femme");
    let fonction = document.getElementById("fonction");
    let date = document.getElementById("date");
    let dateC = document.getElementById("dateC");

    if(!test(lastName.value, /^[a-zA-Z\u00C0-\u017F]+$/ )){
        errors.push("Le nom n'est pas valide !");
    }

    if(!test(firstname.value, /^[a-zA-Z\u00C0-\u017F]+$/ )){
        errors.push("Le prénom n'est pas valide !");
    }


    if(!test(email.value, /\b[\w\.-]+@[\w\.-]+\.\w*\b/)){
        errors.push("Le mail n'est pas valide !");
    }

    if(homme.checked === false && femme.checked === false){
        errors.push("le genre n'a pas été choisi !");
    }

    let time = date.valueAsNumber; // millisecond
    if(getAge(time) < 14){
        errors.push("Vous n'avez pas 14 ans !");
    }
    
    let fonctions = ['assistant', "courscharger", "MCA", "MCB", "ATER"];
    if(!fonctions.includes(fonction.value)){
        errors.push("Le grade n'est pas dans la liste des grades  !");
    }

    if(errors.length >= 1){
        let msg = "";
        errors.forEach(x => msg += x +"\n")
        window.scrollTo({top: 0, behavior: "smooth"});
        errorMessage(msg)
    }
}