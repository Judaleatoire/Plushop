<?php
    function open_file($file, $type, $location) {

        if(file_exists($file)) {
            switch($type) {
                case "xml" : return simplexml_load_file($file); break;
                case "csv" : return file($file); break;
                case "json" : return file_get_contents($file); break;
                default : header("location: $location");
            }
        } else {
            header("location: $location");
        }

    }
?>