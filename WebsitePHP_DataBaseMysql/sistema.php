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
        header("location: entrar.php");
    }else{
        // 0034512345 no perm
        // 1044613354 perm(1)
        // 2055724465 perm(2)
    } 
    if($permisson == "2055724465"){

    }else{
        
    }

    // Buscando Users do DataBase

    if(!empty($_GET['search'])){ // Filtra os resultados conforme o Id,Email e o Username colocados no search do terminal
        $datsearch = $_GET['search'];
        $sql = "SELECT * FROM users WHERE id LIKE '%$datsearch%' or username LIKE '%$datsearch%' or email LIKE '%$datsearch%' or data_nasc LIKE '%$datsearch%'  ORDER BY permission DESC ";
    }else{
        $sql = "SELECT * FROM users ORDER BY id ";
    }
    $result = $conexao->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Sistema - RF</title>
    <style>
        body{
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            
        }
        .table-bg{
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }

        .box-search{
            display: flex;
            justify-content: center;
            gap: .1%;
        }
        .table-bg{
            background: rgba(0,0,0,0.5);
            border-radius: 15px 15px 0 0;
        }
        .navbar{
            position: absolute;
            top: 0px;
            left: 0px;
            background-color: rgba(0, 0, 0, 0.7);
            width: 100%;
            height: 8%;    
            display: flex; 
            border-bottom: 1px solid white;
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
            font-size: 90%;
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
            transform: translate(-50%, -50%);
        }
        .box-search{
            display: flex;
            justify-self: center;
            gap: .1%;
        }
        legend{
            color: white;
            font-family: 'Brush Script MT', cursive;
        }
    </style>
</head>
<body>
    <div class="navbar">
            <button class="buttonsNavbar" style="left: 5%;"><a style="color: white;" href="home.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                </svg> Home </a>
            </button>
            <button class="buttonsNavbar" style="left: 13%;"><a style="color: white;" href="perfil.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                </svg> Perfil </a>
            </button>
            <?php echo "<h1 class='TitleNavbar'> Bem vindo ao terminal ". $SeltPerf['username'] . "</h1>";?>
            <button class="buttonsNavbar" style="left: 95%;"><a style="color: white;" href="sair.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg> Sair </a>
            </button>
            <button class="buttonsNavbar" style="left: 89%; width: 6%; color: red; border-color: #05a8ff; "><a style="color: #05a8ff;" href="sistema.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-terminal-fill" viewBox="0 0 16 16">
                    <path d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3zm9.5 5.5h-3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm-6.354-.354a.5.5 0 1 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2a.5.5 0 1 0-.708.708L4.793 6.5 3.146 8.146z"/>
                </svg> Terminal </a>
            </button>
        </div>
    <br><br><br><br>
    <legend>Contas no Banco de Dados</legend>
    <div class="box-search">
        <input type="search" name="" id="pesquisar" class="form-control w-25" placeholder="Pesquisar no DataBase">
        <button onclick="searchData() " class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Senha </th>
                    <th scope="col">Email</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Data de nascimento</th>
                    <th scope="col">permissões</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($user_data = mysqli_fetch_assoc($result)){
                        

                        if($user_data['permission'] == "1044613354"){
                            $perm = "permission[1]";
                        }else if($user_data['permission'] == "2055724465"){
                            $perm = "permission[2]";
                        }else{
                            $perm = "Not permission";
                        } 

                        if($permisson == "2055724465"){
                            $passworldgohst = $user_data['senha'];
                        }else{
                            $passworldgohst = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='red' class='bi bi-eye-slash-fill'viewBox='0 0 16 16'><path d='m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z'/><path d='M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z'/></svg>";
                        }

                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['username']."</td>";
                        echo "<td> ".$passworldgohst." </td>";
                        echo "<td>".$user_data['email']."</td>";
                        echo "<td>".$user_data['genero']."</td>";
                        echo "<td>".$user_data['data_nasc']."</td>";
                        echo "<td>".$perm."</td>";
                        echo "<td> 
                            <a class='btn btn-sm btn-primary' href='sistema-edit.php?id=$user_data[id]'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-brush-fill' viewBox='0 0 16 16'>
                                    <path d='M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.067 6.067 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.118 8.118 0 0 1-3.078.132 3.659 3.659 0 0 1-.562-.135 1.382 1.382 0 0 1-.466-.247.714.714 0 0 1-.204-.288.622.622 0 0 1 .004-.443c.095-.245.316-.38.461-.452.394-.197.625-.453.867-.826.095-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.201-.925 1.746-.896.126.007.243.025.348.048.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.176-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04z'/>
                                </svg>
                            </a>   
                            <a class='btn btn-sm btn-danger' href='sistema-delete.php?id=$user_data[id]'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                </svg>
                            </a>
                            </td>";
                        echo "</tr>";
                    }
                    
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    var search = document.getElementById('pesquisar');
    search.addEventListener("keydown", function(event) {
        if(event.key === "Enter")
        {
            searchData();
        }
    });

    function searchData(){
        window.location = 'sistema.php?search=' + search.value ;
    }
</script>

</html>