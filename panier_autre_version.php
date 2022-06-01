<!DOCTYPE html>
<html>
<head lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plushop | Panier</title>
    <link rel="stylesheet" href="./css/style.css?v=2">
</head>

<body>

    <?php include "header.php"; ?>

    <?php
        include_once "php/open_file.php";
        include_once "php/chercher_produit.php";
    ?>

    <div class="container">
 
        <?php

            // session_destroy();

            // session_start();

            if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo("Votre panier est vide !");
            } else {

                var_dump($_SESSION['cart']);

                $csv = open_file("data/produits.csv", "csv", "page_erreur.php");

                // $panier = $_SESSION['cart'];
                $panier = [];

                foreach($_SESSION['cart'] as $produit) {
                    // $tmp = chercher_produit($csv, $produit['ref']);
                    $panier[$produit['ref']] = chercher_produit($csv, $produit['ref']);
                    $panier[$produit['ref']]['qt'] = $produit['qt'];
                }

                echo("<table border='solid 3px black'>");
                echo("<tr><th>Nom</th><th>Prix</th><th>Quantité</th><th>Solde</th></tr>");
                foreach($panier as $elmPanier) {
                    echo("<tr>");
                    echo("<td>" . $elmPanier['nom'] . "</td>");
                    echo("<td>" . floatval($elmPanier['prix'])*floatval($elmPanier['qt']) . "</td>");
                    echo("<td><button onclick='modif_qt(`" . $elmPanier['ref'] . "`, `-`)'>-</button>" . $elmPanier['qt'] . "<button onclick='modif_qt(`" . $elmPanier['ref'] . "`, `+`)'>+</button></td>");
                    echo("<td>" . $elmPanier['solde'] . "</td>");
                    echo("<td><button onclick='supp(`" . $elmPanier['ref'] . "`)'>Supprimer</button></td>");
                    echo("</tr>");
                }
                // echo("<tr><td></td></tr>");
                echo("</table>");

            }

        ?>

    </div>
        
    <?php include "footer.php"; ?>
    
    <script src="./js/gestion_panier.js?v=2"></script>

</body>

</html>