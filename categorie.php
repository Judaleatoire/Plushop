<!DOCTYPE html>
<html>

<head lang="fr">
    <title>Plushop|Magasin spécialisé dans la vente de peluche</title>
    <meta charset="utf-8">
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

            $cat = $_GET['cat'];
            verif_isset_empty($cat, "page_erreur.php");

            $xml = open_file("data/categories.xml", "xml", "page_erreur.php");
            $csv = open_file("data/produits.csv", "csv", "page_erreur.php");

            $categorie = recherche_cat_xml($xml, $cat);
            if($categorie == -1) {
                header("location: page_erreur.php");
            }

            $temp = array();
            $temp2 = array();
            $produits = array();
            $i = 0;

            //VERIFIER SI LE PRODUIT A DU STOCK
            if($cat == "nou") {
                foreach($csv as $ligne) {
                    $temp = explode(",", $ligne);
                    if($temp[4] == 1) {
                        $temp2 = tabToKey($temp);
                        $temp2["pos"] = $i;
                        array_push($produits, $temp2);
                    }
                }
            } else if($cat == "sol") {
                foreach($csv as $ligne) {
                    $temp = explode(",", $ligne);
                    if($temp[5] != 0) {
                        $temp2 = tabToKey($temp);
                        $temp2["pos"] = $i;
                        array_push($produits, $temp2);
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
                        array_push($produits, $temp2);
                    }
                    $i++;
                }
            }

            $filtres = [
                "taille" => [],
                "couleur" => [],
                "marque" => []
            ];

            $filtres_keys = array_keys($filtres);

            foreach($produits as $produit) {
                if(!in_array($produit["taille"], $filtres["taille"])) $filtres["taille"][] = $produit["taille"];
                if(!in_array($produit["couleur"], $filtres["couleur"])) $filtres["couleur"][] = $produit["couleur"];
                if(!in_array($produit["marque"], $filtres["marque"])) $filtres["marque"][] = $produit["marque"];
                print_r($filtres["marque"]);
                echo($produit["marque"] . "<br>");
            }

            print_r($filtres);
            echo("<br><br>");
            print_r($filtres_keys);
                     
        ?>

        <div id='contenu'>
            <div id='filtres'>
                <button onclick='filtre("TAC")'>Ordre alphabétique</button>
                <button onclick='filtre("TAD")'>Ordre alphabétique inverse</button>
                <button onclick='filtre("TPC")'>Ordre croissant de prix</button>
                <button onclick='filtre("TPD")'>Ordre décroissant de prix</button>

                <?php
                    $i = 0;
                    foreach($filtres as $filtre) {
                        foreach($filtre as $element) {
                            echo("<input type='checkbox' name='" . $filtres_keys[$i] . "' id='" . $filtres_keys[$i] . "' value='" . $element . "'>");
                            echo($element . "<br>");
                        }
                        $i++;
                        echo("<br>");
                    }
                ?>
            </div>

            <div class="produits">
                <?php

                    // foreach($produits as $produit) {
                    //     foreach($produit as $clé => $valeur) {
                    //         echo("$clé => ");
                    //         if(is_array($valeur)) {
                    //             foreach($valeur as $val) {
                    //                 echo("$val ");
                    //             }
                    //         } else {
                    //             echo("$valeur");
                    //         }
                    //         echo("<br>");
                    //     }
                    //     echo("<br>");
                    // }

                    $i = 0;
                    foreach($produits as $produit) {
                        $temp = explode('-', $produit["ref"]);
                        echo("<a href='produit.php?pdt=" . $produit["ref"] . "' class='lien-produit' order='$i' data-ref='" . $produit["ref"] . "'>");
                        echo("<img src='img/$temp[0]/$temp[1]/$temp[2]/" . $produit["ref"] . "-1.jpg' alt='img/$temp[0]/$temp[1]/$temp[2]/" . $produit["ref"] . "-1'>");
                        // echo("<br><br>");
                        echo($produit["nom"]);
                        echo("</a>");
                        $i++;
                    }

                ?>
            </div>
        </div>
    </div>

    <a href=""></a>
    
    <?php include "footer.php"; ?>

    <script src="js/filtre.js?v=2"></script>

</body>

</html>