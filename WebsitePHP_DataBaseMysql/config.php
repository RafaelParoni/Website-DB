<?php 

    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbPassaword = '';
    $dbName = 'users';

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassaword,$dbName);

    /*
    if($conexao -> connect_error)
    {
        echo "Erro";
    }
    else
    {
        echo 'Foi';
    }
    */
    
?>