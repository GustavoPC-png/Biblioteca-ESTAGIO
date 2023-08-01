<?php
session_start();

$conexao = new mysqli("localhost", "root", "", "biblioteca");

// Recuperar informações dos alunos e seus livros associados
$sql_aluno = "SELECT * FROM aluno JOIN livro ON aluno.id = livro.idAluno";
$resultado_aluno = $conexao->query($sql_aluno);
$alunos_com_livros = $resultado_aluno->fetch_all(MYSQLI_ASSOC);

$conexao->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalhes dos Alunos e seus Livros</title>
</head>
<body>
    <?php if (isset($alunos_com_livros)) : ?>
        <?php foreach ($alunos_com_livros as $aluno) : ?>
            <h2>Detalhes do Aluno</h2>
            <p>ID do Aluno: <?php echo $aluno['id']; ?></p>
            <p>Nome: <?php echo $aluno['nome']; ?></p>
            <p>Turma: <?php echo $aluno['turma']; ?></p>
            <p>Manhã/Tarde: <?php echo $aluno['manha_tarde']; ?></p>

            <h2>Detalhes do Livro</h2>
            <p>ID do Livro: <?php echo $aluno['idLivro']; ?></p>
            <p>Título: <?php echo $aluno['titulo']; ?></p>
            <p>Autor: <?php echo $aluno['autor']; ?></p>
            <p>Retirada: <?php echo $aluno['retirada']; ?></p>

            <hr>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Não foram encontrados dados de alunos e livros associados.</p>
    <?php endif; ?>
</body>
</html>
