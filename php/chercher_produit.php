<?php
    include "./php/tabToKey.php";

    function chercher_produit($csv, $id) {
        $i = 0;
        foreach($csv as $ligne) {
            $temp = explode(",", $ligne);
            if($temp[0] == $id) {
                $temp2 = tabToKey($temp);
                $temp2["pos"] = $i;
                return $temp2;
            }
            $i++;
        }
        return -1;
    }
?>