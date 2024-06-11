<?php

    if(!isset($_SESSION)) {
        session_start();
    }

    $servidor = "localhost";
    $bd = "raining_drip";
    $user = "root";
    $password = "";

    $ligacao = mysqli_connect($servidor, $user, $password, $bd);

    if (!$ligacao) {
        die("Erro de conexão: ". mysqli_connect_error());
    }

?>