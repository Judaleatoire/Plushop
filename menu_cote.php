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
            if(isset($id[1])) {
                $id = explode('s', $id[1])[0];
            }

            foreach($xml->categorie as $categorie) {
                echo("<li><a href='categorie.php?cat=" . $categorie->id . "'>" . $categorie->nom . "</a>");
                if($categorie->id == $id) {
                    echo("<br><ul>");
                    foreach($categorie->sous_categorie as $sous_categorie) {
                        echo("<li><a href='categorie.php?cat=" . $sous_categorie->id . "'>" . $sous_categorie->nom . "</a>");
                    }
                    echo("</ul>");
                }
            }
        ?>

        <li><a href='contact.php'>Contact</a></li>
    </ul>
    
</aside>