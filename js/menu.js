// #menu_open 
// menu_open
// -> add event click et tu modifie le style
// element.style.width = "250px"

function openNav() {
    document.getElementById("menu-cote").style.width = "15%";
}

let btn = document.getElementById("menu_open");
let menu = document.getElementById("menu-cote");
if(btn && menu){
    btn.addEventListener("click", (e) => {
        if(menu.style.width === ""){
            menu.style.width = "15%";
        } else if(menu.style.width === "0%"){
            menu.style.width = "15%"
        }
        else
        if(menu.style.width === "15%"){
            menu.style.width = "0%"
        }
    })
}

// a bind sur .closebtn le on click
// faire la meme chose que pour le btn 
function closeNav() {
    document.getElementById("menu-cote").style.width = "0%";
}