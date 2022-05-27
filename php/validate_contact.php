<?php

function checkType($value, $type) {
    switch($type) {
        case "email":
            return filter_var($value, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE);
        break;
        case "date":
            return new DateTime($value);
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
    //var_dump($_POST);

    $lastName=$_POST['nom'] ?? null;
    $firstName=$_POST['prenom'] ?? null;
    $date=$_POST['date'] ?? null;
    $dateC=$_POST['dateC'] ?? null; 
    $email=$_POST['email'] ?? null;
    $adresse=$_POST['adresse'] ?? null;
    $fonction=$_POST['fonction'] ?? null;
    $sexe=$_POST['sexe'] ?? null;

    if(isset($lastName) && !empty($lastName)) {
        if(checkType($lastName, "text")===null) {
            $errors[]="Le nom n'est pas renseigné correctement, ex: Dupond";
        }
    }

    else $errors[]="Le nom n'est pas renseigné";

    if(isset($firstName)&& !empty($firstName)) {
        if(checkType($firstName, "text")===null) {
            $errors[]="Le prénom n'est pas renseignée correctement, ex: Louis ";
        }
    }

    else $errors[]="Le prénom n'est pas renseigné";

    if(isset($date) && !empty($date)) {
        $cd = checkType($date, "date");
        if( $cd ===null) {
            $errors[]="La date n'est pas renseignée correctement ";
        }
        // check age
        $age = date('Y') - date('Y', strtotime($date)); 
        if (date('md') < date('md', strtotime($date))) { 
            return $age - 1; 
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

    else $errors[]="Le mail n'est pas renseigné";

    if( !isset($fonction)) {
        $errors[]="La fonction n'est pas renseignée";
    }

    if( !isset($sexe)) {
        $errors[]="Le genre n'a pas été sélectionné";
    }
    header("Content-type: application/json");

    if(count($errors)===0) {
        $verif=true;
        // when is good
        echo('{"message":"ok"}');
    } else {
        // {"errors": ["Meow", "Maouu"]}
        echo('{"errors":'.json_encode($errors).'}');
        
    }

    // var_dump($errors);

}
?>