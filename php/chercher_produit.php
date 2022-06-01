<?php

    /**
     * Cette fonction permet de chercher un produit dans le fichier csv correspondant.
     * 
     * On lit le fichier ligne par ligne et on renvoit un tableau associatif contenant 
     * toutes les informations du produit en fonction de l'ID entré.
     * On utilise la fonction tabToKey pour transformer le tableau indicé en tableau associatif.
     * 
     * @param array     $csv Fichier csv
     * @param string    $id ID du produit que l'on cherche
     * 
     * @return array    Tableau associatif du produit cherché
     * @return int      On renvoie -1 si le produit n'a pas été trouvé
     * 
     * @author François Guillerm
    */
    
    //On inclue un fichier nécessaire au fonctionnement de la fonction
    include_once "./php/tabToKey.php";

    //$csv contient le contenu du fichier csv
    //$id contient l'id du produit recherché
    function chercher_produit($csv, $id) {

        //On crée une variable pour enregistrer la position du produit par la suite
        $i = 0;

        //On fait une boucle pour traverser le contenu du fichier csv ligne par ligne et trouver le produit que l'on cherche
        foreach($csv as $ligne) {

            //On sépare le contenu de la ligne pour reformer toutes les informations du produit
            $temp = explode(",", $ligne);

            //Si la ligne correspond à l'id, on renvoie les informations du produit
            if($temp[0] == $id) {

                //On convertie le tableau indicé en tableau associatif
                $temp2 = tabToKey($temp);
                $temp2["pos"] = $i;
                return $temp2;

            }

            //On incrémente la position du produit
            $i++;
        }

        //On renvoie -1 si le produit n'a pas été trouvé
        return -1;
    }
?>