<?php

    /**
     * Cette fonction permet de rechercher une catégorie dans le fichier xml associé.
     * 
     * @param string    $xml Chemin du fichier XML
     * @param string    $cat Catégorie que l'on chercher dans le fichier 
     * 
     * @author François Guillerm
    */

    function recherche_cat_xml($xml, $cat) {

        //On fait une boucle dans les catégories
        foreach($xml as $categorie) {
            //Si on a trouvé la catégorie correspondante, on renvoie toutes ses informations
            if($categorie->id == $cat) {
                return $categorie;
            }
            //On fait une boucle dans les sous-catégories
            foreach($categorie->sous_categorie as $sous_categorie) {
                //on reforme l'id complet de la sous-catégorie
                $nom_cat = $categorie->id . '-' . $sous_categorie->id;
                //Si on a trouvé la sous-catégorie correspondante, on renvoie toutes ses informations
                if($nom_cat == $cat) {
                    return $sous_categorie;
                }
            }
        }

        //Si la catégorie n'a pas été trouvé, on renvoie -1 comme erreur
        return -1;

    }   
?>