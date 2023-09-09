<?php
session_start();

if (isset($_POST['nome']) && isset($_POST['turma']) && isset($_POST['manha_tarde']) && isset($_POST['retirada']) && isset($_POST['livroEscolhido'])) {
    $conexao = new mysqli("localhost", "root", "", "biblioteca");

    $sql_aluno = "INSERT INTO aluno (nome, turma, manha_tarde) VALUES (?, ?, ?)";
    $stmt_aluno = $conexao->prepare($sql_aluno);
    $stmt_aluno->bind_param("sss", $_POST['nome'], $_POST['turma'], $_POST['manha_tarde']);
    
    if ($stmt_aluno->execute()) {
        $idAlunoInserido = $conexao->insert_id; // Obtém o ID do aluno inserido
        $stmt_aluno->close();

        $sql_livro = "INSERT INTO livro (idAluno) VALUES (?)";
        $stmt_livro = $conexao->prepare($sql_livro);
        $stmt_livro->bind_param("i", $idAlunoInserido);

        if ($stmt_livro->execute()) {
            echo "<script>alert('Aluno e livro cadastrados com sucesso!');</script>";
        } else {
            echo "Erro ao inserir livro: " . $conexao->error;
        }

        $stmt_livro->close();
    } else {
        echo "Erro ao inserir aluno: " . $conexao->error;
    }

    $conexao->close();
} else {
    echo "Dados incompletos para inserir o aluno e o livro.";
}

header("location: index.php");
?>
