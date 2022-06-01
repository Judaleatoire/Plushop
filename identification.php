<?php
    /**
     * Page de création de compte, recupère les informations utilisateur, les verifie en php 
     * et s'il n'y a pas d'erreurs les enregistre dans le fichier json.
     *  
     * @author Loic Briant
     * @author François Guillerm
    */
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plushop | Connexion</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/identification.css">
  </head>

  <body>

    <?php include "header.php"?>

    <?php

      include_once 'php/fonction_compte.php';
      include_once 'php/open_file.php';

      if(isset($_POST['submit'])){

        $user = array();//prend les donnees envoyé par l'utilisateur
        $user['login'] = $_POST['Login'];
        $user['password'] = $_POST['Password'];

        $js = open_file("data/compte.json", "json", "page_erreur.php");//cherche le contenue du fichier

        $js = json_decode($js, true);

        $i = recherche_email($user['login']);//cherche dans la base de donnée le numéro de l'utilisateur

        if(($i != -1)&&($user['password'] == $js[$i]['password'])){//verifie que l'email et le mdp sont correct

          $_SESSION['info_login'] = [];//met les variables des serveurs dans les sessions
          $_SESSION['info_login']['login'] = $js[$i]['login'];
          $_SESSION['info_login']['pseudo'] = $js[$i]['pseudo'];
          $_SESSION['info_login']['pos'] = $i;
          $_SESSION['info_login']['nom'] = $js[$i]['nom'];
          $_SESSION['info_login']['prenom'] = $js[$i]['prenom'];
          $_SESSION['info_login']['genre'] = $js[$i]['genre'];
          $_SESSION['info_login']['tel'] = $js[$i]['tel'];
          $_SESSION['info_login']['date_naissance'] = $js[$i]['date_naissance'];
          $_SESSION['info_login']['adresse'] = $js[$i]['adresse'];
          $_SESSION['info_login']['metier'] = $js[$i]['metier'];

          header("Location: index.php");//renvoie vers la page principale si l'utilisateur a réussi à se connecter
        }
      }
    ?>

    <div class="containerLog">
      <form id ="id" method='POST'  action='identification.php'>
        <h2>Connexion</h2>
        <input type="email" name="Login" id="Login" class="textbar" placeholder="Email">
        <input type="password" name="Password" id="Password" class="textbar" placeholder="Mot de passe">
        <input type="submit" id="submit" name="submit" value="Se connecter">
        <a href="creation.php" id="New_account" name="New_account"><span id="text_NewAccount">Créer un nouveau compte</span></a>
      </form>
    </div>

    <?php include "footer.php"?>

  </body>
</html>