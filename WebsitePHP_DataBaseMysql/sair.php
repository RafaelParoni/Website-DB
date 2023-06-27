<?php 
    session_start();
    // print_r($_SESSION);
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("location: entrar.php");

?>