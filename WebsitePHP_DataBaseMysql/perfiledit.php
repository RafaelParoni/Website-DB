<?php 
session_start();
include_once("config.php");
    // print_r($_SESSION);
    if((!isset($_SESSION['email'])== true) and (!isset($_SESSION['senha']) == true))
    {   
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header("location: entrar.php");
    }
    $logado = $_SESSION['email'];

    $sqlSelect = "SELECT * FROM users
    WHERE email='$logado' ";

    $resultSelect = $conexao->query($sqlSelect);
    $SeltPerf = mysqli_fetch_assoc($resultSelect);

    $image = $SeltPerf['imageperfil'];
    $id = $SeltPerf['id'];
    $senha = $SeltPerf['senha'];
    $nome = $SeltPerf['username'];
    $email = $SeltPerf['email'];
    $genero = $SeltPerf['genero'];
    $data_nasc = $SeltPerf['data_nasc'];
    $perm = $SeltPerf['permission']; 
    if($perm == "1044613354"){ 
        $permissionValue = 'Conta Moderador!';
        echo '<style>
        #terminalbutton{visibility: visible !important;}
        </style>';
    }else{
        $permissionValue = 'Conta users!';
        echo '<style>
        #terminalbutton{visibility: hidden !important;}
        </style>';
    };
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Perfil - <?php echo $SeltPerf['username']?> </title id="title">
    <style>
        body{
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            font-family: Helvetica;
        }
        .box{
            position: none;
            margin-top: 150px;
            margin-left: 23%;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px;
            border-radius: 15px;
            width: 950px;
            height: 600px;
            color: black;
        }
        .boxperf{
            position: relative;
            background-color: white;
            border-radius: 15px;
            width: 300px;
            height: 600px;
        }
        .imgperf{
            position: relative;
            height: 100px;
            width: 100px;
            top: 5%;
            left: 50%;
            transform: translate(-50%);  
        }
        .nameperf{
            position: relative;
            top: 5%;
            text-align: center;
        }
        .descperf{
            position: relative;
            top: 2%;
            text-align: center;
        }
        .topperf{
            position: absolute;
            top: 0px;
            width: 300px;
            color: #858585;
            text-align: center;
        }
        .bottonperf{
            position: absolute;
            width: 300px;
            bottom: 0px;
            text-align: center;
        }
        .form{
            position: none;
            width: 600px;
            margin-top: -600px;
            margin-left: 330px ;
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
                /* Nav Bar */
                .navbar{
            position: absolute;
            top: 0px;
            left: 0px;
            background-color: rgba(0, 0, 0, 0.7);
            width: 100%;
            height: 80px;    
            display: flex; 
            
        }
        .buttonsNavbar{      
            position: absolute;  
            left: 5%;
            top: 50%;
            transform: translate(-50%, -50%);
            height: 100%;
            width: 5%;
            color: white;
            background: transparent;
            border: none;
            font-size: 20px;
            border-bottom: 0px solid white;
        }
        .buttonsNavbar:hover,
        .buttonsNavbar:focus{
            transition: 0.1s;
            border-bottom: 5px solid white;
            
        }
        .TitleNavbar{
            position: absolute;  
            color: white;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -100%);
        }
        .NavBarImage{
            width: 45%;
            height: 45%;
            border-radius: 50px;
            cursor: pointer;
        }
        .buttonsImage{      
            position: absolute;  
            left: 5%;
            top: 50%;
            transform: translate(-50%, -50%);
            height: 100%;
            width: 5%;
            color: white;
            background: transparent;
            border: none;
            font-size: 90%;
        }
        .DivProfile{
            visibility: hidden;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.8);
            top: 60px;
            width: 300px;
            padding-bottom: 10px;
            height: auto;
            right: 4%;
            border-radius: 2%;
            
        }
        .ProfileImage{
            position: relative;
            left: 100px;
            top: 15px;
            height: 100px;
            width: 100px;
            border-radius: 50px;
        }
        .ProfileName{
            position: relative;
            text-align: center;
            top: 10px;
            color: white;
        }
        .ProfileEmail{
            position: relative;
            text-align: center;
            color: #797878;
        }
       .buttonProfiel{
            height: 30px;
            width: 100%;
            background-color: transparent;
       }
       .buttonProfiel:hover{
            cursor: pointer;
            height: 30px;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.9);
       }
       .textButtonsProf{
            position: relative;
            padding: 3px;
            top: 5px;
            left: 10px;
       }
        #linha-horizontal {
            width: 99.7%;
            border-top: 0.1px solid #707070;
        }
        .button-sair{
            left: 120px;
        }
        .X{
            position: absolute;
            color: red;
            background-color: transparent;
            top: -15px;
            cursor: pointer;
        }
         /* Nav Bar */
        .text-red{
            color: red;
        }
    </style>
