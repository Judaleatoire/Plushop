<?php
    function recherche_email($email){//recherche si l'email existe et renvoie son numéro dans le fichier si elle existe sinon renvoie -1
        $js = file_get_contents('data/compte.json');
        $js = json_decode($js, true);

        // https://www.php.net/manual/fr/function.array-filter

        // $user = array_filter($js, function($data) {
        //     if($data['login'] === $email){
        //         return $data;
        //     }
        // });

        // return empty($user) ? null : $user[0];

        for($i=0;$i<count($js);$i++){
            if($js[$i]['login'] == $email){
                return($i);
            }
        }
        return(-1);
    }

    function write_new_user($user){//ecrit les données d'un nouvel utilisateur
        $js = file_get_contents('data/compte.json');

        $js = json_decode($js, true);
        $js[] = $user;
        $js = json_encode($js);

        file_put_contents('data/compte.json',$js);

    }
    

?>