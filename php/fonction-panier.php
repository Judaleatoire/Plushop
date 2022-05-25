<?php 
    function creerPanier (){ 
        // c'est plus simple de faire en sorte [["nom" => "Enta", "prix" => 40000000000000000000000000000, ...]]

        if (!isset ($_SESSION['panier'])){
            $_SESSION['panier'] = array();
            $_SESSION['panier']['nom'] = array(); // Enta, Saucisse 
            $_SESSION['panier']['quantite'] = array();
            $_SESSION['panier']['prix'] = array(); // panier->index-> prix
            $_SESSION['panier']['verrou'] = false; //permet de vérouiller le panier
        }
        return true;
    }

    function isVerrouill(){
        if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou']){
            return true;
        }else{
            return false;
        }
     }

    function ajout ($nom, $nb, $prix){
        if ((creerPanier()) && (!isVerrouill())){
            $i = array_search($nom, $_SESSION['panier']['nom']);
            if ($i !== false){
                $_SESSION['panier']['quantite'][$i] += $nb;
            }else{
                array_push($_SESSION['panier']['nom'], $nom);
                array_push( $_SESSION['panier']['quantite'], $nb);
                array_push( $_SESSION['panier']['prix'], $prix);
            }
        }else{
            echo ("Problème dans votre panier");
        }
    }

    function supp ($nom){
        if (creerPanier() && !isVerrouill()){
            //Nous allons passer par un panier temporaire
            $tmp = array();
            $tmp['nom'] = array();
            $tmp['quantite'] = array();
            $tmp['prix'] = array();
            $tmp['verrou'] = $_SESSION['panier']['verrou'];

            for($i = 0; $i < count($_SESSION['panier']['nom']); $i++){
                if ($_SESSION['panier']['nom'][$i] !== $nom){
                    array_push( $tmp['nom'],$_SESSION['panier']['nom'][$i]);
                    array_push( $tmp['quantite'],$_SESSION['panier']['quantite'][$i]);
                    array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
                }

            }
            //On remplace le panier en session par notre panier temporaire à jour
            $_SESSION['panier'] =  $tmp;
            //On efface notre panier temporaire
            unset($tmp);
        }else{
            echo ("Problème dans votre panier");
        }
    }

    function modifierQTeArticle($nom ,$nb){
        //Si le panier existe
        if (creerPanier() && !isVerrouill())
        {
           //Si la quantité est positive on modifie sinon on supprime l'article
           if ($nb > 0)
           {
              //Recherche du produit dans le panier
              $i = array_search($nom,  $_SESSION['panier']['nom']);
     
              if ($i !== false)
              {
                 $_SESSION['panier']['quantite'][$i] = $nb;
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
        for($i = 0; $i < count($_SESSION['panier']['nom']); $i++)
        {
           $all += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
        }
        return $all;
    }

    function supprimePanier(){
        unset($_SESSION['panier']);
     }
?>