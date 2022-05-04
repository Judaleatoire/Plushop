<head>
    <link rel="stylesheet" href="./css/menu_cote.css?v=2">
</head>

<aside>

    <ul id="menu-cote">
        <li><a href="index.php">Acceuil</a></li>

        <?php
            if(file_exists("./data/categories.xml")) {
                $xml = simplexml_load_file("./data/categories.xml");
            } else {
                exit("Le fichier n'a pas pu être ouvert...");
            }

            $id = explode('=', $_SERVER['QUERY_STRING']);

            //ajouter les sous catégories lorque l'on est dans une catégorie (voir dessin)
            foreach($xml->categorie as $categorie) {
                if(isset($id[1])) {
                    if($categorie->id != $id[1]) {
                        echo("<li><a href='index.php'>" . $categorie->nom . "</a></li>");
                    }
                } else {
                    echo("<li><a href='index.php'>" . $categorie->nom . "</a></li>");
                }          
            }
        ?>

        <li><a href="contact.php">Contact</a></li>
    </ul>

    
</aside>