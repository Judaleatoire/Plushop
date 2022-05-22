<?php
    function tabToKey($tab) {
        $tabKey = array(
            "ref" => $tab[0],
            "nom" => $tab[1],
            "desc" => $tab[2],
            "prix" => $tab[3],
            "nouv" => $tab[4],
            "solde" => $tab[5],
            "stock" => $tab[6],
            "age" => $tab[7],
            "taille" => $tab[8],
            "marque" => $tab[9]
        );
        return $tabKey;
    }
?>