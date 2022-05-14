<head lang="fr">
    <link rel="stylesheet" href="./css/header.css?v=2">
</head>

<header>
    <div id="logo">
    </div>
    <div id="navigation">
        <h1>PluShop</h1>
        <nav>
            <ul id="menu">
                <li><a href="index.php">Accueil</a></li>

                <?php
                    if(file_exists("./data/categories.xml")) {
                        $xml = simplexml_load_file("./data/categories.xml");
                    } else {
                        exit("Le fichier n'a pas pu être ouvert...");
                    }

                    foreach($xml->categorie as $categorie) {
                        // echo("<li><a href='categorie.php?cat=" . $categorie->id . "'>" . $categorie->nom . "</a>");
                        echo("<li><a href='categorie.php?cat=$categorie->id'>$categorie->nom</a>");
                        if(isset($categorie->sous_categorie)) {
                            echo("<ul class='sous'>");
                            foreach($categorie->sous_categorie as $sous_categorie) {
                                // echo("<li><a href='categorie.php?cat=" . $categorie->id . $sous_categorie->id . "'>" . $sous_categorie->nom . "</a>");
                                echo("<li><a href='categorie.php?cat=$categorie->id-$sous_categorie->id'>$sous_categorie->nom</a>");
                            }
                            echo("</ul>");
                        }
                        echo("</li>");
                    }
                ?>

                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </div>
    <div id="logpan">
        <a href="index.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3"
                viewBox="0 0 16 16">
                <path
                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
        </a>
        <a href="index.php">Connexion</a>
    </div>
</header>