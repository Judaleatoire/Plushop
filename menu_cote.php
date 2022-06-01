<?php/**
     * Menu sur le coté reprenant la navigation du header mais s'adaptant à la catégorie dans laquelle on se trouve.
     * 
     * @author François Guillerm
     * @author Amandine Chantome
    */
?>


<div id="menu-cote" class="piou">

    <ul>
        <li> 
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        </li>
        <li><a href="index.php">Acceuil</a></li>

        <?php
        
            include_once "php/verif_isset_empty.php";
            include_once "php/open_file.php";

            //On ouvre le fichier XML contenant les catégories
            $xml = open_file("data/categories.xml", "xml", "page_erreur.php");

            //On vérifie la catégorie dans laquelle on se situe pour faire un affichage personnalisé
            if(isset($_GET['cat'])) {
                $id = $_GET['cat'];
                verif_isset_empty($id, "page_erreur.php");
                $id = explode('-', $id)[0];
            } else {
                $id = "";
            }

            //On affiche les catégorie dans le menu
            foreach($xml->categorie as $categorie) {
                echo("<li><a id='$categorie->id' href='categorie.php?cat=$categorie->id#$categorie->id'>$categorie->nom</a>");
                //Si on se situe dans une catégorie produit, on affiche les sous-catégories de la catégorie correspondante
                if($categorie->id == $id) {
                    echo("<ul class='piou-sous'>");
                    foreach($categorie->sous_categorie as $sous_categorie) {
                        echo("<li><a href='categorie.php?cat=$categorie->id-$sous_categorie->id#$categorie->id'>$sous_categorie->nom</a>");
                    }
                    echo("</ul>");
                }
            }
        ?>

        <li><a href='contact.php'>Contact</a></li>
    </ul>
    
</div>