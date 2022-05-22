<!DOCTYPE html>
<html>

<head lang="fr">
    <title>Plushop|Magasin spécialisé dans la vente de peluche</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/produit.css?v=2">
</head>

<!-- FORMAT DU FICHIER PRODUIT : référence/nom/description/prix/nouveauté/solde/stock/age/taille/marque/autre -->

<body>

    <?php
        session_start();
        include "./php/chercher_produit.php";
        include "./php/test_page.php";

        //A RETRAVAILLER
        // test_page($_SERVER['QUERY_STRING']);
    ?>

    <?php include "header.php"; ?>

    <div class="flexbox-contenu">

        <?php include "menu_cote.php"; ?>

        <?php
            if(file_exists("./data/produits.csv")) {
                $csv = file("./data/produits.csv");
            } else {
                exit("Le fichier n'a pas pu être ouvert...");
            }
        
            $produit = array();

            $id = explode('=', $_SERVER['QUERY_STRING']);
            if(isset($id[1])) {
                $id = $id[1];
            } else {
                header("location: index.php");
            }
            $id_tab = explode('-', $id);

            $produit = chercher_produit($csv, $id);

            if($produit == -1) {
                header("location: index.php");
            }

            // foreach($produit as $clé => $valeur) {
            //     echo("$clé => ");
            //     if(is_array($valeur)) {
            //         foreach($valeur as $val) {
            //             echo("$val ");
            //         }
            //     } else {
            //         echo("$valeur");
            //     }
            //     echo("<br>");
            // }
        ?>

        <div id="produit">
            <section id="main">

                <!-- VERIFIER QUE LES IMAGES EXISTENT BIEN  -->
                <div id="choix">
                    <?php
                        $i = 1;

                        while(file_exists("./img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-$i.png")) {
                            echo("<div class='div-choix-image'><img src='./img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-$i.png' alt='./img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-$i' class='choix-image'></div>");
                            $i++;
                        }
                    ?>
                </div>

                <div id="image">
                    <?php echo("<img src='./img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-1.png' alt='./img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-1.png' id='image-principale'>"); ?>
                </div>

                <div id="mainInfo">
                    <div id="nom-produit"><?php echo($produit['nom']); ?></div>
                    <div id="prix"><?php echo($produit["prix"]); ?>€</div>
                    <div id="zone-ajout-panier">
                            <button id="modif-ajout">-</button>
                            <input type="text" name="quantite" id="quantite" value="1" readonly>
                            <button id="modif-ajout">+</button>
                            <br><br>
                            <?php echo ("<a href='panier.php?action=ajout&amp;l=" .$produit['nom']. "&amp;q=QUANTITEPRODUIT&amp;p=".$produit['prix']." onclick=\"window.open(this.href, '', 
'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=600, height=350'); return false;\">Ajouter au panier</a>"); ?>
                    </div>
                    <div id="description"><?php echo($produit['desc']); ?></div>
                </div>

            </section>

            <section id="suppInfo">
                <h2>Informations supplémentaires</h2>
                <div>
                    Marque : <?php echo($produit['marque']); ?><br>
                    Taille : <?php echo($produit['taille']); ?><br>
                    Age : <?php echo($produit['age']); ?><br>
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