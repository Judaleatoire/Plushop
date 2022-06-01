<?php/**
     * Header importé sur chacunes des pages du site.
     * contient le logo, le menu de navigation et la connexion/deconnexion, le profil et le panier.
     * Lance la session de l'utilisateur.
     * 
     * 
     * @author François Guillerm
     * @author Amandine Chantome
     * @author Alexis Tourrenc--Lecerf
     * @author Loic Briant
     * @author Theotime Ruelle

    */
?>

<?php
    session_start();
?>


<header>
    <div id="gauche">
    <div id="logo">
    <a href="index.php"><img src="img/plushop_logo_2.png" alt="logo" id="chat"></a>
    </div>
        <span id="menu_open"><i class="las la-bars"></i></span>
    </div>
    <div id="navigation">
        <h1>PluShop</h1>

        <nav>
            <div class="seperator"></div>
            <ul id="menu">
                <li><a href="index.php">Accueil</a></li>

                <?php
        
                    include_once "php/open_file.php";
                    include_once "php/fonction_panier.php";

                    //On ouvre le fichier XML contenant les catégories
                    $xml = open_file("data/categories.xml", "xml", "page_erreur.php");

                    //On affiche toutes les catégories qui sont présentes dans le fichier XML
                    foreach($xml->categorie as $categorie) {
                        echo("<li><a href='categorie.php?cat=$categorie->id'>$categorie->nom</a>");
                        if(isset($categorie->sous_categorie)) {
                            echo("<ul class='sous'>");
                            foreach($categorie->sous_categorie as $sous_categorie) {
                                echo("<li><a href='categorie.php?cat=$categorie->id-$sous_categorie->id'>$sous_categorie->nom</a>");
                            }
                            echo("</ul>");
                        }
                        echo("</li>");
                    }
                ?>

                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </div>

    <div id="logpan">

        <?php
            //On affiche différentes informations si l'utilisateur est connecté ou non
            if(!isset($_SESSION['info_login']) || empty($_SESSION['info_login'])) {
                echo("<a href='identification.php'><i class='las la-key'></i></i>Connexion</a>");
            } else {
                echo("<a href='deconnexion.php'><i class='las la-lock-open'></i></i>Déconnexion</a>");
                echo("<a href='profil.php'><i class='las la-address-card'></i>Profil : " . $_SESSION['info_login']['pseudo'] . "</a>");
            }
        ?>

        <a href="panier.php"><i class="las la-shopping-cart"></i>Panier</a>
        <?php 
            //On affiche les informations liées au panier seulement s'il n'est pas vide
            if (isset($_SESSION['panier']) && (!empty($_SESSION['panier'])) ){
                $i = nombre_element();
                if ($i>1){
                    echo ($i." produits : <br>");
                }else{
                    echo ($i." produit :<br>");
                }
                echo (MontantGlobalTVA()."€");
            }
        ?>
        
    </div>

    <?php include "menu_cote.php"; ?>

</header>