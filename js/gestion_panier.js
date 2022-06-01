function buy(ref){
    let data = new FormData();
    data.set("type", "add");
    data.set("ref", ref);
    data.set("qt", document.getElementById("quantite").value);
    send(data);
}

function supp(ref) {
    let data = new FormData();
    data.set("type", "supp");
    data.set("ref", ref);
    send(data);
}

function modif_qt(ref, signe) {
    let data = new FormData();
    data.set("type", "modif");
    data.set("ref", ref);
    data.set("signe", signe);
    send(data);
}

function clear() {
    let data = new FormData();
    data.set("type", "clear");
    send(data);
}

async function send(data){
    return fetch("../php/cart.php", {
        method: 'POST',
        body: data
    }).then(x => {
        document.location.href = "panier_autre_version.php";
    }).catch(x => {
        console.log("error");
    })
}