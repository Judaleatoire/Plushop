<?php
    session_start();

    function modif($champ, $info) {
        if(empty($info) || !isset($info)) {
            echo('{"message":"vide"}');
        } else {
            $_SESSION['info_login'][$champ] = $info;
            $pos = intval($_SESSION['info_login']['pos']);

            $js = file_get_contents('../data/compte.json');
    
            $js = json_decode($js, true);

            $js[$pos][$champ] = $info;

            $js = json_encode($js);
    
            file_put_contents('../data/compte.json',$js);
            
            echo('{"message":"ok"}');
        }
    }

    if(isset($_POST['champ'])){
        $champ = $_POST['champ'];
        $info = $_POST['info'];
        modif($champ, $info);
    }
?>