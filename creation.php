
<?php/**
     * Page de création de compte, recupère les informations utilisateur, les verifie en php 
     * et s'il n'y a pas d'erreurs les enregistre dans le fichier json.
     *  
     * @author Loic Briant
     * @author François Guillerm
    */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte Plushop</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php include "header.php"?>
   
<?php 
    include 'php/fonction_Compte.php';
    if(isset($_POST['submit'])){
        
        $user = array();//creer les donnees sur le nouvel utilisateur
        $user['login'] = $_POST['Login'];
        $user['password'] = $_POST['Password'];
        $user['pseudo'] = $_POST['Pseudo'];

        $error = 0;
        $conflogin = 0;
        $confmdp = 0;
        $email = 0;
        $pseudo = 0;

        if(!($user['login'] == $_POST['Conf_Login'])){//confirmer que la confirmation d'email est la même
            $error++;
            $conflogin = 1;
        }

        if(!($user['password'] == $_POST['Conf_Password'])){//confirmer que la confirmation de mot de passe est la même
            $error++;
            $confmdp = 1;
        }
        if((recherche_email($user['login'])) != -1){ // verifie si l'utilisateur existe deja
            $error++;
        }
        if(!(filter_var($user['login'], FILTER_VALIDATE_EMAIL))){//confirmer que l'email soit correct
            $error++;
            $email = 1;
        }
        
        if(!(filter_var($user['pseudo'],FILTER_DEFAULT))){//confirmer que le pseudo soit correct
            $error++;
            $pseudo = 1;
        }

        if(!(filter_var($user['password'],FILTER_DEFAULT))){//confimer que le mot de passe soit correct
            $error++;
            $pseudo = 1;
        }


        if($error == 0){//verifie qu'il n'y pas d'erreur et creer un nouveau compte dans le fichier json
            $user['nom'] = "";
            $user['prenom'] = "";
            $user['genre'] = "";
            $user['tel'] = "";
            $user['date_naissance'] = "";
            $user['adresse'] = "";
            $user['metier'] = "";
            write_new_user($user);
            header("Location: index.php");
        } else header("Location: creation.php");
    }


?>
    <div class="containerLog">
    <form  id="id" method='POST'  action='' novalidate>
        <h2>Création de compte</h2><br>
        <input type="text" name="Pseudo" id="Pseudo" class="textbar" placeholder="Pseudonyme">
        <input type="email" name="Login" id="Login" class="textbar" placeholder="Email">
        <input type="email" name="Conf_Login" id="Conf_Login" class="textbar" placeholder="Confirmation du mail">
        <input type="password" name="Password" id="Password" class="textbar" placeholder="Mot de passe">
        <input type="password" name="Conf_Password" id="ConfPassword" class="textbar" placeholder="Confirmation mot de passe">
        <input type="submit" id="submit" name="submit" value="Creer compte">
    </form>
</div>

    <?php include "footer.php"?>
</body>
</html>