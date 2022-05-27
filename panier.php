<!DOCTYPE html>
<html>
<head lang="fr">
    <title>Plushop | Panier</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css?v=2">
</head>

<body>

    <?php include "header.php"; ?>
    <div class="container">
    <?php
        require_once("php/fonction_panier.php");

        $erreur = false;
        $action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;

        
        if($action !== null){
            if(!in_array($action, array('ajout', 'suppression', 'refresh')))
                $erreur=true;

            //récuperation des variables en POST ou GET
            $l = (isset($_POST['nom'])? $_POST['nom']:  (isset($_GET['nom'])? $_GET['nom']:null )) ;
            $p = (isset($_POST['prix'])? $_POST['prix']:  (isset($_GET['prix'])? $_GET['prix']:null )) ;
            $q = (isset($_POST['quantite'])? $_POST['quantite']:  (isset($_GET['quantite'])? $_GET['quantite']:null )) ;
            unset($_POST);

        //Suppression des espaces verticaux (retour a la ligne)
        $l = preg_replace('#\v#', '',$l); // <- comprend pas ? go filter var string
        $p = floatval($p);
        //On traite $q qui peut être un entier simple ou un tableau d'entiers
        if (isset($_SESSION['panier'])){
            $quantite = array();
            foreach ($_SESSION['panier'] as $chose){
                if (is_array($chose)){
                    $quantite[] = intval($q);
                }
            }
        }

    }

        if (!$erreur){
            switch($action){
                Case "ajout":
                    ajout($l,$q,$p);
                    header("Location: panier.php");
                    break;

                Case "suppression":
                    supp($l);
                    header("Location: panier.php");
                    break;

                Case "refresh" :
                    $i = 0;
                    foreach ($_SESSION['panier'] as $element){
                        modifierQTeArticle($element['nom'], round($quantite[$i]));
                        $i++;
                    }
                    header("Location: panier.php");
                    break;

                Default:
                    break;
            }
        }
    ?>
        <form method="post" action="panier.php">
        <table style="width: 400px">
            <tr>
                <td colspan="4">Votre panier</td>
            </tr>
            <tr>
                <td>Nom</td>
                <td>Quantité</td>
                <td>Prix Unitaire</td>
                <td>Action</td>
            </tr>


        <?php
            if (creerPanier()){
                $nbArticles=count($_SESSION['panier']);
                    if ($nbArticles <= 0)
                        echo "<tr><td>Votre panier est vide </ td></tr>";
                else{
                    foreach ($_SESSION['panier'] as $element){
                        if (is_array($element)){
                            echo "<tr>";
                            echo "<td>".htmlspecialchars($element['nom'])."</ td>";
                            echo "<td><input type=\"text\" size=\"4\" name=\"quantite\" value=\"".htmlspecialchars($element['quantite'])."\"/></td>";
                            echo "<td>".htmlspecialchars($element['prix'])."€</td>";
                            echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&nom=".rawurlencode($element['nom']))."&prix=PRIX&quantite=QUANTITE\">Supprimer</a></td>";
                            echo "</tr>";
                        }
                        
                    }

                    echo "<tr><td colspan=\"2\"> </td>";
                    echo "<td colspan=\"2\">";
                    echo "Total HT: ".MontantGlobal(). "€";
                    echo "</td></tr>";

                    echo "<tr><td colspan=\"2\"> </td>";
                    echo "<td colspan=\"2\">";
                    echo "Total TTC: ".MontantGlobalTVA(). "€";
                    echo "</td></tr>";

                    echo "<tr><td colspan=\"4\">";
                    echo "<button>Rafraichir</button>";
                    echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

                    echo "</td></tr>";
                }
            }
        ?>

        </table>
        </form>

        <form method="post"action="info.php">
            <input type='submit' value="Payer">
        </form>
    </div><br><br><br><br>
    <?php include "footer.php"; ?>
</body>

</html>