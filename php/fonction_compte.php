<?php

/**
     * la fonction recherche_email vérifie si l'email existe.
     * 
     * La fonction write_new_user ecrit les données d'un nouvel utilisateur
     * 
     * 
     * @author Loic Briant
*/

    function recherche_email($email){// renvoie son numéro dans le fichier si elle existe sinon renvoie -1
        $js = file_get_contents('data/compte.json'); //ouvre le fichier json
        $js = json_decode($js, true); 

        for($i=0;$i<count($js);$i++){  //on avance dans le fichier tant qu'il n'y a pas d'email correspondant
            if($js[$i]['login'] == $email){
                return($i);
            }
        }
        return(-1);
    }


    function write_new_user($user){
        $js = file_get_contents('data/compte.json');

        $js = json_decode($js, true);
        $js[] = $user;
        $js = json_encode($js);

        file_put_contents('data/compte.json',$js);

    }
    

?>