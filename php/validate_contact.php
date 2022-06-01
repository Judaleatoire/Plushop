<?php

/**
 * Vérifie les informations remplies dans le formulaire de contact après le js.
 * 
 * on verifie si chaque input correspond au bon pattern ou s'il n'est pas vide.
 * 
 * @author Amandine Chantome
*/

//verifie que le type de valeur envoyé est bien respecté
function checkType($value, $type) {
    switch($type) {
        case "email":
            return filter_var($value, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE); //premier filtre verifie qu'il s'agit bien d'un email si s'en est pas un l'autre filter renvoit null
        break;
        case "date":
            return new DateTime($value); //renvoi null si valeur pas de type date
        break;
        case "text":
            return gettype($value)==="string"? $value: null; 
        break;
        default:
            return null;
        break;
    }

}


if($_SERVER['REQUEST_METHOD']==="POST") {
    // if post method
    $errors=[];

    $verif=false;
    $lastName=$_POST['nom'] ?? null;
    $firstName=$_POST['prenom'] ?? null;
    $date=$_POST['date'] ?? null;
    $dateC=$_POST['dateC'] ?? null; 
    $email=$_POST['email'] ?? null;
    $adresse=$_POST['adresse'] ?? null;
    $fonction=$_POST['fonction'] ?? null;
    $sexe=$_POST['sexe'] ?? null;

    if(isset($lastName) && !empty($lastName)) { //si variable existe et n'est pas null
        if(checkType($lastName, "text")===null) { 
            $errors[]="Le nom n'est pas renseigné correctement, ex: Dupond";
        }
    }
    else $errors[]="Le nom n'est pas renseigné, ex: Dupond";


    if(isset($firstName)&& !empty($firstName)) {
        if(checkType($firstName, "text")===null) {
            $errors[]="Le prénom n'est pas renseignée correctement, ex: Louis ";
        }
    }
    else $errors[]="Le prénom n'est pas renseigné, ex: Louis";

    if(isset($date) && !empty($date)) {
        $cd = checkType($date, "date");
        if( $cd ===null) {
            $errors[]="La date n'est pas renseignée correctement ";
        }

        // calcul de l'age
        $age = date('Y') - date('Y', strtotime($date)); //année d'aujourd'hui - année d'anniversaire
        if (date('md') < date('md', strtotime($date))) { //si les jour et mois d'aujourd'hui sont avant jour et mois d'anniversaire on fait age-1
            $age--;
        } 

        if($age <= 14) {
            $errors[] = "Vous devez avoir plus de 14 ans";
        } 
    }
    else $errors[]="La date n'est pas renseignée";
    
    if(isset($dateC) && !empty($dateC)) {
        if(checkType($dateC, "date")===null) {
            $errors[]="La date de rendez-vous n'est pas renseignée correctement ";
        }
    }
    else $errors[]="la date de rendez-vous n'est pas renseignée";

    if(isset($email) && !empty($email)) {
        if(checkType($email, "email")===null) {
            $errors[]="Le mail n'est pas renseigné correctement, ex : e.mail@mail.com ";
        }
    }

    else $errors[]="Le mail n'est pas renseigné, ex : e.mail@mail.com";

    if( !isset($fonction)) {
        $errors[]="La fonction n'est pas renseignée";
    }

    if( !isset($sexe)) {
        $errors[]="Le genre n'a pas été sélectionné";
    }
    header("Content-type: application/json");
    if(count($errors)===0) { // si pas d'erreurs on renvoi ok
        $verif=true;
        // repond ok a la requête du js si pas d'erreurs
        echo('{"message":"ok"}');
    } else {  
        //sinon repond toutes les erreurs a la requête en json
        echo('{"errors":'.json_encode($errors).'}');
    }
}
?>