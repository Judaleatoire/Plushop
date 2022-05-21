<?php
    function test_page($page) {
        $lien = explode("=", $lien);
        if(count($lien) != 2) {
            header("location: index.php");
        } else if($lien[0] != "cat" || $lien[0] != "pdt") {
            header("location: index.php");
        }
    }
?>