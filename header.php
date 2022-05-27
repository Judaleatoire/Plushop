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

                    $xml = open_file("data/categories.xml", "xml", "page_erreur.php");

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
    <a href="identification.php"><i class="las la-user"></i>Connexion</a>
        <?php 
        if(isset($_SESSION['pseudo'])){ // echo can work too kekw
            // printf("%s",$_SESSION['pseudo']);
            echo($_SESSION['pseudo']);
        }
        ?>
        <a href="panier.php">
        <i class="las la-shopping-cart"></i>
        </a>
        
    </div>
    <?php include "menu_cote.php"; ?>
</header>