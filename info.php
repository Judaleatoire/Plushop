<?php
    /**
     * Page qui affiche les informations complémentaires à remplir par l'utilisateur avant l'obtention du reçu
     * Les informations sont envoyées à info.js pour vérification.
     * 
     * @author Alexis Tourrenc--Lecerf
    */
?>
<!DOCTYPE html>
<html>
    <head lang="fr">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plushop | Panier</title>
        <link rel="stylesheet" href="./css/style.css?v=2">
        <script src="./js/info.js"></script>
    </head>

    <body>
        <?php include_once 'header.php' ?>
        <div class='container'>

        <?php

            //Nous avions commencé à mettre en place le système permettant de bloquer le passage d'une page à une autre sans passer par certaines
            //Nous n'avons cependant pas eu le temps de le finir
            // if($_SESSION['cart_state'] != "0" || !isset($_SESSION['cart_state'])) {
            //     header("Location: panier.php");
            //     exit();
            // }
            // else $_SESSION['cart_state'] = "0"; // sinon on reste

            //si le panier est vide on renvoit au panier.
            if ((!isset($_SESSION['panier']))|| (empty($_SESSION['panier']))){
                header("Location: panier.php");
            }
            else{ 
                if (!isset($_SESSION['info_login'])){ // si l'utilisateur n'est pas connecté on renvoit à la connexion.
                    header("Location: identification.php");
                    exit();
                }
            }
                $errs = array();
                if (isset($_POST['submit'])){  // si le formulaire est envoyé
                    $_SESSION['cart_state'] = "1";
                    if (strlen($_POST["submit"]) > 0) { // si le formulaire n'est pas vide
                    
                        if (count($errs) == 0) { //s'il n'y a pas d'erreurs les informations sont stocvkées dans la session et envoit au reçu.
                            $_SESSION ['informations'] = ['nom' => $_POST['nom'], 'prenom' => $_POST['pre'], 'mail' => $_POST['mail'], 'adresse' => $_POST['add'],'ville' => $_POST['ville'], 'code' => $_POST['code'], 'tel' => $_POST['tel']];
                            header("Location: recu.php");
                            exit();
                        }
                    }
                }

            // Si des erreurs ont été trouvée, les afficher sous forme de liste
            if (count($errs) > 0) {
                echo "<ul>";
                foreach ($errs as $champEnErreur => $erreursDuChamp) {
                    foreach ($erreursDuChamp as $erreur) {
                        echo "<li>".$erreur."</li>";
                    }
                }
                echo "</ul>";
            }

            //Nous avions commencé à mettre en place le système permettant de bloquer le passage d'une page à une autre sans passer par certaines
            //Nous n'avons cependant pas eu le temps de le finir
            // if(isset($_POST['submit'])) {
            //     $_SESSION['cart_state'] = "1";
            //     header('Location: recu.php');
            // }

        ?>

        <div class="forms">
        <h2>Informations personnelles</h2>
        <div>
            <form method="post" onsubmit="return verifier()">
            <label>Nom<br><input type="text" name="nom" placeholder="Entrer votre nom" id="last_name" class="textbar3"></label><br>
            <label>Prénom <br><input type="text" name="pre" placeholder="Entrer votre prénom" id="first_name" class="textbar3"></label><br>
            <label>Adresse <br><input type="text" name="add" placeholder="Entrer votre adresse" id="adresse" class="textbar3"></label><br>
            <label>Ville <br><input type="text" name="ville" placeholder="Entrer votre ville" id="ville" class="textbar3"></label><br>
            <label>Code postal <br><input type="text" name="code" placeholder="Entrer votre code postal" id="code" class="textbar3"></label><br>
            <label>Adresse mail <br><input type="text" name="mail" placeholder="Entrer votre email" id="email" class="textbar3"></label><br>
            <label>Confirmer l'adresse mail <br><input type="text" name="c_mail" placeholder="Entrer votre email" id="confirm_email" class="textbar3"></label><br>
            <label>Numéro de téléphone <br><input type="text" name="tel" placeholder="Entrer votre email" id="cell" class="textbar2"></label><br><br>
            <button type="button"  id="submit3" onclick="window.location.href = 'panier.php';">Revenir au Panier</button><br>
            <input type="submit" name="submit" value="Payer" id="submit2">
        </form> 
        </div>
        </div>
            </div>
        <?php include_once 'footer.php' ?>
    </body>

</html>