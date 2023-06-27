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

    

    
    // Buscando a DataBase do user logado
    $sqlSelect = "SELECT * FROM users
    WHERE email='$logado' ";

    $resultSelect = $conexao->query($sqlSelect);
    $SeltPerf = mysqli_fetch_assoc($resultSelect);

    $permisson = $SeltPerf['permission'];
    if($permisson == "0034512345"){
       echo '<style>
        #terminalbutton{visibility: hidden !important;}
        </style>';
    }else{
        echo '<style>
        #terminalbutton{visibility: visible !important;}
        </style>';
        // 0034512345 no perm
        // 1044613354 perm
    } 

    if($SeltPerf['imageperfil'] == null){
        $image = "perfilimagenull.webp";
    }else{
        $image= $SeltPerf['imageperfil'];
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Home - RF</title>
    <style> 
        body{
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            font-family: Helvetica;
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
            position:absolute;
            background-color: rgba(0, 0, 0, 0.8);
            top: 60px;
            width: 300px;
            padding-bottom: 10px;
            height: auto;
            right: 4%;
            border-radius: 2%;
        }
        .DivProfile
        .ProfileImage{
            cursor: pointer;
            position: relative;
            left: 100px;
            top: 15px;
            height: 100px;
            width: 100px;
            border-radius: 50px;
        }
        .ProfileName{
            cursor: pointer;
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
            
       }
       .buttonProfiel:hover{
            cursor: pointer;
            height: 30px;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.9);
       }
       .textButtonsProf{
            position: relative;
            background-color: transparent;
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
         .DivPag{
            background-color: transparent;
            
            top: 80px;
            width: 100%;
            height: 90%;
            position: none;
            
         }
         .PagTitle{
            text-align: center;
         }
         .PagCont{
            background-color: transparent;
            
            width: 100%;
            position: none;
            height: auto;
            display: flex;
            flex-wrap: wrap;
         }
         .Box-list{
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            width: 300px;
            height: 200px;
            margin: 50px;
         }
         .Box-list:hover{
            transition: 0.3s;
            box-shadow: 1px 2px 2px 1px black;
            cursor: pointer;
         }
   
         .TextBox{
            position: relative;
            background-color: transparent;
            width: 100%;
            height: 160px;
            top: 0px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.9);
            display: inline-block;
         }
         .TitleBox{
            position: relative;
            left: 90px;
            top: -40px;
            font-size: 30px;
         }
         .DescBox{
            position: relative;
            left: 10px;
            top: -60px;
            font-size: 15px;
            color: #797878;
            background-color: transparent;
            width: 90%;
         }
         .IconBox{
            position: relative;
            top: 20px;
            left: 20px;
         }
         .IconBoxCreate{
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
         }
         .TagBox{
            position: relative;
            background-color: transparent;
            width: 300px;
            height: 50px;
            display: flex;
            flex-wrap: wrap;
        }
        .tag{
            top: -10px;
            left: 35px;
            margin-left: 5px;
            margin: none;
            position: relative;
            background-color: rgba(0, 0, 0, 0.8);
            width: 100px;
            height: auto;
            text-align: center;
            border-radius: 5px;
            padding: 3px;
        }
        .CenterDiv{
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid black;
            border-radius: 15px;
            position: none;
            width: 64%;
            margin-left: 15%;
            height: auto;
            display: flex;
            flex-wrap: wrap;
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
        <h1 class="TitleNavbar">Home</h1>
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
    <br><br><br><br><br>

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