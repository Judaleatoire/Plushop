<?php
    function recherche_cat_xml($xml, $cat) {
        foreach($xml as $categorie) {
            if($categorie->id == $cat) {
                return $categorie;
            }
            foreach($categorie->sous_categorie as $sous_categorie) {
                $nom_cat = $categorie->id . '-' . $sous_categorie->id;
                if($nom_cat == $cat) {
                    return $sous_categorie;
                }
            }
        }
        return -1;
    }   
?>