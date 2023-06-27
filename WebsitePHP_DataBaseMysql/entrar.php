<?php 
session_start();
    if((isset($_SESSION['email'])== true) and (isset($_SESSION['senha']) == true))
    {   
        header("location: perfil.php");
    }
    if(isset($_POST['submit']))
    {
        // entra no sistema - 
        include_once('config.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $sql = $conexao->query("SELECT * FROM users WHERE email = '$email' and senha = '$senha'");
        if($sql -> num_rows >= 1){  //Logou 
            header("location: home.php");
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;

        }else { // nao logou
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            
            echo "<style> 
            #alert{visibility: visible !important;}    
            #labelincorrct{color: red !important; }
            .inputUser{border-bottom: 1px solid red !important;}
            </style>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px;
            border-radius: 15px;
            width: 350px;
            color: white;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            border: 1px solid dodgerblue;
            padding: 5px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputbox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white ;
            outline: none;
            font-size: 15px;
            width: 100%;
            color: white;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }
        #submit{
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right, rgb(10, 101, 153), rgb(5, 28, 39));
        }
        #alert{
            visibility: hidden;
            text-align: center;
            color: red;
            height: 20px;
        }
        .pxText{
            font-size: 13px;
        }
  

    </style>
</head>
<body>
    <div class="box">
        <form action="" method="POST">
            <fieldset>
                <legend><b> Login </b></legend>
                <div  id='alert'>
                    <p>Login ou Senha incorretos</p>
                </div>
                <br>
                <div class="inputbox">
                    <input type="text" name="email" id="email" class="inputUser" required >
                    <label for="email" class="labelInput" id='labelincorrct' >Email</label>
                </div>
                <br><br>
                <div class="inputbox">
                    <input type="password" name="senha" id="senha" class="inputUser" required >
                    <label for="senha" class="labelInput" id='labelincorrct'>Senha </label>
                </div>
                <br><br>
                <input type="submit" name="submit" id="submit"> 
                <br>
                <p class="pxText">Nao tem uma conta ainda? <a href="./register.php"> registrar </a> </p>
            </fieldset> 
        </form>  
    </div>
</body>
</html>