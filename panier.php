<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head lang="fr">
    <title>Plushop | Panier</title>
    <meta charset="utf-8">
</head>

<body>
    <?php include "header.php"; ?>

    <?php
        require_once("./php/fonction-panier.php");
        echo '<?xml version="1.0" encoding="utf-8"?>';
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
    if (creerPanier())
    {
        $nbArticles=count($_SESSION['panier']['nom']);
        if ($nbArticles <= 0)
        echo "<tr><td>Votre panier est vide </ td></tr>";
        else
        {
            for ($i=0 ;$i < $nbArticles ; $i++)
            {
                echo "<tr>";
                echo "<td>".htmlspecialchars($_SESSION['panier']['nom'][$i])."</ td>";
                echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['quantite'][$i])."\"/></td>";
                echo "<td>".htmlspecialchars($_SESSION['panier']['prix'][$i])."€</td>";
                echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['nom'][$i]))."\">XX</a></td>";
                echo "</tr>";
            }

            echo "<tr><td colspan=\"2\"> </td>";
            echo "<td colspan=\"2\">";
            echo "Total : ".MontantGlobal(). "€";
            echo "</td></tr>";

            echo "<tr><td colspan=\"4\">";
            echo "<input type=\"submit\" value=\"Rafraichir\"/>";
            echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

            echo "</td></tr>";
        }
    }

    $erreur = false;

    $action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
    if($action !== null){
        if(!in_array($action,array('ajout', 'suppression', 'refresh')))
            $erreur=true;

            //récuperation des variables en POST ou GET
            $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
            $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
            $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '',$l);
   //On vérifie que $p soit un float
   $p = floatval($p);

   //On traite $q qui peut être un entier simple ou un tableau d'entiers
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajout($l,$q,$p);
         break;

      Case "suppression":
         supp($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['nom'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}
    ?>

    
    </table>
    </form>
    <form action="recu.php">
        <input type="submit" value="Payer">
    </form>
    <?php include "footer.php"; ?>
</body>

</html>