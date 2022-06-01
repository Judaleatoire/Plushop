<?php/**
     * Page d'erreur qui s'affiche lorsque qu'une page rencontre une erreur a l'affichage.
     * 
     * @author Amandine Chantome
    */
?>

<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plushop|Magasin spécialisé dans la vente de peluche</title>

    <link rel="stylesheet" href="css/style.css?v=2">
    <link rel="stylesheet" href="css/error.css?v=2">
</head>

<body>
    <?php include "header.php"; ?>

    <div class="container">
    <div class="erreur">
    <img src="img/error404.png" alt="error 404" id="error">
    <h2>Une erreur est survenue, page introuvable !</h2>
    </div>

    </div>

    <?php include "footer.php"; ?>

</body>
</html>