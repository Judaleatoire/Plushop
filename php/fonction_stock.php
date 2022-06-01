<?php
    /** 
    * Fonction stock
    * 
    * Ces fonctions servent dans panier.php et recu.php
    *
    * La fonction actualisation_stock() permet d'actualiser le stock du produit correspondant après l'achat
    * La fonction move() permet déplacer de renommer le fichier temporaire (tmp.csv) en fichier produits.csv 
    * La fonction recherche_stock() permet de récupérer le stock afin de connaître la disponibilité du produit
    *
    * @author     Alexis TOURRENC--LECERF
    *  
    */

function actualisation_stock ($nom, $quantite){
    $row = 1;
    $ecriture = []; // On créer un tableau pour l'écriture
    if (($handle = fopen("data/produits.csv", "r")) !== FALSE) { // On ouvre le fichier produits.csv en lecture
        if (($fp = fopen("data/tmp/tmp.csv", "w+")) !== FALSE){ // On ouvre le fichier produits.csv en écriture et en lecture
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // On lit dans le fichier produits.csv chacune de ses lignes 
                
                if ($data[1] == $nom){ // On a trouvé la position dans le fichier produits.csv de l'élément recherché
                    $ecriture = $data; // Le tableau d'écriture prend le tableau lu
                    $ecriture[6] -= $quantite; // On décrémente le stock
                    fwrite($fp, implode(',', $ecriture) . PHP_EOL); // On écrit le tableau avec le nouveau stock dans le fichier tmp.csv
                }else{ // Sinon 
                    fwrite($fp, implode(',', $data) . PHP_EOL); // On écrit le tableau dans le fichier tmp.csv
                }
                $row++; // On change de ligne
            }
        } 
        fclose($handle); // On ferme le fichier
        move(); // On renomme le fichier tmp.csv en produits.csv
    }
}

function move (){
    $currentLocation = 'data/tmp/tmp.csv'; // On prend la localisation du fichier que l'on veut renommer
    $newLocation = 'data/produits.csv'; // On prend la localisation du fichier qui va être écraser
    rename($currentLocation, $newLocation); // On renomme le fichier tmp.csv
    array_map('unlink', glob("data/tmp/*.csv")); // On supprime tous les fichiers csv dans tmp/
}

function recherche_stock ($nom){
    if (($handle = fopen("data/produits.csv", "r")) !== FALSE) { // On ouvre le fichier produits.csv en lecture
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // On lit dans le fichier produits.csv chacune de ses ligne 
            if ($data[1] == $nom){ // On a trouvé la position dans le fichier produits.csv de l'élément recherché
                fclose($handle); // On ferme le fichier
                return $data[6]; // On retourne le stock actuel
            } 
        }
    }
}    
?>