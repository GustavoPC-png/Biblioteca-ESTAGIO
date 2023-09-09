<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}

$conexao = new mysqli("localhost", "root", "", "biblioteca");

if (isset($_GET['livroE'])) {
    $sql_aluno = "SELECT * FROM livro l WHERE l.id = {$_GET['livroE']}";
    $resultado_livro = $conexao->query($sql_aluno);
    $livros = $resultado_livro->fetch_all(MYSQLI_ASSOC);
} else {
    $livros = array(); // Initialize $livros as an empty array
}
    $sql_a = "SELECT idLivro FROM aluno a";
    $resultado_a = $conexao->query($sql_a);
    $a = $resultado_a->fetch_all(MYSQLI_ASSOC);
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
<style>
* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            color: black;
        }
        .container {
            position: absolute;
            top: 13%;
            left: 25%;
            width: 800px;
        }
        .aluno {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            background-color: rgba(247, 247, 33, 0.699);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            border: none;
            border-radius: 19px;
            text-align: start;
        }
        .aluno h2 {
            margin-top: 0;
        }
        .coisa{
            display: flex;
            justify-content: center;
            color: black;
        }
</style>
<body>
    <form action="adiciona_aluno.php" method="GET" autocomplete="off">
        <header>
            <div class="top">
                <a href="index.php"><img src="imgs/img-removebg-preview.png" alt="" width="90" height="90"></a>
                <h1>Livros</h1>
            </div>
        </header>
        <div class="container">

        <a href="?livroE=1">
            <img src="https://m.media-amazon.com/images/I/51oiPQONvoL._AC_UF1000,1000_QL80_.jpg" alt="" style="width: 250px; height: 350px;">
        </a>
        <a href="?livroE=28"><img src="https://img.travessa.com.br/livro/BA/c8/c8048bc8-c8ea-44fd-b6b0-8404e17512b7.jpg" alt="" style="width: 250px; height: 350px;"></a>
        <a href="?livroE=29"><img src="https://m.media-amazon.com/images/I/A1zXXl7yQSL._AC_UF1000,1000_QL80_.jpg" alt="" style="
        height: 350px;
        width: 250px;"> </a>

        <?php foreach ($livros as $livro) : ?>
            <div class="aluno">
                <div class="aluno-info">
                    <p>Titulo: <?php echo $livro['titulo']; ?></p>
                    <p>Autor: <?php echo $livro['autor']; ?></p>
                    <p>Feedback: <?php echo $livro['feedback']; ?></p>
                    <?php
                        $bookId = $livro['id'];
                        $bookBorrowed = false;
                        foreach ($a as $borrowedBook) {
                            if ($borrowedBook['idLivro'] == $bookId) {
                                $bookBorrowed = true;
                                echo "<p>Livro já Retirado</p>";
                            }
                        }
                        if (!$bookBorrowed) : ?>
                            <a href="formretirada.php">Retirar Livro</a>
                        <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

    </form>
</body>
</html>