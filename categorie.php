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

        <div class="produits">
            <?php

                $temp = array();
                $temp2 = array();
                $produits = array();
                $i = 0;

                foreach($csv as $ligne) {
                    $temp = explode(",", $ligne);
                    $temp2 = explode('-', $temp[0]);
                    $temp2 = $temp2[0] . '-' . $temp2[1];
                    
                    if($cat == $temp2 || $cat == explode('-', $temp2)[0]) {
                        $temp2 = array(
                            "ref" => $temp[0],
                            "nom" => $temp[1],
                            "desc" => $temp[2],
                            "prix" => $temp[3],
                            "nouv" => $temp[4],
                            "solde" => $temp[5],
                            "stock" => $temp[6],
                            "age" => $temp[7],
                            "taille" => $temp[8],
                            "marque" => $temp[9],
                            "pos" => $i
                        );
                        array_push($produits, $temp2);
                    }
                    $i++;
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

                foreach($produits as $produit) {
                    $temp = explode('-', $produit["ref"]);
                    echo("<div border='solid 3px black'>");
                    echo("<img src='./img/$temp[0]/$temp[1]/$temp[2]/" . $produit["ref"] . "-1.png' alt='./img/$temp[0]/$temp[1]/$temp[2]/" . $produit["ref"] . "-1'>");
                    echo("<br><br>");
                    echo($produit["nom"]);
                    echo("</div>");
                }

            ?>
        </div>
    </div>
    
    <?php include "footer.php"; ?>
</body>

</html>