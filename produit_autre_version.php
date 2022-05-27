<!DOCTYPE html>
<html>

<head lang="fr">
    <title>Plushop|Magasin spécialisé dans la vente de peluche</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>

<!-- FORMAT DU FICHIER PRODUIT : référence/nom/description/prix/nouveauté/solde/stock/taille/marque/autre -->

<body>

    <?php
        include_once "php/chercher_produit.php";
        include_once "php/test_page.php";
        include_once "php/verif_isset_empty.php";
        include_once "php/open_file.php";

        //A RETRAVAILLER
        // test_page($_SERVER['QUERY_STRING']);
    ?>

    <?php include "header.php"; ?>

    <div class="container product">
    <div class="flexbox-contenu">

<?php
    $id = $_GET['pdt'];
    verif_isset_empty($id, "page_erreur.php");
    $id_tab = explode('-', $id);

    $csv = open_file("data/produits.csv", "csv", "page_erreur.php");

    $produit = chercher_produit($csv, $id);
    if($produit == -1) {
        header("location: page_erreur.php");
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
<section id="main" >

<!-- VERIFIER QUE LES IMAGES EXISTENT BIEN  -->
<div id="choix">
    <?php
        $i = 1;

        while(file_exists("img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-$i.jpg")) {
            echo("<div class='div-choix-image'><img src='img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-$i.jpg' alt='img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-$i' class='choix-image'></div>");
            $i++;
        }
    ?>
</div>

<div id="image">
    <?php echo("<img src='img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-1.jpg' alt='img/$id_tab[0]/$id_tab[1]/$id_tab[2]/$id-1.png' id='image-principale'>"); ?>
</div>

<div id="mainInfo">
    <div class="infos">
        Nom : <?php echo($produit['nom']); ?><br>
        Prix : <?php echo($produit['prix']); ?><br>
        <!-- <form action="panier.php" method="post">
            <input type="hidden" name="nom" value="<?php //echo($produit['nom']); ?>" readonly>
            <input type="hidden" name="prix" value="<?php //echo($produit['prix']); ?> €" readonly>
            <input type="hidden" name="action" value="ajout" readonly>
            <div id="zone-ajout-panier">
                    <button type="button" id="modif-ajout" readonly>-</button>
                    <input type="text" name="quantite" id="quantite" value="1" readonly>
                    <button type="button" id="modif-ajout" readonly>+</button>
                    <br><br>
            </div>
            <input type="submit" class="button-48" role="button" value="Ajouter au panier">
        </form> -->

        <button type="button" id="modif-ajout" readonly>-</button>
        <input type="text" name="quantite" id="quantite" value="1" readonly>
        <button type="button" id="modif-ajout" readonly>+</button>

        <button class="button-48" onclick="buy('<?= $produit['ref'] ?>', '<?= $produit['nom'] ?>', '<?= $produit['prix'] ?>', '<?= $produit['solde'] ?>')">Ajouter au panier</button>

        <div id="description"><?php echo($produit['desc']); ?></div>
    </div>
</div>

<script>
    function buy(ref, nom, prix, solde){
        let data=  new FormData();
        data.set("ref", ref);
        data.set("nom", nom);
        data.set("prix", prix);
        data.set("solde", solde);
        data.set("qt", document.getElementById("quantite").value);
        send(data);
    }

    function send(data){
        return fetch("php/cart.php", {
            method: 'POST',
            body: data
        }).then(x => {
            window.location.replace("panier.php");
        })
    }
</script>

</section>

    <section id="suppInfo">
        <h2>Informations supplémentaires</h2>
        <div>
            Marque : <?php echo($produit['marque']); ?><br>
            Dimensions : <?php echo($produit['dim']); ?><br>
            Taille : <?php echo($produit['taille']); ?><br>
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

    </div>
    <?php include "footer.php"; ?>

    <script src="./js/change_quantite.js?v=2"></script>
    <script src="./js/change_image_page_produit.js?v=2"></script>
    <!-- <script src="./js/zoom.js?v=2"></script> -->
    <script src="./js/cart.js?v=2"></script>

</body>

</html>