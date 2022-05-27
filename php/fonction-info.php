<?php
    function test (){
        if(!empty($_POST)){
            if (($_POST['nom'] == "") || (preg_match('/[a-z]/', $_POST['nom']))){
                echo "<font color='#FF0000'>";
                echo "Le nom DOIT être rempli car ". $_POST['nom'] . " n'est pas un nom valide";
                echo "</font>";
                echo "<BR>";
            }else{
                echo "Le nom <b>".$_POST['nom']. "</b> est valide <br>";
            }
            if (($_POST['pre'] == "") || (preg_match('/#^([A-Z])(?!(?i)\1)(?:([a-z])(?!\2\2)){1,15}$#/', $_POST['prenom']))){
                echo "<font color='#FF0000'>";
                echo "Le prénom DOIT être rempli car ". $_POST['prenom'] . " n'est pas un prénom valide";
                echo "</font>";
                echo "<BR>";
            }else{
                echo "Le prénom <b>".$_POST['prenom']. "</b> est valide <br>";
            }
            if (($_POST['email'] == "") || ($_POST['confirm_email'] == "") || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) || (!filter_var($_POST['confirm_email'], FILTER_VALIDATE_EMAIL))){
                echo "<font color='#FF0000'>";
                echo "Le mail DOIT être rempli car ". $_POST['email'] . " n'est pas un mail valide";
                echo "</font>";
                echo "<BR>";
            }else{
                if (($_POST['email'] != $_POST['confirm_email'])){
                    echo "<font color='#FF0000'>";
                    echo "Les deux mails ne sont pas les mêmes";
                    echo "</font>";
                    echo "<BR>";
                }else{
                    echo "Le mail <b>".$_POST['email']. "</b> est valide <br>";
                    echo "La confirmation du mail <b>".$_POST['confirm_email']. "</b> est valide <br>";
                }
                
            }
            if (($_POST['cell'] == "") || (!preg_match('#^0[6-7]{1}\d{8}$#', $_POST['cell']))){
                echo "<font color='#FF0000'>";
                echo "Le téléphone DOIT être rempli car ". $_POST['cell'] . " n'est pas un numéro de téléphone valide";
                echo "</font>";
                echo "<BR>";
            }else{
                echo "Le téléphone <b>".$_POST['cell']. "</b> est valide <br>";
            }
            if (($_POST['adresse'] == "")){
                echo "<font color='#FF0000'>";
                echo "L'adresse DOIT être rempli car ". $_POST['adresse'] . " n'est pas une adresse valide";
                echo "</font>";
                echo "<BR>";
            }else{
                echo "L'adresse <b>".$_POST['adresse']. "</b> est valide <br>";
            }
        }
    }
?>