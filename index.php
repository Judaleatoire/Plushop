<?php/**
     * Cette page affiche l'accueil du site.
     * choisit les produits des catégories à afficher comme présentation.
     * Accessible depuis n'importe quelle page du site.
     * 
     * @author François Guillerm
     * @author Amandine Chantome
    */
?>

<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plushop|Magasin spécialisé dans la vente de peluche</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container">
        <div class="produits">
            
            <section>
                <div id="present"> 
                    <div class="image_acc"><img src="img/accueil.jpg" id="img_acc" alt="accueil"></div>
                    <div class="text_present">
                        <h2>"Offrez un cadeau qui en vaut la peine"</h2>
                        <p>
                            Vous cherchez le cadeau parfait qui saura faire plaisir à tous les membres de votre famille, à vos amis ou même à votre chien ?<br>
                            Plushop est là pour vous ! Que ce soit des peluches d'animaux, de personnages iconiques de la pop-culture ou même de la nourriture 
                            (oui oui, même des peluches de nourriture), vous saurez trouver votre plaisir parmis un catalogue varié en terme de prix, de marque et
                            de taille.<br>
                            N'hésitez plus et foncez acheter les meilleurs peluches du marché !
                        </p>
                    </div>
                </div>
            </section>

            <?php
                include_once "php/open_file.php";
                include_once "php/tabToKey.php";

                //On ouvre les fichiers XML et CSV
                $xml = open_file("data/categories.xml", "xml", "page_erreur.php");
                $csv = open_file("data/produits.csv", "csv", "page_erreur.php");

                //On définie les catégories que l'on veut afficher sur la page d'accueil
                $cat_acc = ["nou", "sol", "ani"];
                $nb_cat = count($cat_acc);

                $categories = [];
                $produits = [];
                $excludeProduct = []; //pour éviter répétition de produits
                foreach($cat_acc as $cat) {
                    $produits[$cat] = [];
                }
                //recupère info xml en fonction des catégories affichées 
                foreach($xml as $cat) {
                    if(in_array($cat->id, $cat_acc)) {  //si l'id où on se trouve correspond a l'id recherchée on la met dans le tableau $categories
                        $categories[strval($cat->id)] = $cat;
                    }
                    foreach($cat->sous_categorie as $sous_categorie) { 
                        $nom_cat = $cat->id . '-' . $sous_categorie->id;
                        if(in_array($nom_cat, $cat_acc)) {
                            $categories[strval($nom_cat)] = $sous_categorie;
                        }
                    }
                }

                $tmp = [];
                //On crée des listes pour les catégories à afficher sur la page
                //On fait en sorte d'éviter d'ajouter plusieurs fois le même produit
                foreach($csv as $ligne) {
                    $tmp = tabToKey(explode(',', $ligne));
                    $nom_cat = explode('-', $tmp["ref"])[0];
                    $nom_sous_cat = explode('-', $tmp["ref"])[0] . '-' . explode('-', $tmp["ref"])[1];

                    if(in_array($nom_cat, $cat_acc) && !in_array($tmp, $excludeProduct)) {
                        $produits[$nom_cat][] = $tmp;
                        $excludeProduct[] = $tmp;
                    } else if(in_array($nom_sous_cat, $cat_acc) && !in_array($tmp, $excludeProduct)) {
                        $produits[$nom_sous_cat][] = $tmp;
                        $excludeProduct[] = $tmp; 
                    }

                    if(in_array("nou", $cat_acc)) {
                        if($tmp["nouv"] == 1 && !in_array($tmp, $excludeProduct)) {
                            $produits["nou"][] = $tmp;
                            $excludeProduct[] = $tmp; 
                        }
                    }

                    if(in_array("sol", $cat_acc)) {
                        if($tmp["solde"] != 0 && !in_array($tmp, $excludeProduct)) {
                            $produits["sol"][] = $tmp;
                            $excludeProduct[] = $tmp; 
                        }
                    }
                }

                //On affiche alors les catégories que l'on veut avec 4 produits qui leur correspondent
                //On effectue un affichage stylisé permettant d'alterner la position du texte et des produits sur la page
                $i = 0;
                foreach($produits as $key => $cat) {
                    echo("<section class='container-produits-accueil'>");
                        if($i % 2 === 0){ //si c'est un nombre pair, permet de gerer l'affichage en alternance
                            echo("<div class='titre-cat'><h1>" . $categories[$key]->nom . "</h1></div>");
                        } else {
                            echo("<div class='titre-cat order-last'><h1>" . $categories[$key]->nom . "</h1></div>");
                        }
                        echo("<div class='box-produits'>");
                        for($j = 0; $j<4; $j++) { //affiche 4 produits
                            if(intval($produits[$key][$j]['stock']) != 0) { //si en stock
                                $temp = explode('-', $produits[$key][$j]["ref"]); //obtient differentes parties de la ref
                                $product = $produits[$key][$j]; 
                                $solde = intval($product['solde']);
                                $nv_prix = $product['prix'] * (1-($solde/100));
                                
                                echo("<a href='produit.php?pdt=" . $product["ref"] . "' class='lien-produit' order='$i' data-ref='" . $product["ref"] . "'>");
                                echo("<img src='img/$temp[0]/$temp[1]/$temp[2]/" . $product["ref"] . "-1.jpg' alt='img/$temp[0]/$temp[1]/$temp[2]/" . $product["ref"] . "-1'>");
                                echo("<div class='desc'>");
                                echo("<div class='descnp'>");
                                echo("<div class='nom-produit'>" . $product['nom'] . "</div>");
                                if($solde > 0){ //si soldé affichage du prix de base
                                    echo("<div class='ancien-prix-produit'>" . $product['prix'] . "€</div>");  //change la classe de la div

                                } else echo("<div class='prix-produit'>" . $product['prix'] . "€</div>"); 
                                echo("</div>"); 
                                if($solde > 0){ // si soldé affichage nouveau prix et solde
                                    echo("<div class='nv_prix'>" ."<i class='solde'>-". $product['solde'] ."%</i>" .  round($nv_prix, 2)  . "€</div>"); 
                                } 
                                echo("<div class='stock-produit'>" . $product['stock'] . " unités</div>"); //stock
                                echo("</div>");
                                echo("</a>");
                            }
                        }
                        echo("</div>");
                        
                    echo("</section>");
                    $i++;
                }

            ?>

        </div>

    </div>
    
    <?php include "footer.php"; ?>

</body>

</html>