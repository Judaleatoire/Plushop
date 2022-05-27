

<div id="menu-cote" class="piou">

    <ul>
        <li> 
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        </li>
        <li><a href="index.php">Acceuil</a></li>

        <?php
        
            include_once "php/verif_isset_empty.php";
            include_once "php/open_file.php";

            $xml = open_file("data/categories.xml", "xml", "page_erreur.php");

            if(isset($_GET['cat'])) {
                $id = $_GET['cat'];
                verif_isset_empty($id, "page_erreur.php");
                $id = explode('-', $id)[0];
            } else {
                $id = "";
            }

            foreach($xml->categorie as $categorie) {
                // echo("<li><a href='categorie.php?cat=" . $categorie->id . "'>" . $categorie->nom . "</a>");
                echo("<li><a id='$categorie->id' href='categorie.php?cat=$categorie->id#$categorie->id'>$categorie->nom</a>");
                if($categorie->id == $id) {
                    echo("<ul class='piou-sous'>");
                    foreach($categorie->sous_categorie as $sous_categorie) {
                        // echo("<li><a href='categorie.php?cat=" . $categorie->id . $sous_categorie->id . "'>" . $sous_categorie->nom . "</a>");
                        echo("<li><a href='categorie.php?cat=$categorie->id-$sous_categorie->id#$categorie->id'>$sous_categorie->nom</a>");
                    }
                    echo("</ul>");
                }
            }
        ?>

        <li><a href='contact.php'>Contact</a></li>
    </ul>
    
</div>