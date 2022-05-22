<?php 
    session_start();
    echo ($_SESSION['nom']);
    session_destroy();
?>