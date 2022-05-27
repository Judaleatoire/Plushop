<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Plushop | Reçu</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/style.css?v=2">
</head>

<body>

    <?php
        include "header.php";

        include_once ("php/fonction-panier.php");
        require_once ("php/fonction-stock.php");
        echo ("<br><br><br><br><br><br><br><br><br><br><br><br>");
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'identification.php';
        if (!isset($_SESSION['login'])){
            header("Location: http://$host$uri/$extra");
            exit();
        }else{
            
            // foreach ($_SESSION['panier'] as $panier){
            //     echo ("<tr><td>" .$_SESSION['panier']['nom']."</td></tr>");
            //     session_destroy();
            // }
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
                exit("Un problème est survenu =(");
            }  
        }
        include "footer.php";
    ?>
</body>
</html>

