<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.php");
}

$conexao = new mysqli("localhost", "root", "", "biblioteca");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $turma = $_POST["turma"];
    $manha_tarde = $_POST["manha_tarde"];
    $retirada = $_POST["retirada"];
    $livroEscolhido = $_POST["livroEscolhido"];

    // Inserir o aluno no banco de dados
    $sql_aluno = "INSERT INTO aluno (nome, turma, manha_tarde) VALUES (?, ?, ?)";
    $stmt_aluno = $conexao->prepare($sql_aluno);
    $stmt_aluno->bind_param("ssi", $nome, $turma, $manha_tarde);
    $stmt_aluno->execute();
    $alunoId = $stmt_aluno->insert_id; // Pegar o ID do aluno recém-inserido
    $stmt_aluno->close();

    // Atualizar o status do livro para indisponível e associar ao aluno
    $sql_atualiza_livro = "UPDATE livro SET status = 'indisponivel', idAluno = ? WHERE id = ?";
    $stmt_atualiza_livro = $conexao->prepare($sql_atualiza_livro);
    $stmt_atualiza_livro->bind_param("ii", $alunoId, $livroEscolhido);
    $stmt_atualiza_livro->execute();
    $stmt_atualiza_livro->close();

    // Redirecionar para a página inicial
    header("location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="style34.css">
    <link rel="icon" href="imgs/img-removebg-preview.png" type="image/x-icon">
</head>
<body>
    <form action="" method="post" autocomplete="off">
        <header>
            <div class="top">
                <a href="index.php"><img src="imgs/img-removebg-preview.png" alt="" width="90" height="90"></a>
                <h1>Biblioteca</h1>
            </div>
        </header>
        <div class="container">
        <div class="mid1">
        <div class="inputbox">
    <input type="text" name="nome" required>
    <label for="">Nome do Aluno:</label>
</div>
<div class="inputbox">
    <input type="number" name="turma" required>
    <label for="turma">Turma:</label>
</div>
<div class="inputbox">
    <div class="custom-select yellow">
        <select name="manha_tarde">
            <option value="" selected disabled>Selecione o Turno</option>
            <option value="1">Manhã</option>
            <option value="2">Tarde</option>
        </select>
    </div>
</div>
<div class="mid2">
<div class="inputbox">
            <div class="custom-select yellow">
                <select name="livroEscolhido">
                    <option value="" selected disabled>Escolha um Livro</option>
                    <?php
                    while ($livro_disponivel = $result_livros_disponiveis->fetch_assoc()) {
                        echo "<option value='" . $livro_disponivel['id'] . "'>" . $livro_disponivel['titulo'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>


            <div class="inputbox">
                <h4 for="">Data da Retirada:</h4>
                <input type="date" name="retirada" required>    
        </div>
        <div class="bttn">
            <button class="btn-one">Enviar</button>
        </div>
        </div>
        </div>
        </div>
    </form>
</body>
</html>