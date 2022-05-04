<?php
    function recherche_email($email){//recherche si l'email existe et renvoie son numéro dans le fichier si elle existe sinon renvoie -1
        $js = file_get_contents('data/compte.json');
        $js = json_decode($js, true);

        for($i=0;$i<count($js);$i++){
            if($js[$i]['login'] == $email){
                return($i);
            }
        }
        return(-1);
    }

    

?>