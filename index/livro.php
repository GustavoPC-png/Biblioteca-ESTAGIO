<?php
    include "db/db.php";

    $sql = "SELECT * from livro l WHERE l.id = {$_GET['id']}";
    $resultado = $conn->query($sql);
    $livros = $resultado->fetch_all(MYSQLI_ASSOC);

    $sql_aluno = "SELECT * FROM livro_retirada lr WHERE lr.id_livro={$_GET['id']}";
    $resultado2 = $conn->query($sql_aluno);
    $aluno_livro = $resultado2->fetch_all(MYSQLI_ASSOC);
    
    if(isset($_POST['voltar'])){
        header("location: index.php");
    }
    if(isset($_POST['devolver'])){
        header("location:livroDevolve.php?id={$_GET['id']}");
    }
    elseif(isset($_POST['retirar'])){
        header("location:adicionaAluno.php?id={$_GET['id']}");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php foreach($livros as $livro) : ?>
    <title><?php echo $livro['titulo']?></title>
    <style>
               body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
           background-color: rgba(251, 251, 76, 0.977);
        }
        .caixa{
            display: flex;
            flex-direction: column;
            position: relative;
            width: 250px;
            height: 250px;
            gap: 2rem;
            margin-right: 20px;
        }
        .caixa p{
            padding: 20px;
        }
        .alunos{
            width: 450px;
            min-height: 250px;
            text-align: center;
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


/* CSS */
.button-32 {
  background-color: #fff000;
  border-radius: 12px;
  color: #000;
  cursor: pointer;
  font-weight: bold;
  padding: 10px 15px;
  text-align: center;
  transition: 200ms;
  width: 100%;
  box-sizing: border-box;
  border: 0;
  font-size: 16px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-32:not(:disabled):hover,
.button-32:not(:disabled):focus {
  outline: 0;
  background: #f4e603;
  box-shadow: 0 0 0 2px rgba(0,0,0,.2), 0 3px 8px 0 rgba(0,0,0,.15);
}

.button-32:disabled {
  filter: saturate(0.2) opacity(0.5);
  -webkit-filter: saturate(0.2) opacity(0.5);
  cursor: not-allowed;
}
    </style>
</head>
<body>
    <form action="" method="post">
    <div class="container">
            <div class="book-info">
                <img src="<?php echo $livro['imagem'] ?>" width="500px" alt="Book Cover">
                <div class="caixa">
                    <p><strong>Título:</strong> <?php echo $livro['titulo']?></p>
                    <p><strong>Autor:</strong> <?php echo $livro['autor']?></p>
                    <?php if($livro['status']=="disponivel") : ?>
                        <p class="status-available">Status: Disponível</p>
                        <button class="button-32" role="button" name="retirar">Retirar Livro</button></a>
                    <?php elseif($livro['status']=="indisponivel") :?>
                        <p class="status-unavailable">Status: Indisponível</p>
                        <button class="button-32" role="button" name="devolver">Devolver Livro</button></a>
                    <?php endif ?>

                    <button name='voltar' class="button-32" role="button">Voltar</button>
                        
                </div>
                <div class="alunos" style="border: 1px solid black;">
                    <p>Alunos que Ja pegaram o livro</p>
                    <?php foreach($aluno_livro as $aluno) :?>
                    <p>Nome do Aluno: <?php echo $aluno['nome_aluno'];?></p>
                    <p>Turma do Aluno: <?php echo $aluno['turma'];?></p>
                    <p>Data da Retirada: <?php echo $aluno['data_retirada'];?></p>
                    <?php if($aluno['status']=="pendente") : ?>

                    <p style="color:red;">Status da Entrega: PENDENTE</p>
                    <?php endif ?>
                    <?php if($aluno['status']=="entregue") : ?>
                        <p style="color:grenn;">Data da Entrega: <?php echo $aluno['data_entrega'];?></p>
                    <?php endif ?>
                    <hr>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    </form>
</body>
</html>
