<?php 
     if(isset($_POST['submit']))
    {
        include_once('config.php');



        if($_POST['senha'] == $_POST['cofirm_senha']){
            $senha = $_POST['senha'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $genero = $_POST['genero'];
            $data_nasc = $_POST['data_nascimento'];
            
            $result = $conexao->query("SELECT * FROM users WHERE email = '$email'"); 

            if($result -> num_rows >= 1){
                echo '<style>
                        #alertEmail{visibility: visible !important;}
                        #email{border-bottom: 1px solid red !important;} 
                        #labelEmail{color:red !important;}
                    </style>';
            }else{
                print_r("email cadastrado com sucesso!");
                $form = mysqli_query($conexao, "INSERT INTO users(username,email,genero,data_nasc,senha) VALUE ('$nome','$email','$genero','$data_nasc','$senha')");     
                header('location: entrar.php');
            }
        }
        else
        {
            echo '<style>
                    #alertPassword{visibility: visible !important;}
                    #labelsenha{color: red !important; }
                    #senha{border-bottom: 1px solid red !important; }
                    #cofirm_senha{border-bottom: 1px solid red !important; }  
                </style>';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie sua conta! </title>
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
        #data_nascimento {
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
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
        .alert{
            visibility: hidden;
            text-align: center;
            color: red;
            height: 20px;
        }
        .pxText{
            font-size: 13px;
        }
        .alert2 {
            padding: 20px;
            background-color: #f44336;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
</head>
<body>
    <div class="box">
        <form action="" method="POST">
            <fieldset>
                <legend><b> Criação da conta </b></legend>
                <br><br>
                <div class="inputbox">
                    <input type="text" name="nome" id="nome" class="inputUser" required >
                    <label for="nome" class="labelInput" >Nome do usuário </label>
                </div>
                <br>
                <div class="alert" id='alertEmail'>
                    <p>Este email ja esta cadastrado!</p>
                </div>
                <div class="inputbox">
                    <input type="text" name="email" id="email" class="inputUser" required >
                    <label for="email" class="labelInput" id=labelEmail>Email </label>
                </div>  
                <p>Gênero:</p>
                <input type="radio" name="genero" value="feminino" required>
                <label for="feminino">Feminino</label><br>
                <input type="radio" name="genero" value="masculino" required>
                <label for="masculino">Masculino</label><br>
                <input type="radio" name="genero" value="outro" required>
                <label for="outro">Outros</label><br>
                <br><br>
                <label for="data_nascimento"><b>Data de Nascimento:</b> </label>
                <input type="date" name="data_nascimento" id="data_nascimento" required >
                <br>
                <div class="alert" id='alertPassword'>
                    <p>senha incorretas</p>
                </div>
                <br>
                <div class="inputbox">
                    <input type="password" name="senha" id="senha" class="inputUser" required >
                    <label for="senha" class="labelInput" id='labelsenha'>Senha </label>
                </div>
                <br><br>
                <div class="inputbox">
                    <input type="password" name="cofirm_senha" id="cofirm_senha" class="inputUser" required >
                    <label for="cofirm_senha" class="labelInput" id='labelsenha'>Confirme sua Senha </label>
                </div>
                <br><br>
                <input type="submit" name="submit" id="submit"> 
                <p class="pxText">já possui uma conta? <a href="./home.php"> Entrar </a> </p>
            </fieldset>
        </form>
    </div>
</body>
</html>