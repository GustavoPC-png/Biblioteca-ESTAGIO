<?php
    $conexao = new mysqli("localhost","root","","biblioteca");
        
    $sql = "SELECT * FROM professor WHERE email = '{$_POST['email']}' and senha = '{$_POST['senha']}'";
    
    $resultado = $conexao->query($sql);

    $professor = $resultado->fetch_all(MYSQLI_ASSOC);
    
    if(count($professor)==0){
        header("location: registro.php");
    }else{
        session_start();
        $_SESSION['id'] = $professor[0]['id'] ;
        $_SESSION['nome'] =  $professor[0]['nome'];
        header("location: index.php");
    }

?>