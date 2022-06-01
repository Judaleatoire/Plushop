/**
 * fonction qui permet d'afficher ou cacher le stock lorsqu'on appuie sur le bouton sur la page catégorie
 * 
 * author : François guillerm
 *   
*/

//On récupère les éléments liés au stock
var stocks = document.querySelectorAll(".stock-produit");
var btn_stock = document.getElementById("btn_stock");
var state = 1;

function afficher_stock() {
    stocks.forEach(element => {
        //On change le style des div en fonction de l'état dans lequel on était
        if (state == 1) {
            element.style.display = "none";
            btn_stock.innerHTML="<i class='las la-box'></i> Afficher le stock";
        } else {
            element.style.display = "block";
            btn_stock.innerHTML="<i class='las la-box'></i> Cacher le stock";

        }
    });
    //On modifie l'état à la fin de l'opération
    if (state == 1) {
        state = 0;
    } else state = 1;
}