<?php

    if(!isset($_SESSION)) {
        session_start();
    }

    $servidor = "localhost";
    $bd = "rainingdrip";
    $user = "root";
    $password = "";

    $ligacao = mysqli_connect($servidor, $user, $password, $bd, 3306);
    
?>