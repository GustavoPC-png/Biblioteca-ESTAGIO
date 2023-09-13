<?php
    include "db/db.php";

    $sql = "SELECT * from livro l WHERE l.id = {$_GET['id']}";
    $resultado = $conn->query($sql);
    $livros = $resultado->fetch_all(MYSQLI_ASSOC);

    $sql_aluno = "SELECT * FROM livro_retirada lr WHERE lr.id_livro={$_GET['id']}";
    $resultado2 = $conn->query($sql_aluno);
    $aluno_livro = $resultado2->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <style>
               body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
           background-color: rgba(251, 251, 76, 0.977);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .book-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
            margin: 10px;
            display: flex;
        }

        .book-info img {
            max-width: 100%;
            height: auto;
        }

        .book-details {
            flex: 1;
            padding-left: 20px;
        }

        .book-details p {
            margin: 10px 0;
        }

        .status-available {
            color: green;
        }

        .status-unavailable {
            color: red;
        }

        @media (max-width: 768px) {
            .book-info {
                flex-direction: column;
            }
            .book-details {
                padding-left: 0;
                margin-top: 10px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                padding: 40px;
            }
        }
        button{
            background-color: #fbd32b; /* Amarelo */
            color: #333;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
}
    </style>
</head>
<body>
    <div class="container">
        <?php foreach($livros as $livro) : ?>
            <div class="book-info">
                <img src="<?php echo $livro['imagem'] ?>" alt="Book Cover">
                <div class="caixa">
                    <p><strong>Título:</strong> <?php echo $livro['titulo']?></p>
                    <p><strong>Autor:</strong> <?php echo $livro['autor']?></p>
                    <?php if($livro['status']=="disponivel") : ?>
                        <p class="status-available">Disponível</p>
                    <?php elseif($livro['status']=="indisponivel") :?>
                        <p class="status-unavailable">Indisponível</p>
                    <?php endif ?>
                    <a href="adicionaAluno.php?id=<?php echo $_GET['id']?>"><button>Retirar Livro</button></a>
                    
                </div>
                <div class="alunos" style="border: 1px solid black;">
                    <p>Alunos que Ja pegaram o livro</p>
                    <?php foreach($aluno_livro as $aluno) :?>
                    <p>Nome do Aluno: <?php echo $aluno['nome_aluno'];?></p>
                    <p>Turma do Aluno: <?php echo $aluno['turma'];?></p>
                    <p>Data da Retirada: <?php echo $aluno['data_retirada'];?></p>
                    <p>Data de Entrega: </p>
                    <hr>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</body>
</html>
