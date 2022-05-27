var produits = document.querySelectorAll(".lien-produit");
// var tailles = document.querySelectorAll("input[name='taille']:checked");
// console.log(tailles);

//peut etre faire une fonction qui peut tout gérer d'un coup
function compare_string_croiss(a, b) {
    if(a.nom < b.nom) return -1;
    if(a.nom > b.nom) return 1;
    return 0;
}

function compare_string_decroiss(a, b) {
    if(a.nom < b.nom) return 1;
    if(a.nom > b.nom) return -1;
    return 0;
}

function compare_price_croiss(a, b) {
    if(parseFloat(a.prix) < parseFloat(b.prix)) return -1;
    if(parseFloat(a.prix) > parseFloat(b.prix)) return 1;
    return 0;
}

function compare_price_decroiss(a, b) {
    if(parseFloat(a.prix) < parseFloat(b.prix)) return 1;
    if(parseFloat(a.prix) > parseFloat(b.prix)) return -1;
    return 0;
} 

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

function parseCSV(data) {
    let tab = data.split("\n");
    let tmp = [];
    for(let i=0; i<tab.length; i++) {
        tmp = tab[i].split(",");
        tab[i] = tabToKey(tmp);
    }
    return tab;
}

//faire des tests
function reset_order() {
    for(let i=0; i<produits.length; i++) {
        produits[i].style.order = i;
    }
}

//faire des tests
function reset_hidden() {
    for(let i=0; i<produits.length; i++) {
        produits[i].style.display = "block";
    }
}

function tri(sort_data) {
    for(let i=0; i<produits.length; i++) {
        let ref = produits[i].dataset.ref;
        let indice = sort_data.findIndex(produit => produit.ref == ref);
        produits[i].style.order = indice;
    }
}

//gerer les erreurs
async function filtre(type) {
    
    await fetch("data/produits.csv", {
        headers: {
            'Content-Type': "text/csv;charset=UTF"
        }
    }).then(response => {
        if(response.ok) {
            return response.text();
        }
    }).then(text => {
        return parseCSV(text);
    }).then(data => {
        let sort_data = [...data];

        console.log(data);
        // console.log(tailles);

        switch(type) {
            case "TAC":
                sort_data.sort(compare_string_croiss);
                console.log(sort_data);
                break;
            case "TAD":
                sort_data.sort(compare_string_decroiss);
                // console.log(sort_data);
                break;
            case "TPC":
                sort_data.sort(compare_price_croiss);
                // console.log(sort_data);
                break;
            case "TPD":
                sort_data.sort(compare_price_decroiss);
                // console.log(sort_data);
                break;
            default:
                window.location.href = "page_erreur.php";
        }

        tri(sort_data);

        // console.log(sort_data);

        
    })

}