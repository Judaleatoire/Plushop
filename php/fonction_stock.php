<?php
function actualisation_stock ($nom, $quantite){
    $row = 1;
    $ecriture = [];
    if (($handle = fopen("data/produits.csv", "r")) !== FALSE) {
        if (($fp = fopen("data/tmp/tmp.csv", "w+")) !== FALSE){
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                
                if ($data[1] == $nom){
                    $ecriture = $data; 
                    $ecriture[5] -= $quantite;
                    fputcsv($fp, $ecriture);
                }else{
                    fputcsv($fp, $data);
                }
                $row++;
            }
        } 
        fclose($handle);
        move();
    }
}

function move (){
    $currentLocation = 'data/tmp/tmp.csv';
    $newLocation = 'data/produits.csv';
    rename($currentLocation, $newLocation);
    array_map('unlink', glob("data/tmp/*.csv"));
}
    
?>