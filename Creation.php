<?php 
    if(isset($_POST['submit'])){
        $user = array();
        $user['login'] = $_POST['Login'];
        $user['password'] = $_POST['Password'];
        $user['pseudo'] = $_POST['Pseudo'];

        $js = file_get_contents('data/compte.json');

        $js = json_decode($js, true);
        $js[] = $user;
        $js = json_encode($js);

        file_put_contents('data/compte.json',$js);

        header("Location: index.php");
    }


?>



<head>
    <title>Création de compte Plushop</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/Identification.css">
  </head>

  <body>
		<a href="" ><img id="logo" src="img/Logo.png" alt="Logo de Plushop"></a>
        <form   method='POST'  action='Creation.php'>
            <div id="Title">Création de compte</div>
            <label for="Pseudo">Pseudonyme</label>
            <input type="text" name="Pseudo" id="Pseudo" class="textbar">
            <label for="Login">Email</label>
            <input type="email" name="Login" id="Login" class="textbar">
            <label for="Password">Mot de passe</label>
            <input type="password" name="Password" id="Password" class="textbar">
            <label for="ConfPassword">Confirmer mor de passe</label>
            <input type="password" name="ConfPassword" id="ConfPassword" class="textbar">
            <input type="submit" id="submit" name="submit" value="Creer compte">
        </form>
</body>
