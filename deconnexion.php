<?php/**
     * Supprime toutes les informations de la session et redirige vers la page d'accueil
     *  
     * @author François Guillerm
    */
?>

<?php
    //On détruit la session pour supprimer toutes les informations qu'elle contenait 
    //(notamment les informations de l'utilisateur connecté et le panier)
    session_start();
    session_destroy();
    header("Location: index.php");
?>