<?php 
    session_start();
    include_once("config.php");

    $logado = $_SESSION['email'];

    $sqlSelect = "SELECT * FROM users
    WHERE email='$logado' ";

    $resultSelect = $conexao->query($sqlSelect);
    $SeltPerf = mysqli_fetch_assoc($resultSelect);
    echo "Logado como: ".$SeltPerf['username'];
    $permisson = $SeltPerf['permission'];
    if($permisson == "0034512345"){
        header("location: noperm.php");
    }else{
        // 0034512345 no perm
        // 1044613354 perm(1)
        // 2055724465 perm(2)
    } 

    if($permisson == "2055724465"){
        echo "<style> #perm2{visibility:visible !important} </style>";
        $perm = "01";
    }else{
        $perm = "02";
        echo "<style> #perm2{visibility:hidden !important} </style>";
        // 0034512345 no perm
        // 1044613354 perm(1)
        // 2055724465 perm(2)
    }

     if(!empty($_GET['id']))
    {

        $id = $_GET['id'];

        $sqlSelect = "SELECT * FROM users WHERE id=$id";

        $result = $conexao->query($sqlSelect);
        
        if($result->num_rows > 0){
            while($user_data = mysqli_fetch_assoc($result)){
                $senha = $user_data['senha'];
                $nome = $user_data['username'];
                $email = $user_data['email'];
                $genero = $user_data['genero'];
                $data_nasc = $user_data['data_nasc'];
                $permission = $user_data['permission'];
                $image = $user_data['imageperfil'];
            }
        }else{
            header('location: sistema.php');
        }
    }else{
        header('location: sistema.php');
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit a conta <?php echo $nome ?> </title>
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
        #updata{
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #updata:hover{
            background-image: linear-gradient(to right, rgb(10, 101, 153), rgb(5, 28, 39));
        }

        .pxText{
            font-size: 13px;
        }

    </style>
</head>
<body>
    <a href="sistema.php">Voltar</a>
    <div class="box">
        <form action="saveEdit.php" method="POST">
            <fieldset>
                <legend><b>Editar: <?php echo $nome ?> </b></legend>
                <br><br>
                <div class="inputbox">
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $nome ?>" required >
                    <label for="nome" class="labelInput" >Nome do usuário </label>
                </div>
                <br><br>
                <div class="inputbox">
                    <input type="text" name="email" id="email" class="inputUser" value="<?php echo $email ?>" required >
                    <label for="email" class="labelInput" id=labelEmail>Email </label>
                </div>  
                <p>Gênero:</p>
                <input type="radio" name="genero" value="feminino" value="feminino" <?php echo $genero == 'feminino' ? 'checked' : "" ?> required>
                <label for="feminino">Feminino</label><br>
                <input type="radio" name="genero" value="masculino" value="masculino"  <?php echo $genero == 'masculino' ? 'checked' : "" ?> required>
                <label for="masculino">Masculino</label><br>
                <input type="radio" name="genero" value="outro" value="outros" <?php echo $genero == 'outro' ? 'checked' : "" ?> required>
                <label for="outro">Outros</label><br>
                <br><br>
                <label for="data_nascimento"><b>Data de Nascimento:</b> </label>
                <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo $data_nasc ?>" required >
                <br><br>
                <div class="inputbox">
                    <?php 
                        if($perm == "01"){
                           echo "<input type='text' name='senha' id='senha' class='inputUser' value='$senha' required >
                                <label for='senha' class='labelInput' id='labelsenha'>Senha </label>";
                        }else{
                            echo "<p style='color: red'> você não tem permissão para acessar a senha deste usuário</p>";
                        }
                    ?>
                    
                </div>
                <p>Permissão:</p>
                <input type="radio" name="permission" value="1044613354" value="1044613354" <?php echo $permission == '1044613354' ? 'checked' : "" ?> required>
                <label for="permission">Permission Nivel 1</label><br>
                <input type="radio"  id="perm2" name="permission" value="2055724465" value="2055724465" <?php echo $permission == '2055724465' ? 'checked' : "" ?> required>
                <label for="permission" id="perm2">Permission Nivel 2</label><br>
                <input type="radio" name="permission" value="0034512345" value="0034512345"  <?php echo $permission == '0034512345' ? 'checked' : "" ?> required>
                <label for="permission">No Permission</label><br>
                <br>
                <input type="hidden" name="id" value="<?php  echo $id?>">
                <input type="hidden" name="loc" value="sistema.php">
                <input type="hidden" name="image" value="<?php echo $image ?>">
                <input type="submit" name="updata" id="updata"> 
            </fieldset>
        </form>
    </div>
</body>
</html>