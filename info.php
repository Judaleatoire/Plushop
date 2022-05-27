<!DOCTYPE html>
<html>
    <head lang="fr">
        <title>Plushop | Panier</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/style.css?v=2">
        <script src="./js/info.js"></script>
    </head>

    <body>
        <?php include_once 'header.php' ?>
        <div class='container'>

        <?php
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'identification.php';
            if (!isset($_SESSION['login'])){
                header("Location: http://$host$uri/$extra");
                exit();
            }else{
                if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])){
                    header("Location: http://$host$uri/panier.php");
                }
            } 
            $errs = array();
            if (isset($_POST['submit'])){
                if (strlen($_POST["submit"]) > 0) {
            
                    if (count($errs) == 0) {
                        $_SESSION ['informations'] = ['nom' => $_POST['nom'], 'prenom' => $_POST['pre'], 'mail' => $_POST['mail'], 'adresse' => $_POST['add'], 'tel' => $_POST['tel']];
                        header("Location: recu.php");
                        die();
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

        ?>
        <br><br>
        <h2>Informations personnelles</h2><br><br>
        <div>
            <form method="post" onsubmit="return verifier()">
            <label>Nom<br><input type="text" name="nom" placeholder="Entrer votre nom" id="last_name"></label><br>
            <label>Prénom <br><input type="text" name="pre" placeholder="Entrer votre prénom" id="first_name"></label><br>
            <label>Adresse <br><input type="text" name="add" placeholder="Entrer votre adresse" id="adresse"></label><br>
            <label>Adresse mail <br><input type="text" name="mail" placeholder="Entrer votre email" id="email"></label><br>
            <label>Confirmer l'adresse mail <br><input type="text" name="c_mail" placeholder="Entrer votre email" id="confirm_email"></label><br>
            <label>Numéro de téléphone <br><input type="text" name="tel" placeholder="Entrer votre email" id="cell"></label><br><br>
            <button type="button" onclick="window.location.href = 'panier.php';">Revenir au Panier</button><br>
            <input type="submit" name="submit" value="Payer">
        </form> 
        </div>
        </div>
    </body>
</html>