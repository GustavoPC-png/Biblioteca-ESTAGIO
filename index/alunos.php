<?php
session_start();

    if(!isset($_SESSION['id'])){
            header("location: login.php");
    }


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

    $conexao4 = new mysqli("localhost", "root", "", "biblioteca");

    if(isset($_GET['renovar_livro'])){
        $rnvlivro = $_GET['renovar_livro'];
    
        $livroRenova = $conexao4->prepare("UPDATE aluno l SET l.retirada = NOW() WHERE id = ?");
        $livroRenova->bind_param("i", $rnvlivro);
        $livroRenova->execute();
    }    
    $conexao2 = new mysqli("localhost", "root", "", "biblioteca");

    $sql_aluno = "SELECT * FROM aluno a JOIN livro l ON l.id = a.idLivro WHERE l.id=a.idLivro;";
    $resultado_aluno = $conexao2->query($sql_aluno);
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
                <a href="index.php"><img src="imgs/img-removebg-preview.png" alt="" width="90" height="90"></a>
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
                            <p>Turno: <?php echo ($aluno['manha_tarde'] == 1) ? 'Manhã' : 'Tarde'; ?></p>
                            <p>Bibliotecario: <?php echo $aluno['nomeP']?></p>
                        </div>
                        <div class="livro-info">
                            <h2>Detalhes do Livro</h2>
                            <p>Título: <?php echo $aluno['titulo']; ?></p>
                            <p>Autor: <?php echo $aluno['autor']; ?></p>
                            <p>Retirada: <?php echo $aluno['retirada']; ?></p>
                            <?php
                                $dataRetirada = new DateTime($aluno['retirada']);
                                $hoje = new DateTime();
                                $diferenca = $hoje->diff($dataRetirada);
                                $diasAtraso = $diferenca->days;

                                if ($diasAtraso >= 7) {
                                    echo '<p>Status: <span style="color: red;">Atrasado</span></p>';
                                } else {
                                    echo '<p>Status: <span style="color: green;">Em Dia</span></p>';
                                }
                            ?>
                        </div>
                        <a href="?excluir_aluno=<?php echo $aluno['idAluno']; ?>" class="delete-btn">Livro Devolvido</a>
                        <a href="?renovar_livro=<?php echo $aluno['idAluno'];?>" class="renovar_btn">Renovar Data</a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="coisa">Não foram encontrados dados de alunos e livros associados.</p>
            <?php endif; ?>
        </div>

        <footer>
            <p>©️Escola Estadual de Ensino Fundamental Pio XII 2023</p> 
        </footer>
    </form>
</body>
</html>
