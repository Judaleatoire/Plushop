<?php

    /**
     * Simple fonction permettant de vérifier si une variable est définie et si elle est vide.
     * Si elle n'est aucun des 2, on fait une redirection à $location.
     * 
     * @param mixed     $var Variable que l'on veut vérifier
     * @param string    $location Chemin où aller en cas d'erreur
     * 
     * @author François Guillerm
    */

    function verif_isset_empty($var, $location) {
        if(!isset($var) || empty($var)) header("location: $location");
    }
?>