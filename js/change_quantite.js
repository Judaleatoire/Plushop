/**
 * fonction qui permet de choisir la quantité a ajouter au panier sur la page produit
 * 
 * author : François guillerm
 *   
*/

//On récupère les éléments liés aux boutons
var boutons = document.querySelectorAll("#modif-ajout");
var stock_ajout = document.getElementById("quantite");

boutons.forEach(element => {
    element.addEventListener("click", function() {
        //On remet le + et le - au cas où l'utilisateur se serait amusé à aller modifier les boutons
        boutons[0].innerHTML = "-";
        boutons[1].innerHTML = "+";

        if(element.innerHTML == "+") {
            stock_ajout.value++; // on ajoute 1 si on clique sur +
        } else if (element.innerHTML == "-") {
            if(stock_ajout.value>1) { //on enlève 1 si on clique sur - et que la quantité > 1
                stock_ajout.value--;
            }
        }
    });
});