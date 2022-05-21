<?php
    function chercher_produit($csv, $id) {
        $i = 0;
        foreach($csv as $ligne) {
            $temp = explode(",", $ligne);
            if($temp[0] == $id) {
                $temp2 = array(
                    "ref" => $temp[0],
                    "nom" => $temp[1],
                    "desc" => $temp[2],
                    "prix" => $temp[3],
                    "nouv" => $temp[4],
                    "solde" => $temp[5],
                    "stock" => $temp[6],
                    "age" => $temp[7],
                    "taille" => $temp[8],
                    "marque" => $temp[9],
                    "pos" => $i
                );
                return $temp2;
            }
            $i++;
        }
        return -1;
    }
?>