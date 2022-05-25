<?php
    function verif_isset_empty($var, $location) {
        if(!isset($var) || empty($var)) header("location: $location");
    }
?>