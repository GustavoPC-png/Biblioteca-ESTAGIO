<?php
session_start();

if (isset($_POST['nome']) && isset($_POST['turma']) && isset($_POST['manha_tarde'])) {
    $conexao = new mysqli("localhost", "root", "", "biblioteca");

    $sql_aluno = "INSERT INTO aluno (nome, turma, manha_tarde) VALUES (?, ?, ?)";
    $stmt_aluno = $conexao->prepare($sql_aluno);
    $stmt_aluno->bind_param("sss", $_POST['nome'], $_POST['turma'], $_POST['manha_tarde']);

    if ($stmt_aluno->execute()) {
        $idAluno = $conexao->insert_id;

        if (isset($_POST['titulo']) && isset($_POST['autor']) && isset($_POST['retirada'])) {
            $conexao2 = new mysqli("localhost", "root", "", "biblioteca");

            $sql_livro = "INSERT INTO livro (titulo, autor, retirada, idAluno) VALUES (?, ?, ?, ?)";
            $stmt_livro = $conexao2->prepare($sql_livro);
            $stmt_livro->bind_param("sssi", $_POST['titulo'], $_POST['autor'], $_POST['retirada'], $idAluno);

            if ($stmt_livro->execute()) {
                echo "<script>alert('Aluno e livro cadastrados com sucesso!');</script>";
            } else {
                echo "Erro ao inserir livro: " . $conexao2->error;
            }

            $stmt_livro->close();
            $conexao2->close();
        }
    } 
    $stmt_aluno->close();
    $conexao->close();
} else {
    echo "Dados incompletos para inserir o aluno.";
}

header("location: index.html");
?>