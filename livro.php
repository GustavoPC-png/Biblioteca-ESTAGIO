<?php
    include "db/db.php";


    $sql = "SELECT * FROM livro l WHERE l.id = {$_GET['id']}";
    $resultado = $conn->query($sql);
    $livros = $resultado->fetch_all(MYSQLI_ASSOC);

    $sql_seriado = "SELECT livro_seriado.seriado,livro_seriado.status AS stts FROM livro_seriado WHERE livro_seriado.id_livro = {$_GET['id']}";
    $resu = $conn->query($sql_seriado);
    $series = $resu->fetch_all(MYSQLI_ASSOC);

    $sql_aluno = "SELECT * FROM livro_retirada lr WHERE lr.id_livro={$_GET['id']}";
    $resultado2 = $conn->query($sql_aluno);
    $aluno_livro = $resultado2->fetch_all(MYSQLI_ASSOC);


    if(isset($_POST['voltar'])){
        header("location: index.php");
    }
    if(isset($_POST['devolver'])){
        header("location:livroDevolve.php?id={$_GET['id']}&&serie={$_POST['seriado']}");
    }
    elseif(isset($_POST['retirar'])){
        header("location:adicionaAluno.php?id={$_GET['id']}&&serie={$_POST['seriado']}");
    }
    elseif(isset($_POST['editar'])){
        header("location:editarLivro.php?id={$_GET['id']}");
    }   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php foreach($livros as $livro) : ?>
    <title><?php echo $livro['titulo']?></title>
</head>
<body>
    <form action="" method="post">
    <div class="container">
            <div class="book-info">
                <img src="<?php echo $livro['imagem'] ?>" width="500px" height="25px" alt="Book Cover">
                <div class="caixa">
                    <p><strong>Título:</strong> <?php echo $livro['titulo']?></p>
                    <p><strong>Autor:</strong> <?php echo $livro['autor']?></p>
                    <p><Strong>Publicação:</Strong> <?php echo $livro['publicacao'];?> </p>
                    <form action="" method="post">
                    <label for="seriado">Seriados:</label>
                        <select name="seriado" id="coiso">
                        <option value="">Selecione:</option>
                            <?php foreach ($series as $serie) : ?>
                                
                                <option value="<?php echo $serie['seriado']; ?>" data-status="<?php echo$serie['stts']; ?>"><?php echo $serie['seriado']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p id="status-livro"></p>
                        <button name="retirar" id="meuBotao" class="button-32">Retirar Livro</button>
                        <button name="devolver" class="button-32">Devolver Livro</button>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var select = document.getElementById('coiso');
                                var statusLivro = document.getElementById('status-livro');
                                var botao = document.getElementsByName('retirar')[0];
                                var botaoTipo = document.getElementsByName('devolver')[0];

                                botao.style.display = "none";
                                botaoTipo.style.display = "none";



                                select.addEventListener('change', function () {
                                    var status = select.options[select.selectedIndex].getAttribute('data-status');
                                    if (status === "disponivel") {
                                        statusLivro.textContent = "Status: Disponível";
                                        botao.style.display = "block";
                                        botaoTipo.style.display = "none";
                                    } else if (status === "indisponivel") {
                                        statusLivro.textContent = "Status: Indisponível";
                                        botao.style.display = "none";
                                        botaoTipo.style.display = "block";   
                                    } else {
                                        statusLivro.textContent = "";
                                        botao.style.display = "none";
                                        botaoTipo.style.display = "none";
                                    }
                                });
                            });
                        </script>
                        <button name="editar" class="button-32">Editar Livro</button>
                        <button name='voltar' class="button-32" role="button">Voltar</button>
                            
                </div>


                <div class="alunos" style="border: 1px solid black;">
                    <p>Alunos que já retiraram o livro</p>  
                    <?php foreach($aluno_livro as $aluno) :?>
                    <p>Nome do Aluno: <?php echo $aluno['nome_aluno'];?></p>
                    <p>Turma do Aluno: <?php echo $aluno['turma'];?></p>
                    <p>Serie Retirada: <?php echo $aluno['serie'] ?></p>
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
            gap: 1rem;
            margin-right: 10px;
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
            margin-right: 20px;
            height: 1000px;
            box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.2);


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