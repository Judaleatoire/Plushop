<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meow grr roar 😏</title>
</head>

    
<body>
    <div id="error"></div>
    <div class="forms">

        <form action="" method="post" id="form">

            <label for="dateC"> Date de contact</label><br>
            <input type="date" name="dateC" id="dateC" placeholder="date de contact" > <br><br>

            <label for="nom">Nom</label><br>
            <input type="text" name="nom" id="nom" placeholder="Nom"><br><br> 

            <label for="prenom">Prénom</label><br>
            <input type="text" name="prenom" id="prenom" placeholder="Prénom" > <br><br>

            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" placeholder="Adresse électronique"> <br><br>

            <label for="sexe">Sexe</label><br>
            <input type="radio" name="sexe" id="homme" value="homme">
            <label for="homme">Homme</label>
            <input type="radio" name="sexe" id="femme" value="femme">
            <label for="femme">Femme</label> <br><br>

            <label for="date"> Date de naissance</label><br>
            <input type="date" name="date" id="date" placeholder="date de naissance"> <br><br>

            <label for="fonction">Fonction</label><br>
                <select name="fonction" id="fonction">
                    <option value="enseignant">Enseignant</option>
                    <option value="cadre">Cadre</option>
                    <option value="artisant">artisant</option>
                    <option value="ouvrier">ouvrier</option>
                    <option value="autre">autre</option>
                </select><br><br>

                <label for="sujet">Sujet</label><br>
                <input type="text" name="sujet" id="sujet" placeholder="sujet" ><br><br>

                <label for="contenu">Contenu</label>
                <textarea id="contenu" name="contenu" rows="5" cols="40"></textarea><br><br>

                <input type="submit" value="Envoyer" class="button">
                
        </form>
    </div>
    <script src="js/contact.js"></script>
</body>

</html>