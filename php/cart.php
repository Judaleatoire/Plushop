<?php

    /**
     * Ce fichier permet de gérer l'ajout, la suppresion et la modification de stocks dans le panier.
     * 
     * @author François Guillerm
     * @author Amandine Chantome
    */

    session_start();
    include_once "chercher_produit.php";
    include_once "open_file.php";

    //Cette fonction permet de créer le panier en session si celui-ci n'a pas été set
    function createCart(){
        if(empty($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
    }

    function addCart($ref, $qt) {
       if($ref == null){
           return;
       }
       if(empty($_SESSION['cart'])){
           $_SESSION['cart'] = [];
       }

       if(array_key_exists($ref, $_SESSION['cart'])) {
           $_SESSION['cart'][$ref]['qt'] += $qt;
       } else {
           $_SESSION['cart'][$ref] = [
               "ref" => $ref,
               "qt" => intval($qt)
           ];
       }
    }

    function suppPdtCart($ref) {
        if($ref == null){
            return;
        }
        if(empty($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
 
        if(array_key_exists($ref, $_SESSION['cart'])) {
            unset($_SESSION['cart'][$ref]);
        }
    }

    function modif_qt($ref, $signe) {
        if($ref == null){
            return;
        }
        if(empty($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        
        if(array_key_exists($ref, $_SESSION['cart'])) {
            switch($signe) {
                case "+":
                    $_SESSION['cart'][$ref]["qt"]++;
                    break;
                case '-':
                    $_SESSION['cart'][$ref]["qt"]--;
                    break;
            }
        }
    }

    function removeToCart($ref, $qt){
        createCart();
        $csv = open_file("../data/produits.csv", "csv", "page_erreur.php");
        
        $exist = chercher_produit($csv, $ref);
        if(is_int($exist)) return; // if doesn't exist

        $inside = array_filter($_SESSION['cart'], function ($data) use ($ref){
            if($data['ref'] === $ref) return $data;
        });

        if(!empty($inside)){
            $_SESSION['cart'] = array_map(function ($data) use ($ref, $qt){
                if($data['ref'] === $ref){
                    $data['qt'] -= $qt;
                }
                return $data;
            }, $_SESSION['cart']);
        }
    }

    function clearCart(){
        $_SESSION['cart'] = [];
    }

    if(isset($_POST['type'])) {
        $type = $_POST['type'];
        if(isset($_POST['ref'])) $ref = $_POST['ref'];
        if(isset($_POST['qt'])) $qt = $_POST['qt'];
        if(isset($_POST['signe'])) $signe = $_POST['signe'];

        switch($type) {
            case "add":
                addCart($ref, $qt);
                echo('{"message" : "ok"}');
                break;
            case "supp":
                suppPdtCart($ref);
                echo('{"message" : "ok"}');
                break;
            case "modif":
                modif_qt($ref, $signe);
                echo('{"message" : "ok"}');
                break;
            case "clear":
                clearCart();
                echo('{"message" : "ok"}');
                break;
        }
    }

?>