</head>
<body>
    <!- Inicio Navbar ->
        <div class="navbar">
        <button class="buttonsNavbar" style="left: 5%; color: red; border-color: #05a8ff; "><a style="color: #05a8ff;" href="home.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
            </svg> Home </a>
        </button>
        <h1 class="TitleNavbar">Edit perfil: <?php echo $SeltPerf['username']?></h1>
        <button class="buttonsImage" style="left: 95%;"><a onclick="IconPerfil()">
            <?php echo "<img src='".$image."' class='NavBarImage'>"?> </a>
        </button>
        <button class="buttonsNavbar" style="left: 89%; width: 6%;" id="terminalbutton"><a style="color: white;" href="sistema.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-terminal-fill" viewBox="0 0 16 16">
                <path d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3zm9.5 5.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm-6.354-.354a.5.5 0 1 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2a.5.5 0 1 0-.708.708L4.793 6.5 3.146 8.146z"/>
            </svg> Terminal </a>
        </button>
    </div>
        <div class="DivProfile" tabindex="-1"  id="divprofile">
        <p class="X" onclick="IconPerfil()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
        </svg>
        </p>
        <?php echo "<img src='".$image."' class='ProfileImage'>"?> 
        <?php echo "<h3 class='ProfileName'>". $SeltPerf['username']."</h3>"?> 
        <?php echo "<h5 class='ProfileEmail'>". $SeltPerf['email']."</h5>"?>
        <div class='buttonProfiel' onclick="perfil()">
            <a class="textButtonsProf">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg> Perfil 
            </a>
        </div>
        <div class='buttonProfiel' onclick="Editperfil()">
            <a class="textButtonsProf">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg> Editar informações de perfil 
            </a>
        </div>
        <div id="linha-horizontal"></div>
        <br>
        <div class='buttonProfiel' onclick="sair()">
            <a class="textButtonsProf button-sair">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                </svg> Sair
            </a>
        </div>
    </div>
    <!- Final Navbar ->
    <div class="box">
        <div class="boxperf">
        <?php echo  "<p class='topperf'> ID:".$SeltPerf['id']."</p> "?>
        <?php echo "<img class='imgperf' src='".$image."'> "?> 
        <?php echo "<h2 class='nameperf'> ".$SeltPerf['username']."</h2>" ?>
        <?php echo "<h5 class='descperf'>".$SeltPerf['email']."</h5>" ?>
        <?php echo "<p class='bottonperf'>".$permissionValue."</p>" ?>
        </div>
        <div>
            <form class="form" action="saveEdit.php" method="POST">
                <fieldset>
                    <legend>Edite seus dados</legend>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $nome ?>" required >
                        <label for="nome" class="labelInput" >Nome do usuário </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="url" name="image" id="image" class="inputUser" value="<?php echo $image ?>">
                        <label for="image" class="labelInput" >Foto de perfiil - url(.png/.jpg/.gif) <a class="text-red">.webp não é compatível!<a></label>
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
                    <br>
                    <br>
                    <div class="inputbox">
                        <input type="text" name="senha" id="senha" class="inputUser" value="<?php echo $senha ?>" required >
                        <label for="senha" class="labelInput" id='labelsenha'>Senha </label>
                    </div>
                    <br><br>
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="hidden" name="loc" value="perfiledit.php">
                    <input type="hidden" name="permission" value="<?php echo $SeltPerf['permission']?>">
                    <input type="submit" name="updata" id="updata"> 
                </fieldset>
            </form>
        </div>
    </div>
</body>
<script>
    function IconPerfil(){
        var style = window.getComputedStyle(document.getElementById("divprofile")).visibility 
        console.log(style);
        if(style == "hidden"){
            document.getElementById('divprofile').style.visibility = "visible"
        }else{
            document.getElementById('divprofile').style.visibility = "hidden"
        }
        
    }
    function Editperfil(){
        window.location = "perfiledit.php"
    }
    function perfil(){
        window.location = "perfil.php"
    }
    function sair(){
        window.location = "sair.php"
    }
</script>
</html>