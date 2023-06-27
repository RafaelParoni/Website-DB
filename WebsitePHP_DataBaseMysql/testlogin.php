<?php 
session_start();

    // print_r($_REQUEST);
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){
        // entra no sistema - 
        include_once('config.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = $conexao->query("SELECT * FROM users WHERE email = '$email' and senha = '$senha'");

        if($sql -> num_rows >= 1){  //Logou 
            header("location: sistema.php");
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;

        }else { // nao logou
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header("location: entrar.php");
        }

    }
    else{   
        // Nao entra no sistema -
        header("location: entrar.php");
    }
?>