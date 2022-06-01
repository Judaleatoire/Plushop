/**
 * Les 4 fonctions suivantes permettent de gérer les comparaisons avec la fonction sort()
 * On effectue le tri par ordre croissant et décroissant et par ordre aplhabétique et par prix
 * 
 * author : François guillerm
 *   
*/

//On récupère les éléments liés aux tris/filtres
var produits = document.querySelectorAll(".lien-produit");

// Nous avions commencé à faire le système pour gérer les filtres mais nous n'avons pas eu le temps de le mettre en place 
// var tailles = document.querySelectorAll("input[name='taille']:checked");

//On a 4 fonctions permettant de faire des comparaisons pour les différents tris
function compare_string_croiss(a, b) {
    if (a.nom < b.nom) return -1;
    if (a.nom > b.nom) return 1;
    return 0;
}

function compare_string_decroiss(a, b) {
    if (a.nom < b.nom) return 1;
    if (a.nom > b.nom) return -1;
    return 0;
}

function compare_price_croiss(a, b) { //en prenant en compte les prix soldés
    if (parseFloat(a.prix*(1-a.solde/100)) < parseFloat(b.prix*(1-b.solde/100))) return -1;
    if (parseFloat(a.prix*(1-a.solde/100)) > parseFloat(b.prix*(1-b.solde/100))) return 1;
    return 0;
}

function compare_price_decroiss(a, b) {  // en prenant en compte les prix soldés
    if (parseFloat(a.prix*(1-a.solde/100)) < parseFloat(b.prix*(1-b.solde/100))) return 1;
    if (parseFloat(a.prix*(1-a.solde/100)) > parseFloat(b.prix*(1-b.solde/100))) return -1;
    return 0;
}

//Conversion d'un tableau indicé en un tableau associatif
function tabToKey(tab) {
    let tabKey = {
        ref: tab[0],
        nom: tab[1],
        desc: tab[2],
        prix: tab[3],
        nouv: tab[4],
        solde: tab[5],
        stock: tab[6],
        dim: tab[7],
        taille: tab[8],
        couleur: tab[9],
        marque: tab[10]
    }
    return tabKey;
}

//On crée un tableau de produits à partir du fichier CSV
function parseCSV(data) {
    let tab = data.split("\n");
    let tmp = [];
    for (let i = 0; i < tab.length; i++) {
        tmp = tab[i].split(",");
        tab[i] = tabToKey(tmp);
    }
    return tab;
}

//Les 2 fonctions suivantes ne sont pas utilisées mais elles permettent de remettre à 0 l'ordre et l'affichage des produits
function reset_order() {
    for (let i = 0; i < produits.length; i++) {
        produits[i].style.order = i;
    }
}


function reset_hidden() {
    for (let i = 0; i < produits.length; i++) {
        produits[i].style.display = "block";
    }
}

//Fonction permettant de donner un nouvel ordre aux produits de la page
function tri(sort_data) {
    for (let i = 0; i < produits.length; i++) {
        let ref = produits[i].dataset.ref;
        let indice = sort_data.findIndex(produit => produit.ref == ref);
        produits[i].style.order = indice;
    }
}

async function filtre(type) {

    //On utilise fetch pour récupérer les données du fichier CSV
    await fetch("data/produits.csv", {
        headers: {
            'Content-Type': "text/csv;charset=UTF"
        }
    }).then(response => {
        if (response.ok) {
            return response.text();
        }
    }).then(text => {
        return parseCSV(text);
    }).then(data => {
        let sort_data = [...data];

        //Après avoir mis les informations dans un format lisible, on applique le tri souhaité
        switch (type) {
            case "TAC":
                sort_data.sort(compare_string_croiss);
                break;
            case "TAD":
                sort_data.sort(compare_string_decroiss);
                break;
            case "TPC":
                sort_data.sort(compare_price_croiss);
                break;
            case "TPD":
                sort_data.sort(compare_price_decroiss);
                break;
            default:
                window.location.href = "page_erreur.php";
        }

        tri(sort_data);

    })

}