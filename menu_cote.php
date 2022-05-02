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

            $nom_page = explode('.', basename($_SERVER['PHP_SELF']))[0];

            foreach($xml->categorie as $categorie) {
                if(str_replace(array('é', 'è', 'ê'), 'e', strtolower($categorie->nom)) != $nom_page) {
                    echo("<li><a href='index.php'>" . $categorie->nom . "</a></li>");
                }
            }
        ?>
    </ul>
    
</aside>