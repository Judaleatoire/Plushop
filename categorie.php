<?php
    /**
     * Page qui affiche les produits lié à la catégorie ou la sosu catégorie choisie pas l'utilisateur.
     * Affiche également les possibilités de trie.
     * Accessible depuis n'importe quelle page du site.
     * 
     * 
     * @author François Guillerm
     * @author Amandine Chantome
     * @author Alexis Tourrenc--Lecerf
    */
?>

<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plushop | Catégorie</title>

    <link rel="stylesheet" href="css/style.css?v=2">
    <link rel="stylesheet" href="css/categorie.css?v=2">
</head>

<body>

    <?php
        include_once "php/recherche_cat_xml.php";
        include_once "php/tabToKey.php";
        include_once "php/verif_isset_empty.php";
        include_once "php/open_file.php";
    ?>

    <?php include "header.php"; ?>

    <div class="container">

        <?php

            //On récupère la catégorie dans le lien de la page et on vérifie sa validité
            $cat = $_GET['cat'];
            verif_isset_empty($cat, "page_erreur.php");

            //On ouvre les fichiers XML et CSV
            $xml = open_file("data/categories.xml", "xml", "page_erreur.php");
            $csv = open_file("data/produits.csv", "csv", "page_erreur.php");

            //On cherche la catégorie à afficher dans le fichier XML
            $categorie = recherche_cat_xml($xml, $cat);
            if($categorie == -1) {
                header("location: page_erreur.php");
            }

            $temp = array();
            $temp2 = array();
            $produits = array();
            $ref_produits = array();
            $i = 0;

            //En fonction de la catégorie, et particulièrement si on se situe dans la catégorie "Nouveauté" ou "Soldes", on ajoute les produits correspondants
            if($cat == "nou") {
                //On parcoure le fichier ligne par ligne
                foreach($csv as $ligne) {
                    $temp = explode(",", $ligne);
                    //Si le produit où on se situe correspond à la catégorie, on l'ajoute à la liste des produits qui seront ensuite affichés
                    if($temp[4] == 1) {
                        $temp2 = tabToKey($temp);
                        $temp2["pos"] = $i;
                        //On vérifie, au cas où, que le produit n'est pas déjà présent dans la liste
                        if(!in_array($temp2['ref'], $ref_produits)) {
                            array_push($ref_produits, $temp2['ref']);
                            array_push($produits, $temp2);
                        }
                    }
                }
            } 
            //Le fonctionnement est ensuite le même pour les autres catégories
            else if($cat == "sol") {
                foreach($csv as $ligne) {
                    $temp = explode(",", $ligne);
                    if($temp[5] != 0) {
                        $temp2 = tabToKey($temp);
                        $temp2["pos"] = $i;
                        if(!in_array($temp2['ref'], $ref_produits)) {
                            array_push($ref_produits, $temp2['ref']);
                            array_push($produits, $temp2);
                        }
                    }
                }
            } else {
                foreach($csv as $ligne) {
                    $temp = explode(",", $ligne);
                    $temp2 = explode('-', $temp[0]);
                    $temp2 = $temp2[0] . '-' . $temp2[1];
                    
                    if($cat == $temp2 || $cat == explode('-', $temp2)[0]) {
                        $temp2 = tabToKey($temp);
                        $temp2["pos"] = $i;
                        if(!in_array($temp2['ref'], $ref_produits)) {
                            array_push($ref_produits, $temp2['ref']);
                            array_push($produits, $temp2);
                        }
                    }
                    $i++;
                }
            }

            //Nous avions commencé à élaborer un système de filtres pour les pages catégories mais nous n'avons pas pu le finir pas manque de temps
            //Nous avons tout de même décidé de laisser ce que nous avions commencé

            // $filtres = [
            //     "taille" => [],
            //     "couleur" => [],
            //     "marque" => []
            // ];

            // $filtres_keys = array_keys($filtres);

            // foreach($produits as $produit) {
            //     if(!in_array($produit["taille"], $filtres["taille"])) $filtres["taille"][] = $produit["taille"];
            //     if(!in_array($produit["couleur"], $filtres["couleur"])) $filtres["couleur"][] = $produit["couleur"];
            //     if(!in_array($produit["marque"], $filtres["marque"])) $filtres["marque"][] = $produit["marque"];
            //     print_r($filtres["marque"]);
            //     echo($produit["marque"] . "<br>");
            // }
                     
        ?>

        <div id='contenu'>
            <div id='filtres'> <!-- boutons de trie et execute filtre.js -->
                <button onclick='filtre("TAC")'><i class="las la-sort-alpha-down"></i>Ordre alphabétique</button>
                <button onclick='filtre("TAD")'><i class="las la-sort-alpha-down-alt"></i>Ordre alphabétique inverse</button>
                <button onclick='filtre("TPC")'><i class="las la-sort-numeric-down"></i>Ordre croissant de prix</button>
                <button onclick='filtre("TPD")'><i class="las la-sort-numeric-down-alt"></i>Ordre décroissant de prix</button>
                <button onclick='afficher_stock()' id="btn_stock"><i class="las la-box"></i> Cacher le stock</button>

            </div>

            <div class="produits">
                <?php

                    //On affiche chaque produit correspondant à la catégorie
                    //On fait en sorte d'afficher une image du produit et certaines informations qui lui sont associés
                    foreach($produits as $produit) { 
                        if(intval($produit['stock']) > 0) { //s'il y a du stock
                            $temp = explode('-', $produit["ref"]); 
                            echo("<a href='produit.php?pdt=" . $produit["ref"] . "' class='lien-produit' order='$i' data-ref='" . $produit["ref"] . "'>");
                            echo("<img src='img/$temp[0]/$temp[1]/$temp[2]/" . $produit["ref"] . "-1.jpg' alt='img/$temp[0]/$temp[1]/$temp[2]/" . $produit["ref"] . "-1'>");
                            
                            echo("<div class='desc'>");
                            echo("<div class='descnp'>");
                            echo("<div class='nom-produit'>" . $produit['nom'] . "</div>");

                            if(intval($produit['solde']) != 0){ // si soldé
                                $nv_prix = $produit['prix'] * (1-($produit['solde']/100)); //calcul du nouveau prix
                                echo("<div class='ancien-prix-produit'>" . $produit['prix'] . "€</div>");
                                echo("</div>"); 
                                echo("<div class='nv_prix'>" ."<i class='solde'>-". $produit['solde'] ."%</i>" .  round($nv_prix, 2)  . "€</div>");  //nouveau prix arrondis
                            } 
                            else{ //sans solde 
                                echo("<div class='prix-produit'>" . $produit['prix'] . "€</div>");
                                echo("</div>");  
                            }

                            echo("<div class='stock-produit'>" . $produit['stock'] . " unités</div>"); 
                            echo("</div>");
                            echo("</a>");
                        }                        
                    }
                ?>
            </div>
        </div>
    </div>

    
    <?php include "footer.php"; ?>

    <script src="js/filtre.js?v=2"></script>
    <script src="js/afficher_stock.js?v=2"></script>


</body>

</html>