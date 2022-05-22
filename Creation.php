<?php 
    include 'php/Fonction_Compte.php';
    if(isset($_POST['submit'])){
        
        $user = array();//creer les donnees sur le nouvel utilisateur
        $user['login'] = $_POST['Login'];
        $user['conf_login'] = $_POST['Conf_Login'];
        $user['password'] = $_POST['Password'];
        $user['conf_password'] = $_POST['Conf_Password'];
        $user['pseudo'] = $_POST['Pseudo'];

        if(($user['login'] == $user['conf_login'])&&($user['password'] == $user['conf_password'])){//verifie que les email et les mdp sont les meme, rajouté fonction de verif
        write_new_user($user);
        header("Location: index.php");
        }
    }


?>



<head>
    <title>Création de compte Plushop</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/identification.css">
  </head>

  <body>
		<a href="index.php" ><img id="logo" src="img/Logo.png" alt="Logo de Plushop"></a>
        <form   method='POST'  action='creation.php'>
            <div id="Title">Création de compte</div>
            <label for="Pseudo">Pseudonyme</label>
            <input type="text" name="Pseudo" id="Pseudo" class="textbar">
            <label for="Login">Email</label>
            <input type="email" name="Login" id="Login" class="textbar">
            <label for="Conf_Login">Confirmer email</label>
            <input type="email" name="Conf_Login" id="Conf_Login" class="textbar">
            <label for="Password">Mot de passe</label>
            <input type="password" name="Password" id="Password" class="textbar">
            <label for="Conf_Password">Confirmer mot de passe</label>
            <input type="password" name="Conf_Password" id="ConfPassword" class="textbar">
            <input type="submit" id="submit" name="submit" value="Creer compte">
        </form>
</body>
