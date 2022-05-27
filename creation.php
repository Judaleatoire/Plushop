<?php 
    include 'php/fonction_Compte.php';
    if(isset($_POST['submit'])){
        
        $user = array();//creer les donnees sur le nouvel utilisateur
        $user['login'] = $_POST['Login'];
        $user['password'] = $_POST['Password'];
        $user['pseudo'] = $_POST['Pseudo'];

        $error = 0;
        $conflogin =0;
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

        if(!(filter_var($user['login'], FILTER_VALIDATE_EMAIL))){//confirmer que la confirmation de mot de passe est la même
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


        if($error == 0){//verifie que ya pas d'erreur
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
    <form   method='POST'  action='creation.php' novalidate>
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
