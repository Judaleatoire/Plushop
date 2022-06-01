<?php
    /**
     * Page qui permet de modifier les informations remplies par l'utilisateur ou de les remplir si elles sont vides.
     * 
     * @author François Guillerm
    */
?>

<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plushop|Magasin spécialisé dans la vente de peluche</title>

    <link rel="stylesheet" href="css/style.css?v=2">
    <link rel="stylesheet" href="css/categorie.css?v=2">
</head>

<body>

    <?php include "header.php"; ?>

    <?php //si 'lutilisateur n'est pas connecté
        if(!isset($_SESSION['info_login']) || empty($_SESSION['info_login'])) header("Location: identification.php") 
    ?>

    <div class="container">

        <h2>Profil</h2>

        <?php

            //On récupère les informations de connections
            $infos = $_SESSION['info_login'];
            $nom_info = [
                "login" => "Mail",
                "pseudo" => "Pseudonyme",
                "pos" => "Position",
                "nom" => "Nom",
                "prenom" => "Prénom",
                "genre" => "Genre",
                "tel" => "Numéro de téléphone",
                "date_naissance" => "Date de naissance",
                "adresse" => "Adresse",
                "metier" => "Metier"
            ];

            //On écrit les informations de l'utilisateur
            foreach($infos as $key => $information) {
                if($key != "pos") {
                    echo("<div class='div-$key'>");
                    if(!empty($information)) echo($nom_info[$key] . " : $information");
                    else echo($nom_info[$key] . " : Information non renseignée");
                    echo("</div>");
                }
            }
        ?>

    </div>

    <?php include "footer.php"; ?>

</body>