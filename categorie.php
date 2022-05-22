<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head lang="fr">
    <title>Plushop|Magasin spécialisé dans la vente de peluche</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/categorie.css?v=2">
</head>

<body>

    <?php
        include "./php/recherche_cat_xml.php";
        include "./php/tabToKey.php";
    ?>

    <?php include "header.php"; ?>

    <div class="flexbox-contenu">

        <?php include "menu_cote.php"; ?>

        <?php
            $cat = explode('=', $_SERVER['QUERY_STRING'])[1];
            if(!isset($cat[1]) || empty($cat[1])) {
                header("location: index.php");
            }

            if(file_exists("./data/categories.xml")) {
                $xml = simplexml_load_file("./data/categories.xml");
            } else {
                exit("Le fichier n'a pas pu être ouvert...");
            }
            
            if(file_exists("./data/produits.csv")) {
                $csv = file("./data/produits.csv");
            } else {
                exit("Le fichier n'a pas pu être ouvert...");
            }

            $categorie = recherche_cat_xml($xml, $cat);
            if($categorie == -1) {
                header("location: index.php");
            }
                     
        ?>

        <div id='contenu'>
            <div id='filtres'>
                <button onclick='tri()'>TEST</button>
            </div>

            <div class="produits">
                <?php

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
                        echo("<a href='produit.php?pdt=" . $produit["ref"] . "' class='lien-produit' order='$i'>");
                        echo("<img src='./img/$temp[0]/$temp[1]/$temp[2]/" . $produit["ref"] . "-1.png' alt='./img/$temp[0]/$temp[1]/$temp[2]/" . $produit["ref"] . "-1'>");
                        echo("<br><br>");
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

    <script src="./js/tri.js?v=2"></script>

</body>

</html>