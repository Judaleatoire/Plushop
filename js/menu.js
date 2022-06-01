/**
 * fonctions qui controlent l'ouverture et la fermeture du menu-cote 
 * 
 * author : Amandine Chantome
 *   
*/


function openNav() {
    document.getElementById("menu-cote").style.width = "15%";
}

let btn = document.getElementById("menu_open");
let menu = document.getElementById("menu-cote");
if(btn && menu){
    btn.addEventListener("click", (e) => {
        if(menu.style.width === ""){ //si le menu pas ouvert
            menu.style.width = "15%"; // largeur du menu
        } else if(menu.style.width === "0%"){ //si menu pas ouvert
            menu.style.width = "15%" // largueur du menu
        }
        else
        if(menu.style.width === "15%"){ //si le menu est ouvert
            menu.style.width = "0%"
        }
    })
}

function closeNav() {
    document.getElementById("menu-cote").style.width = "0%";
}