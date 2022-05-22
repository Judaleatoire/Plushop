

// $produits = document.querySelectorAll(".lien-produit");

function tri() {
    // $produits.forEach(element => {
    //     element.style.border = "solid 3px green";
    // });

    //TESTER SI CA FONCTIONNE SUR TOUS LES NAVIGUATEURS/OS
    if(window.XMLHttpRequest) xhr_objet = new XMLHttpRequest();
    else if(window.ActiveXObject) xhr_objet = new ActiveXObject("Microsoft.XMLHTTP");
    else {
        alert("Votre naviguateur ne supporte pas les objets XMLHTTPRequest");
        return;
    }

    xhr_objet.open("GET", "./data/produits.csv", true);
    xhr_objet.send(null);

    xhr_objet.onreadystatechange = function() {
        if(this.readyState == 4) alert(this.responseText);
    }

}

function loadFile(filePath) {
    var result = null;
    if(window.XMLHttpRequest) xhr_objet = new XMLHttpRequest();
    else if(window.ActiveXObject) xhr_objet = new ActiveXObject("Microsoft.XMLHTTP");
    else {
        alert("Votre naviguateur ne supporte pas les objets XMLHTTPRequest");
        return;
    }
}