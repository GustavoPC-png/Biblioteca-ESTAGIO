<?php

    $conexao = new mysqli("localhost","root","","biblioteca");

    $sql = "INSERT INTO professor (nomeP,email,senha) 
    VALUES ('{$_POST['nome']}','{$_POST['email']}','{$_POST['senha']}')";

    $conexao->query($sql);

    header("location: login.php");

?>