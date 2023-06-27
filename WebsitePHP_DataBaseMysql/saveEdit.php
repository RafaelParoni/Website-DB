<?php 
    include_once('config.php');
    if(isset($_POST['updata'])){
        $loc = $_POST['loc'];
        $id = $_POST['id'];
        $senha = $_POST['senha'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $genero = $_POST['genero'];
        $data_nasc = $_POST['data_nascimento'];
        $perm = $_POST['permission'];
        $image = $_POST['image'];
        
        if($perm == "permission"){
            $permValue = "1044613354"; // perm 1044613354
        }else{
            $permValue = "0034512345"; // no perm 0034512345
        }

        $sqlUpdate = "UPDATE users SET username='$nome', email='$email', genero='$genero',data_nasc='$data_nasc',senha='$senha',permission='$perm', imageperfil='$image'
        WHERE id='$id' ";

        $result = $conexao->query($sqlUpdate);
        print_r($perm);
        header('location: '.$loc);
    }
    
?>