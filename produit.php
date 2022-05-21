<!DOCTYPE html>
<html>

<head lang="fr">
    <title>Plushop|Magasin spécialisé dans la vente de peluche</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/produit.css?v=2">
</head>

<!-- FORMAT DU FICHIER PRODUIT : référence/nom/description/prix/nouveauté/solde/stock/age/taille/marque/autre -->

<body>

    <?php include "header.php"; ?>

    <?php

    // if(file_exists("./data/produits.csv")) {
    //     $csv = file("data/produits.csv");
    // } else {
    //     exit("Le fichier n'a pas pu être ouvert...");
    // }

    // $produits = array();

    // foreach($csv as $ligne) {
    //     $produits[] = explode(",", $ligne);
    // }

    // foreach($produits as $case) {
    //     echo("<ul>");
    //     foreach($case as $souscase) {
    //         echo("<li>$souscase</li>");
    //     }
    //     echo("</ul>");
    // }

    // $id = explode('=', $_SERVER['QUERY_STRING']);
    // if(isset($id[1])) {
    //     $id = $id[1];
    // }

    // echo($id);

    ?>

    <div class="flexbox-contenu">

        <?php include "menu_cote.php"; ?>

        <?php
            if(file_exists("./data/produits.csv")) {
                $csv = file("./data/produits.csv");
            } else {
                exit("Le fichier n'a pas pu être ouvert...");
            }
        
            $produits = array();
        
            foreach($csv as $ligne) {
                $produits[] = explode(",", $ligne);
            }

            $id = explode('=', $_SERVER['QUERY_STRING']);
            if(isset($id[1])) {
                $id = $id[1];
            }

            $position_produit = 0;
            while($produits[$position_produit][0] != $id) {
                $position_produit++;
            }
        ?>

        <div id="produit">
            <section id="main">

                <div id="choix-img">
                    <?php
                        $i = 1;

                        while(file_exists("./img/$id-$i.png")) {
                            echo("<img src='./img/$id-$i.png' alt='./img/$id-$i' id='choix-image'>");
                            $i++;
                        }
                    ?>
                </div>

                <div id="image">
                    <?php echo("<img src='./img/$id-1.png' alt='./img/$id-1' id='image-principale'>"); ?>
                    <div id="zoom" style="background: url('./img/<?php echo($id); ?>-1.png') no-repeat #FFF"></div>
                </div>

                <div id="mainInfo">
                    <div id="nom-produit"><?php echo($produits[$position_produit][1]); ?></div>
                    <div id="prix"><?php echo($produits[$position_produit][3]); ?>€</div>
                    <div id="zone-ajout-panier">
                        <button id="modif-ajout">-</button>
                        <input type="text" name="quantite" id="quantite" value="1" readonly>
                        <button id="modif-ajout">+</button>
                        <br><br>
                        <button id="ajout-panier">Ajouter au panier</button>
                    </div>
                    <div id="description"><?php echo($produits[$position_produit][2]); ?></div>
                </div>

            </section>

            <section id="suppInfo">
                <h2>Informations supplémentaires</h2>
                <div>
                    Marque : <?php echo($produits[$position_produit][9]); ?><br>
                    Taille : <?php echo($produits[$position_produit][8]); ?><br>
                    Age : <?php echo($produits[$position_produit][7]); ?><br>
                    Plus d'autres infos<br>
                </div>
            </section>

            <section id="sugg">
                <h2>Suggestions</h2>
                <div id="sugg-produits">
                    <img src="./img/monkey.jpg" alt="monkey">
                    <img src="./img/monkey.jpg" alt="monkey">
                    <img src="./img/monkey.jpg" alt="monkey">
                    <img src="./img/monkey.jpg" alt="monkey">
                    <img src="./img/monkey.jpg" alt="monkey">
                    <img src="./img/monkey.jpg" alt="monkey">
                </div>
            </section>
        </div>
    </div>
    
    <?php include "footer.php"; ?>

    <script src="./js/change_quantite.js?v=2"></script>
    <script src="./js/change_image_page_produit.js?v=2"></script>
    <script src="./js/zoom.js?v=2"></script>

</body>

</html>