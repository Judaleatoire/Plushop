<!DOCTYPE html>
<html>
<head lang="fr">
    <title>Plushop | Panier</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css?v=2">
</head>

<body>

    <?php include "header.php"; ?>

    <?php
        include_once "php/open_file.php";
    ?>

    <div class="container">
 
        <?php

            // session_destroy();

            if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo("Votre panier est vide !");
            } else {

                $panier = $_SESSION['cart'];

                echo("<table border='solid 3px black'>");
                echo("<tr><th>Nom</th><th>Prix</th><th>Quantité</th><th>Solde</th></tr>");
                foreach($panier as $elmPanier) {
                    echo("<tr>");
                    echo("<td>" . $elmPanier['nom'] . "</td>");
                    echo("<td>" . $elmPanier['prix'] . "</td>");
                    echo("<td>" . $elmPanier['qt'] . "</td>");
                    echo("<td>" . $elmPanier['solde'] . "</td>");
                    echo("</tr>");
                }
                echo("</table>");

            }

        ?>

    </div>
        
    <?php include "footer.php"; ?>

</body>

</html>