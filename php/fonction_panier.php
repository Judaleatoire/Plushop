<?php

    function creerPanier (){ 
        if (!isset ($_SESSION['panier'])){
            $_SESSION['panier'] = array();

        }
        return true;
    }


    function ajout ($nom, $nb, $prix){
        $i = 0;
        if (creerPanier()){
            foreach ($_SESSION['panier'] as $element){
                if (is_array($element)){
                    if (!array_search($nom, $element)){
                        $i++;
                    }
                }
            }
            if (($i !== false) && (isset($_SESSION['panier'][$i]))){
                $_SESSION['panier'][$i]['quantite'] += $nb;
            }else{
                $_SESSION['panier'][] = ['nom' => $nom, 'quantite'=> $nb, 'prix' => $prix];
            }    
        }else{
            echo ("Problème dans votre panier");
        }
    }

    function supp ($nom){
        if (creerPanier()){
            //Nous allons passer par un panier temporaire
            $tmp = array();
            $i = 0;
            foreach ($_SESSION['panier'] as $element){
                if (is_array($element)){
                    if ($element['nom'] !== $nom){
                        $tmp[] = ['nom' => $element['nom'], 'quantite' => $element['quantite'], 'prix' => $element['prix']];
                    }
                }
            }
           
            //On remplace le panier en session par notre panier temporaire à jour
            $_SESSION['panier'] = $tmp;
            //On efface notre panier temporaire  
            unset($tmp);
        }else{
            echo ("Problème dans votre panier");
        }
    }

    function modifierQTeArticle($nom, $nb){
        //Si le panier existe
        $i = 0;
        if (creerPanier()){
           //Si la quantité est positive on modifie sinon on supprime l'article
           if ($nb > 0){
                //Recherche du produit dans le panier
                foreach ($_SESSION['panier'] as $element){
                    if (is_array($element)){
                        if (!array_search($nom, $element)){
                            $i++;
                        }
                    }
                }
     
                if (($i !== false) && (isset($_SESSION['panier'][$i]))){
                    $_SESSION['panier'][$i]['quantite'] = $nb;
                }
           }
           else
           supp($nom);
        }
        else{
            echo ("Problème dans votre panier");
        }
    }

    function MontantGlobal(){
        $all=0;
        foreach ($_SESSION['panier'] as $element){
            if (is_array($element)){
                $all += $element['quantite'] * $element['prix'];
            }
        }  
        return $all;
    }

    function MontantGlobalTVA(){
        $all=0;
        foreach ($_SESSION['panier'] as $element){
            if (is_array($element)){
                $all += $element['quantite'] * $element['prix'] * 1.20;
            }
        }  
        return $all;
    }

    function supprimePanier(){
        unset($_SESSION['panier']);
    }
?>