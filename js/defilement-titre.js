var titres = document.querySelectorAll("h2");

titres.forEach(element => {
    element.addEventListener("scroll", function() {
        element.style.left = window.scrollY * 5 + "px";
    });
});