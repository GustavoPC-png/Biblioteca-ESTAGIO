<?php
session_start();
if(!isset($_SESSION['id'])){
        header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imgs/img-removebg-preview.png" type="image/x-icon">
</head>
<body>
    <form action="" autocomplete="off">
        <header>
            <div class="top">
                <a href="index.php"><img src="imgs/img-removebg-preview.png" alt="" width="90" height="90"></a>
                <h1>Biblioteca</h1>
                <a href="logout.php">Sair da Conta</a>
            </div>
        </header>
        <div class="mid">
            <a href="formretirada.php">Marcar Aluno que Retirou Livro</a>
            <a href="alunos.php">Ver Alunos que Retiraram Livros</a>
        </div>
        <footer>
            <p>©️Escola Estadual de Ensino Fundamental Pio XII 2023</p> 
        </footer>
    </form>
</body>
</html>