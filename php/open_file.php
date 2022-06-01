<?php

    /**
     * Cette fonction permet d'ouvrir un fichier data.
     * 
     * @param string    $file Chemin du fichier à ouvrir
     * @param string    $type Type de fichier à ouvrir
     * @param string    $location Chemin où aller en cas d'erreur
     * 
     * @author François Guillerm
    */

    function open_file($file, $type, $location) {

        //On vérifie d'abord si le fichier existe
        if(file_exists($file)) {
            //On ouvre le fichier en fonction de son extension
            switch($type) {
                case "xml" : return simplexml_load_file($file); break;
                case "csv" : return file($file); break;
                case "json" : return file_get_contents($file); break;
                default : header("location: $location");
            }
        } else {
            //On fait une redirection si le fichier n'existe pas
            header("location: $location");
        }
    }
?>