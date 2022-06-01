<?php
    /** 
     * Page panier
     * 
     * Cette page affiche le panier avec tous les produits, les quantités correspondantes, leur prix et s'il sont en solde leur nouveau prix .
     * 
     * @author     Alexis TOURRENC--LECERF
     * @author     François Guillerm
     * @author     Amandine Chantôme
    */
?>
<!DOCTYPE html>
<html>
<head lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plushop | Panier</title>
    <link rel="stylesheet" href="./css/style.css?v=2">
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container">
    <?php
        require_once("php/fonction_panier.php");
        include_once ("php/fonction_stock.php");

        $erreur = false; // il n'y a pas d'erreur
        $action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ; // on récupère l'action que l'on souhaite faire en POST ou en GET

        if($action !== null){ // s'il y a une action à faire
            if(!in_array($action, array('ajout', 'suppression', 'refresh', 'suppall'))){ // si l'action n'est pas dans le tableau ['ajout', 'suppression', 'refresh', 'suppall'}]
                $erreur = true; //il y a une erreur
            }
            //récuperation des variables en POST ou GET
            
            $l = (isset($_POST['nom'])? $_POST['nom']:  (isset($_GET['nom'])? $_GET['nom']:null )); // récuperation du nom en POST ou GET
            $p = (isset($_POST['prix'])? $_POST['prix']:  (isset($_GET['prix'])? $_GET['prix']:null )); // récuperation du prix en POST ou GET
            $s = (isset($_POST['solde'])? $_POST['solde']:  (isset($_GET['solde'])? $_GET['solde']:null )); // récuperation pourcentage de solde en POST ou GET
            $q = (isset($_POST['quantite'])? $_POST['quantite']:  (isset($_GET['quantite'])? $_GET['quantite']:null )); //récuperation de la quantite de produit en POST ou GET
            
            
            $l = preg_replace('#\v#', '',$l); // Suppression des espaces verticaux (retour a la ligne)
            $p = floatval($p); // on récupère le prix en variable réelle
            if (isset($_SESSION['panier']) && (!empty($_SESSION['panier']))){
                foreach ($_SESSION['panier'] as $element){ // on parcours la session en position panier
                    $stock = recherche_stock($l); // on recherche le stock dans le fichier csv du produit correspondant au nom
                    if (($l == $element['nom']) && ($stock-intval($q)>= 0)){ // si on a trouvé l'élément où l'on modifie la quantité et que le stock est suffisant
                        $qa = intval($q); // la quantité à modifier est une valeur entière 
                    }else{
                        while ($stock-intval($q) < 0){ // tant que la quantité est supérieur au stock (tantqu'il n'y pas assez de stock)
                            $q--; // on décrémente la quantité 
                        }
                        $qa = intval($q); // la nouvelle quantité à modifier est une valeur entière 
                    }
                }
            }else{
                $stock = recherche_stock($l); // on recherche le stock dans le fichier csv du produit correspondant au nom
                if ($stock-intval($q)>= 0){// si on a trouvé l'élément où l'on modifie la quantité et que le stock est suffisant
                    $qa = intval($q); // la quantité à modifier est une valeur entière 
                }else{
                    while ($stock-intval($q) < 0){ // tant que la quantité est supérieur au stock (tantqu'il n'y pas assez de stock)
                        $q--; // on décrémente la quantité 
                    }
                    $qa = intval($q); // la nouvelle quantité à modifier est une valeur entière
                }
            }
            
        }
    
        if (!$erreur){ // s'il n'y a pas d'erreur d'action
            switch($action){ // selon l'action
                Case "ajout": // on ajoute dans le panier
                    ajout($l,$qa,$s,$p); 
                    header("Location: panier.php"); // on appelle panier.php pour éviter de nouvelle requête de formulaire
                    break;

                Case "suppression": // on supprime un élément dans le panier 
                    supp($l);
                    header("Location: panier.php"); // on appelle panier.php pour éviter de nouvelle requête de formulaire
                    break;

                Case "refresh" : // on rafraichit la page pour un élément du panier
                    $j = 0;
                    modifierQTeArticle($l, round($qa)); // on modifie la quantité d'un article 
                    header("Location: panier.php"); // on appelle panier.php pour éviter de nouvelle requête de formulaire
                    break;
                Case "suppall" : // on supprime tout le panier
                    supprimePanier();
                    header("Location: panier.php"); // on appelle panier.php pour éviter de nouvelle requête de formulaire
                    break;
                Default: // on sort du switch
                    break;
            }
        }

        //Nous avions commencé à mettre en place le système permettant de bloquer le passage d'une page à une autre sans passer par certaines
        //Nous n'avons cependant pas eu le temps de le finir
        // if(isset($_POST['submit'])) {
        //     $_SESSION['cart_state'] = "0";
        //     header('Location: info.php');
        // }

    ?>
        <div class="panier">
        <form method="post" action="panier.php"> 
        <table style="width: 600px">
            <tr>
                <td colspan="4">Votre panier</td>
            </tr>
            <tr>
                <td></td>
                <td>Nom</td>
                <td>Quantité</td>
                <td>Prix Unitaire</td>
                <td>Solde</td>
                <td>Action</td>
            </tr>


        <?php
            if (creerPanier()) { // Si le panier a bien été créé
                $nbArticles = count($_SESSION['panier']); // On compte le nombre d'article dans le panier
                if ($nbArticles <= 0) { // S'il n'y a pas d'article dans le panier
                    echo "<tr><td>Votre panier est vide </ td></tr>";
                
                    echo"</table>";
                    echo"</form>";
                }else{ // Sinon
                    foreach ($_SESSION['panier'] as $element){ // Pour toutes les variables de session en position panier
                        if (is_array($element)){ // si element est un tableau
                            echo "<tr>";
                            echo "<td><input type=\"hidden\" name=\"nom\" value=\"".htmlspecialchars($element['nom'])."\"/></ td>"; // on créé un input hidden qui servira au bouton refresh à récupérer le nom
                            echo "<td>".htmlspecialchars($element['nom'])."</ td>"; // on affiche le nom du produit
                            echo "<td><input type=\"text\" size=\"4\" name=\"quantite\" value=\"".htmlspecialchars($element['quantite'])."\"/></td>"; // on affiche la quantité qui est modifiable à tout instant
                            echo "<td>".htmlspecialchars($element['prix'])."€</td>"; // on affiche le prix prix unitaire du produit
                            if($element['solde'] != 0) echo "<td>-".htmlspecialchars($element['solde'])."% " . round(htmlspecialchars($element['prix']) * (1-htmlspecialchars($element['solde'])/100), 2) . "€</td>"; // on affiche d'abord la solde puis le nouveau prix en fonction de la solde
                            else echo("<td>&oslash;</td>"); // sinon on affiche l'ensemble vide
                            echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&nom=".rawurlencode($element['nom']))."&prix=PRIX&quantite=QUANTITE\">Supprimer</a></td>"; // on appelle panier avec en GET l'action suppression et le nom du produit à supprimer
                            echo "<td><input type=\"submit\" name=\"action\" value=\"refresh\"></td>"; // on affiche un bouton qui permettera de raifraichir la page s'il on change la quantité 
                            echo "</tr>";
                        }
                        
                    }

                    echo "<tr><td colspan=\"2\"> </td>";
                    echo "<td colspan=\"2\">";
                    echo "Total HT: ".MontantGlobal(). "€"; // on affiche le montant hors taxe
                    echo "</td></tr>";

                    echo "<tr><td colspan=\"2\"> </td>";
                    echo "<td colspan=\"2\">";
                    echo "Total TTC: ".MontantGlobalTVA(). "€"; // on affiche le montant avec la TVA
                    echo "</td></tr>";

                    echo "<tr><td colspan=\"4\">";
                    echo "<button type=\"button\" onclick=\"window.location.href = 'panier.php?action=suppall';\">Tout supprimer</button>"; // on affiche un bouton permettant de supprimer l'entièreté du panier
                    echo "</td></tr>";
                    echo"</table>";
                    echo"</form>";
                    echo "<form method=\"post\"action=\"info.php\">"; // On crée un nouveau formulaire pour pouvoir payer
                    echo "<input type='submit' value=\"Payer\">"; // on affiche le bouton permettant de payer
                    echo "</form>" ;           
                }
            }
        ?>

        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>