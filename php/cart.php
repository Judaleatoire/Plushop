<?php
    session_start();
    if(empty($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    function addCart($ref, $nom, $prix, $solde, $qt) {
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
                "nom" => $nom,
                "prix" => $prix,
                "solde" => $solde,
                "qt" => $qt
            ];
        }
    }

    if(isset($_POST['ref'])){
        $ref = $_POST['ref'];
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $solde = $_POST['solde'];
        $qt = $_POST['qt'];
        addCart($ref, $nom, $prix, $solde, $qt);
    }
?>