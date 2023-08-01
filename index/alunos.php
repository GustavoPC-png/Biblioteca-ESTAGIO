<?php
session_start();

$conexao = new mysqli("localhost", "root", "", "biblioteca");

if (isset($_GET['excluir_aluno'])) {
    $alunoId = $_GET['excluir_aluno'];

    $stmt_excluir_livro = $conexao->prepare("DELETE FROM livro WHERE idAluno = ?");
    $stmt_excluir_livro->bind_param("i", $alunoId);
    $stmt_excluir_livro->execute();

    $stmt_excluir_aluno = $conexao->prepare("DELETE FROM aluno WHERE id = ?");
    $stmt_excluir_aluno->bind_param("i", $alunoId);
    $stmt_excluir_aluno->execute();
}

$sql_aluno = "SELECT * FROM aluno JOIN livro ON aluno.id = livro.idAluno";
$resultado_aluno = $conexao->query($sql_aluno);
$alunos_com_livros = $resultado_aluno->fetch_all(MYSQLI_ASSOC);

$conexao->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imgs/img-removebg-preview.png" type="image/x-icon">
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
            margin: 0 auto;
            padding: 10px;
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
</head>
<body>
    <form action="alunos.php" method="get" autocomplete="off">
        <header>
            <div class="top">
                <a href="index.html"><img src="imgs/img-removebg-preview.png" alt="" width="90" height="90"></a>
                <h1>Biblioteca</h1>
            </div>
        </header>
        <div class="container">
            <?php if (isset($alunos_com_livros)) : ?>
                <?php foreach ($alunos_com_livros as $aluno) : ?>
                    <div class="aluno">
                        <div class="aluno-info">
                            <h2>Detalhes do Aluno</h2>
                            <p>Nome: <?php echo $aluno['nome']; ?></p>
                            <p>Turma: <?php echo $aluno['turma']; ?></p>
                            <p>Manhã/Tarde: <?php echo ($aluno['manha_tarde'] == 1) ? 'Manhã' : 'Tarde'; ?></p>
                        </div>
                        <div class="livro-info">
                            <h2>Detalhes do Livro</h2>
                            <p>Título: <?php echo $aluno['titulo']; ?></p>
                            <p>Autor: <?php echo $aluno['autor']; ?></p>
                            <p>Retirada: <?php echo $aluno['retirada']; ?></p>
                        </div>
                        <a href="?excluir_aluno=<?php echo $aluno['idAluno']; ?>" class="delete-btn">Livro Devolvido</a>
                        
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="coisa">Não foram encontrados dados de alunos e livros associados.</p>
            <?php endif; ?>
        </div>

        <footer>
            <p>©️Escola Estadual de Ensino Fundamental Pio XI 2023</p> 
        </footer>
    </form>
</body>
</html>
