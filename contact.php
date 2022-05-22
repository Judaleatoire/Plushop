<?php
    session_start();
?>

<?php // https://www.php.net/manual/fr/function.filter-var.php

// https://www.php.net/manual/fr/filter.filters.validate.php
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
    echo '<pre>';

    $verif=false;
    //var_dump($_POST);

    $dateC=$_POST['dateC'] ?? null;
    $lastName=$_POST['nom'] ?? null;
    $firstName=$_POST['prenom'] ?? null;
    $date=$_POST['date'] ?? null;
    $email=$_POST['email'] ?? null;
    $sexe=$_POST['sexe'] ?? null;
    $fontion=$_POST['fonction'] ?? null;

    if(isset($dC) && !empty($dC)) {
        if(checkType($dC, "dateC")===null) {
            $errors[]="La date de contact n'est pas renseignée correctement ";
        }
    }

    else $errors[]="La date de contact n'est pas renseignée";


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

    if(isset($d) && !empty($d)) {
        if(checkType($d, "date")===null) {
            $errors[]="La date n'est pas renseignée correctement ";
        }
    }

    else $errors[]="La date n'est pas renseignée";


    if(isset($email) && !empty($email)) {
        if(checkType($email, "email")===null) {
            $errors[]="Le mail n'est pas renseigné correctement, ex : e.mail@mail.com ";
        }
    }

    else $errors[]="Le mail n'est pas renseigné";

    if( !isset($sexe)) {
        $errors[]="Le genre n'a pas été sélectionné";
    }


    if( !isset($fonction)) {
        $errors[]="Votre fonction n'est pas renseigné";
    }


    if(count($errors)===0) {
        $verif=true;
    }

    // var_dump($errors);
    echo '</pre>';

}

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Plushop | Contact</title>
    <meta charset="utf-8">
    <script src="./js/contact.js"></script>
</head>
<body>
    <div class="forms">

        <form action="" method="post" id="form">

            <label for="dateC"> Date de contact</label><br>
            <input type="date" name="dateC" id="dateC" placeholder="date de contact" required> <br><br>

            <label for="nom">Nom</label><br>
            <input type="text" name="nom" id="nom" placeholder="Nom" pattern="[a-zA-ZÀ-ÿ]{2,20}" required><br><br>

            <label for="prenom">Prénom</label><br>
            <input type="text" name="prenom" id="prenom" placeholder="Prénom" pattern="[a-zA-ZÀ-ÿ]{2,20}" required> <br><br>

            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" placeholder="Adresse électronique" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required> <br><br>

            <label for="sexe">Sexe</label><br>
            <input type="radio" name="sexe" id="homme" value="homme">
            <label for="homme">Homme</label>
            <input type="radio" name="sexe" id="femme" value="femme">
            <label for="femme">Femme</label> <br><br>

            <label for="date"> Date de naissance</label><br>
            <input type="date" name="date" id="date" placeholder="date de naissance" max="2022-01-01"
            min="1910-01-01" required> <br><br>

            <label for="fonction">Fonction</label><br>
                <select id="fonction">
                    <option value="enseignant">Enseignant</option>
                    <option value="assistant">Assistant</option>
                    <option value="courscharger">Chargé(e) de cours</option>
                    <option value="MCA">MCA</option>
                    <option value="MCB">MCB</option>
                    <option value="ATER">ATER</option>
                </select><br><br>

                <label for="sujet">Sujet</label><br>
                <input type="text" name="sujet" id="sujet" placeholder="sujet" required><br><br>

                <label for="contenu">Contenu</label>
                <textarea id="contenu" name="contenu" rows="5" cols="40"></textarea><br><br>

                <input type="submit" value="Envoyer" class="button">
                
        </form>
    </div>
</body>