<?php
  include 'php/Fonction_Compte.php';


  if(isset($_POST['submit'])){
    $user = array();//prend les donnees envoyé par l'utilisateur
    $user['login'] = $_POST['Login'];
    $user['password'] = $_POST['Password'];

    $js = file_get_contents('data/compte.json');//cherche le contenue du fichier

    $js = json_decode($js, true);

    if(($i = recherche_email($user['login']) != -1)&&($user['password'] == $js[$i]['password'])){//verifie que l'email et le mdp sont correct
      session_start();
      $_SESSION['login'] = $js[$i]['login'];
      $_SESSION['pseudo'] = $js[$i]['pseudo'];
      $_SESSION['emplacemnt'] = $i;
    }   
}

?>

<head>
    <title>Connexion Plushop</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/Identification.css">
  </head>

  <body>
		<a href="index.php" ><img id="logo" src="img/Logo.png" alt="Logo de Plushop"></a>
        <form    method='POST'  action='Identification.php'>
            <div id="Title">Connexion</div>
            <input type="email" name="Login" id="Login" class="textbar" placeholder="Email">
            <input type="password" name="Password" id="Password" class="textbar" placeholder="Mot de passe">
            <a id="Forget_Password" href="">Mot de passe oublié</a>
            <input type="checkbox" name="remember" id="remember"><label for="remember" id="text_remember">Se souvenir de moi</label>
            <input type="submit" id="submit" name="submit" value="Se connecter">
            <a href="Creation.php" id="New_account" name="New_account"><span id="text_NewAccount">Créer un nouveau compte</span></a>
        </form>
</body>

