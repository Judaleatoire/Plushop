<?php

    /** 
    * Fonction panier
    * 
    * Ces fonctions servent dans panier.php
    *
    * La fonction creerPanier() permet de réserver la mémoire pour le panier et renvoie true s'il a réussi
    * La fonction ajout() permet d'ajouter un produit dans le panier
    * La fonction supp() permet de supprimer un produit dans le panier
    * La fonction modifierQTeArticle() permet de modifier la quantité d'un produit dans le panier
    * La fonction MontantGlobal() permet de calculer le montant global hors taxe du panier 
    * La fonction MontantGlobalTVA() permet de calculer le montant global avec la TVA du panier
    * La fonction supprimePanier() permet de supprimer tous les éléments du panier
    *
    * @author     Alexis TOURRENC--LECERF
    * @author     François Guillerm
    *  
    * 
    */

    function creerPanier (){
        if (!isset ($_SESSION['panier'])){ // Si la variable de session panier n'existe pas on la créé
            $_SESSION['panier'] = array();

        }
        return true;
    }


    function ajout ($nom, $nb, $solde, $prix){
        $i = 0;
        if (creerPanier()){ // Si le panier existe
            foreach ($_SESSION['panier'] as $element){ // On parcourt tous les éléments de Session['panier']
                if (is_array($element)){ // Si c'est un tableau
                    if (!array_search($nom, $element)){ // On recherche dans élément si le nom n'existe pas
                        $i++; // On incrémente i
                    }
                }
            }
            if (($i !== false) && (isset($_SESSION['panier'][$i]))){ // Si est bien défini et si le panier en position i existe
                $_SESSION['panier'][$i]['quantite'] += $nb; // On augmente la quantité
            }else{ // Sinon
                $_SESSION['panier'][] = ['nom' => $nom, 'quantite'=> $nb, 'prix' => $prix, 'solde' => $solde]; // On créé un tableau dans le panier contenant le nom, le prix, la quantité et éventuellement la réduction
            }    
        }else{
            echo ("Problème dans votre panier"); // On a eu un problème
        }
    }

    function supp ($nom){
        if (creerPanier()){ // Si le panier existe
            $tmp = array(); // On utilise un panier temporaire
            foreach ($_SESSION['panier'] as $element){ // On parcourt tout le panier
                if (is_array($element)){ // Si element est un tableau
                    if ($element['nom'] !== $nom){ // Si le nom d'élément est différent du nom du produit à supprimer 
                        $tmp[] = ['nom' => $element['nom'], 'quantite' => $element['quantite'], 'prix' => $element['prix'], 'solde' => $element['solde']]; // On créé un tableau dans le panier temporaire contenant le nom, le prix, la quantité et éventuellement la réduction
                    }
                }
            }
            $_SESSION['panier'] = $tmp; //On remplace le panier en session par notre panier temporaire à jour
            unset($tmp); //On efface notre panier temporaire 
        }else{
            echo ("Problème dans votre panier"); // On a eu un problème
        }
    }

    function modifierQTeArticle($nom, $nb){
        $i = 0;
        if (creerPanier()){ // Si le panier existe
           if ($nb > 0){ //Si la quantité est positive on modifie sinon on supprime l'article
                foreach ($_SESSION['panier'] as $element){// On parcourt tout le panier
                    if (is_array($element)){ // Si element est un tableau
                        if (!array_search($nom, $element)){ // On recherche dans élément si le nom n'existe pas
                            $i++; // On incrémente i
                        }
                    }
                }
     
                if (($i !== false) && (isset($_SESSION['panier'][$i]))){ // Si est bien défini et si le panier en position i existe
                    $_SESSION['panier'][$i]['quantite'] = $nb; //on change la quantité
                }
           }
           else
           supp($nom); // On supprime l'ancienne valeur dans le panier
        }
        else{
            echo ("Problème dans votre panier"); // On a eu un problème
        }
    }

    function MontantGlobal(){
        $all=0;
        foreach ($_SESSION['panier'] as $element){ // On parcourt tout le panier
            if (is_array($element)){ // Si element est un tableau
                $all += $element['quantite'] * $element['prix'] * (1-$element['solde']/100) * 0.8; // Les prix sont toutes taxes comprises, on calcule donc le prix total hors taxe (*0.8)
            }
        }  
        return round($all, 2); // On retourne la valeur du prix arondie à 10^-2 près
    }

    function MontantGlobalTVA(){
        $all=0;
        foreach ($_SESSION['panier'] as $element){// On parcourt tout le panier
            if (is_array($element)){// Si element est un tableau
                $all += $element['quantite'] * $element['prix'] * (1-$element['solde']/100); // Les prix sont toutes taxes comprises, on calcule donc le prix total avec la TVA
            }
        }  
        return round($all, 2); // On retourne la valeur du prix arondie à 10^-2 près
    }

    function supprimePanier(){
        unset($_SESSION['panier']); // On libère la mémoire occupée par le panier
    }

    function nombre_element(){//fonction pour compter le nombre d'élément dans le panier
        $all=0;
        foreach ($_SESSION['panier'] as $element){
            if (is_array($element)){
                $all++;
            }
        }
        return $all;
    }
    
?>