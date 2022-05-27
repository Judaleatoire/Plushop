function verifier(){

    var name = document.getElementById("last_name").value;
    var f_name = document.getElementById("first_name").value;
    var email = document.getElementById("email").value;
    var c_email = document.getElementById("confirm_email").value;
    var tel = document.getElementById("cell").value;
    var adresse = document.getElementById("adresse").value;
    var i = 0;

    if ((name == null) || (!test_nombre(name)) ||(name == "")){
        document.getElementById("last_name").style.borderColor = "#FF0000";
        alert ("Entrer un nom correct");
    }else{
        document.getElementById("last_name").style.borderColor = "#09FF00";
        i++;
    }
    if((f_name == null) || (!test_nombre(name)) ||(f_name == "")){
        document.getElementById("first_name").style.borderColor = "#FF0000";
        alert ("Entrer un prénom correct");
    }else{
        document.getElementById("first_name").style.borderColor = "#09FF00";
        i++;
    }
    if ((email == "0") && (c_email == "0") || (!test_email(email, c_email)) || (!test_nombre(email)) || (!test_nombre(c_email))){
        document.getElementById("email").style.borderColor = "#FF0000";
        document.getElementById("confirm_email").style.borderColor = "#FF0000";
        alert ("Entrer un email et/ou les emails ne correspondent pas");
    }else{
        document.getElementById("email").style.borderColor = "#09FF00";
        document.getElementById("confirm_email").style.borderColor = "#09FF00";
        i++;
    }
    if ((tel == null) || (!test_nombre_tel(tel)) || (tel == "0")){
        alert ("Entrer un numéro de télépone valide");
        document.getElementById("cell").style.borderColor = "#FF0000";
    }else{
        document.getElementById("cell").style.borderColor = "#09FF00";
        i++;
    }
    if ((adresse == null) || (adresse == 0) || (adresse == "0")){
        alert ("Entrer une adresse valide");
        document.getElementById("adresse").style.borderColor = "#FF0000";
    }else{
        document.getElementById("adresse").style.borderColor = "#09FF00";
        i++;
    }

    if (i == 5){
        return true;
    }else{
        return false;
    }
}


function test_nombre(chaine){
    return isNaN(chaine);
}

function test_nombre_tel(tel){
    if ((!isNaN(tel))){
        if (tel.length == 10){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}


function test_email(email, email1){
    if (email == email1){
        return true;
    }else{
        return false;
    }
}