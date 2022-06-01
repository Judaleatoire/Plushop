<?php/**
     * Page de demande de contact, récupère les informations de l'utilisateurs, les vérifie avec du html puis un fichier js.
     * Accessible depuis n'importe quelle page du site.
     * 
     * @author Théotime Ruelle
     * @author Amandine Chantome
    */
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plushop | Contact</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>

    
<body>
    <?php include "header.php"; ?>
    <div class="container">
    <div id="error"></div>
    <div class="forms">
        <h2>Demande de contact</h2>
        <form action="" method="post" id="form">

            <label for="dateC"> Date de contact</label><br>
            <input type="date" name="dateC" id="dateC" class="textbar2" placeholder="date de contact" min="<?php echo(Date('d-m-y')) ?>"> <br><br>

            <label for="nom">Nom</label><br>
            <input type="text" name="nom" id="nom" class="textbar2" placeholder="Nom" pattern="[a-zA-ZÀ-ÿ]{2,20}" required><br><br> 

            <label for="prenom">Prénom</label><br>
            <input type="text" name="prenom" id="prenom" class="textbar2" placeholder="Prénom" pattern="[a-zA-ZÀ-ÿ]{2,20}" required> <br><br>

            <label for="email">Email</label><br>
            <input type="email" name="email" id="email"  class="textbar2" placeholder="Adresse électronique" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required> <br><br>

            <label for="sexe">Sexe</label><br>
            <input type="radio" name="sexe" id="homme" value="homme">
            <label for="homme">Homme</label>
            <input type="radio" name="sexe" id="femme" value="femme">
            <label for="femme">Femme</label> <br><br>

            <label for="date"> Date de naissance</label><br>
            <input type="date" name="date" id="date" placeholder="date de naissance" max="2022-01-01" min="1910-01-01" required> <br><br>

            <label for="fonction">Fonction</label><br>
                <select name="fonction" id="fonction">
                    <option value="enseignant">Enseignant</option>
                    <option value="cadre">Cadre</option>
                    <option value="artisant">artisant</option>
                    <option value="ouvrier">ouvrier</option>
                    <option value="autre">autre</option>
                </select><br><br>

                <label for="sujet">Sujet</label><br>
                <input type="text" name="sujet" id="sujet" class="textbar2" placeholder="sujet" ><br><br>

                <label for="contenu">Contenu</label><br>
                <textarea id="contenu" name="contenu" rows="5" class="textbar2" cols="40"></textarea><br><br>

                <input type="submit" value="Envoyer" class="button" id="submit2">
                
        </form>
    </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="js/contact.js"></script>
</body>

</html>