/**
 * fonction qui permet d'afficher afficher l'image choisie sur la page produit en image principale 
 * et permet l'ajout d'une bordure sur l'image sélectionnée.
 * 
 * author : François guillerm
 * author : Amandine Chantôme
 *   
*/

//On récupère les éléments liés aux images
var choix_image = document.querySelectorAll(".choix-image");
var image_principale = document.getElementById("image-principale");
var image_selectionnee = choix_image[0];
image_selectionnee.classList.add("choix-image-active");

choix_image.forEach(element => {
    //Lorsque l'on clique sur une image, on fait en sorte de la placer en image principale et d'appliquer des styles
    element.addEventListener("click", function () {
        image_selectionnee.classList.remove("choix-image-active");
        image_principale.src = element.src;
        image_principale.alt = element.alt;
        image_selectionnee = element;
        image_selectionnee.classList.add("choix-image-active");
    });
});