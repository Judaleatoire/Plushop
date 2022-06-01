<?php

    /**
     * Fonction permettant de transformer un tableau indicé en un tableau associatif.
     * Cette fonction est utilisée dans des cas précise seulement et n'est pas modulable.
     * 
     * @param array     $tab Tableau à convertir
     * 
     * @author François Guillerm
    */

    function tabToKey($tab) {
        $tabKey = array(
            "ref" => $tab[0],
            "nom" => $tab[1],
            "desc" => $tab[2],
            "prix" => $tab[3],
            "nouv" => $tab[4],
            "solde" => $tab[5],
            "stock" => $tab[6],
            "dim" => $tab[7],
            "taille" => $tab[8],
            "couleur" => $tab[9],
            "marque" => $tab[10]
        );
        return $tabKey;
    }
?>