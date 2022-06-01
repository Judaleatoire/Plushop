<?php
    /**
     * Page affichant un reçu de commande, résumant toutes les informations de la commande
     * 
     * @author Alexis TOURRENC--LECERF
    */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plushop | Reçu</title>
    <link rel="stylesheet" href="./css/style.css?v=2">
    <link rel="stylesheet" href="./css/recu.css?v=2">
</head>

<body>

    <?php
        include "header.php";

        //Nous avions commencé à mettre en place le système permettant de bloquer le passage d'une page à une autre sans passer par certaines
        //Nous n'avons cependant pas eu le temps de le finir
        // if($_SESSION['cart_state'] == "1" || !isset($_SESSION['cart_state'])) {
        //     header("Location: panier.php");
        //     exit();
        // }
        // else $_SESSION['cart_state'] = "0";

        include_once ("php/fonction_panier.php");
        require_once ("php/fonction_stock.php");
        echo("<div class='container'>");
        
        if (!isset($_SESSION['info_login'])){
            header("Location: identification.php");
            exit();
        }else{
            if (isset($_SESSION['panier'])){
                echo ('<style>
                table,
                td {
                    border: 1px solid #333;
                }
                </style>');
                echo ('<table> 
                <tr>
                    <td colspan="2">Récapitulatif des informations</td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td colspan="2">'.$_SESSION['informations']['nom'].'</td>
                </tr>
                <tr>
                    <td>Prénom</td>
                    <td colspan="2">'.$_SESSION['informations']['prenom'].'</td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td colspan="2">'.$_SESSION['informations']['mail'].'</td>
                </tr>
                <tr>
                <td>Adresse de facturation</td>
                    <td colspan="2">'.$_SESSION['informations']['adresse'].'</td>
                </tr>
                <tr>
                    <td>Ville</td>
                    <td colspan="2">'.$_SESSION['informations']['ville'].'</td>
                </tr>
                <tr>
                    <td>Code postal</td>
                    <td colspan="2">'.$_SESSION['informations']['code'].'</td>
                </tr>
                <tr>
                    <td>Numéro de téléphone</td>
                    <td colspan="2">'.$_SESSION['informations']['tel'].'</td>
                </tr>
                <tr>
                    <td colspan="3">Votre reçu</td>
                </tr>
                <tr>
                    <td>Nom</td>
                    <td>Quantité</td>
                    <td>Prix Unitaire</td>
                </tr>');
                foreach($_SESSION['panier'] as $element) {
                    if (is_array($element)){
                        echo "<tr>";
                        echo "<td>".htmlspecialchars($element['nom'])."</ td>";
                        echo "<td>".htmlspecialchars($element['quantite'])."</td>";
                        echo "<td>".htmlspecialchars($element['prix'])."€</td>";
                        echo "</tr>";
                        actualisation_stock($element['nom'], $element['quantite']);
                    }
                }
                echo "<tr><td colspan=\"2\"> </td>";
                echo "<td colspan=\"2\">";
                echo "Total : ".MontantGlobal(). "€";
                echo "</td></tr>";
                echo "<tr><td colspan=\"2\"> </td>";
                echo "<td colspan=\"2\">";
                echo "Total TTC: ".MontantGlobalTVA(). "€";
                echo "</td></tr>";
                echo ('</table>');
                supprimePanier();
            }else{
                header("Location: panier.php");
            }  
        }
        echo("</div>");
        include "footer.php";
    ?>
</body>
</html>

