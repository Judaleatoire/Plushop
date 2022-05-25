// https://developer.mozilla.org/fr/docs/Web/API/Fetch_API/Using_Fetch
// function tri() {
    // $produits.forEach(element => {
    //     element.style.border = "solid 3px green";
    // });

    //TESTER SI CA FONCTIONNE SUR TOUS LES NAVIGUATEURS/OS
    // if(window.XMLHttpRequest) xhr_objet = new XMLHttpRequest();
    // else if(window.ActiveXObject) xhr_objet = new ActiveXObject("Microsoft.XMLHTTP");
    // else {
    //     alert("Votre naviguateur ne supporte pas les objets XMLHTTPRequest");
    //     return;
    // }
    // // localhost/monprojet/monprojet<- ./
    // //  
    // xhr_objet.open("GET", "data/produits.csv", true);
    // xhr_objet.send(null);

    // xhr_objet.onreadystatechange = function() {
    //     if(this.readyState == 4) alert(this.responseText);
    // }

    // Asynchrone
    // let data = fetch("data/produits.csv", {
    //     headers: {
    //         'Content-Type': "text/csv;charset=UTF-8"
    //     }
    // }).then(request => {
    //     if(request.ok){
    //         return request.text();
    //     }
    // }).then(data => {
    //     console.log(data);
    //     // execute ton code tri ici 
    // })
    // .catch(error => {
    //     console.error(error);
    // })
    // console.log(data);
// }

// async function getData(){
//     let data = await fetch("data/produits.csv", {
//         headers: {
//             'Content-Type': "text/csv;charset=UTF-8"
//         }
//     }).then(request => {
//         if(request.ok){
//             return request.text();
//         }
//     }).then(data => {
//         console.log(data);
//         // execute ton code tri ici 
//     }).catch(error => {
//         console.error(error);
//     })
//     console.log(data);
// }

var produits = document.querySelectorAll(".lien-produit");

function compare_string(a, b) {
    if(a.nom < b.nom) return -1;
    if(a.nom > b.nom) return 1;
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

//gerer les erreurs
async function filtre() {
    
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
        let sort_data = data;
        sort_data.sort(compare_string);

        console.log(sort_data);

        for(let i=0; i<produits.length; i++) {
            let ref = produits[i].href.split('=')[1];
            let indice = sort_data.findIndex(produit => produit.ref == ref);
            produits[i].style.order = indice;
        }
    })

}