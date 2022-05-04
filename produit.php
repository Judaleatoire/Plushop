<!DOCTYPE html>
<html>

<head lang="fr">
    <title>Plushop|Magasin spécialisé dans la vente de peluche</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/produit.css?v=2">
</head>

<body>

    <?php include "header.php"; ?>

    <div class="flexbox-contenu">

        <?php include "menu_cote.php"; ?>

        <div id="produit">
            <section id="main">

                <div id="choix-img">
                    <img src="./img/monkey.jpg" alt="monkey">
                    <img src="./img/monkey.jpg" alt="monkey">
                    <img src="./img/monkey.jpg" alt="monkey">
                    <img src="./img/monkey.jpg" alt="monkey">
                </div>

                <div id="image">
                    <img src="./img/monkey.jpg" alt="monkey">
                </div>

                <div id="mainInfo">
                    <div id="nom-produit">NOM DU PRODUIT</div>
                    <div id="prix">PRIX</div>
                    <div id="zone-ajout-panier">
                        <button id="modif-ajout">-</button>
                        <input type="text" name="quantite" id="quantite" value="1" readonly>
                        <button id="modif-ajout">+</button>
                        <br><br>
                        <button id="ajout-panier">Ajouter au panier</button>
                    </div>
                    <div id="description">DESCRIPTION</div>
                </div>

            </section>

            <section id="suppInfo">
                <h2>Informations supplémentaires</h2>
                <div>
                    Marque : XXX<br>
                    Age : XXX<br>
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

</body>

</html>