  <?php
  include("db/db.php");
  include "processa_pesquisa.php";
      $sql="SELECT * FROM livro";
      $resultado = $conn->query($sql);
      $livros = $resultado->fetch_all(MYSQLI_ASSOC);

      if(isset($_POST['registro'])){
        header("location: cadastrar_livro.php");
      }

      $sqlAlunosComLivro = "SELECT *, day(lr.data_retirada) AS dia, month(lr.data_retirada) as mes FROM livro_retirada lr WHERE  lr.data_retirada < (DATE_SUB(NOW(), INTERVAL 7 DAY)) AND lr.status = 'pendente'";
      $result = $conn->query($sqlAlunosComLivro);
      $alunosComLivro = $result->fetch_all(MYSQLI_ASSOC);

      if(isset($_POST['pesquisa'])){
        $pesquisa = $_POST['pesquisa'];  
        $sqlPesquisa = "SELECT * from livro WHERE livro.titulo LIKE '%{$pesquisa}%'";
        $resultadoPesquisa = $conn->query($sqlPesquisa);
        $livrosPesquisados = $resultadoPesquisa->fetch_all(MYSQLI_ASSOC);
      }
  $conn->close();
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="icon" href="imgs/img-removebg-preview.png" type="image/x-icon">
    
</head>
<body>
    <form action="" autocomplete="off" method="post">
        <header>
            <div class="top"> 
                <h1>Biblioteca</h1>
            </div>
        </header>
        <div class="boxBig">
        <?php if($result) {
          foreach($alunosComLivro as $aluno) : 
          ?>
          <a href="livro.php?id=<?php echo $aluno['id_livro'] ?>"><div class="aluno">
            <div class="aluno-info">
                <h2><?php echo $aluno['nome_aluno'];?></h2>
                <p><?php echo $aluno['turma'];?></p>
                <p>O aluno realizou a retirada do livro no dia <?php echo $aluno['dia'];?>/<?php echo $aluno['mes']?> e, até o momento, não efetuou a devolução</p>
            </div>
          </div>
          </a>
          <?php endforeach;}?>
          </div>

        <input type="search" name="pesquisa" id="pesquisa" placeholder="Pesquisa">

        <?php if(!isset($livrosPesquisados) && empty($livrosPesquisados)) : ?>
           <div class="lista-livros">
        <?php foreach($livros as $livro) : ?>
            <div class="livro">
                <a href="livro.php?id=<?php echo $livro['id'];?>">
                    <img src="<?php echo $livro['imagem']?>" alt="" width="250px" height="500px">
                </a>
                <p style="font-size: 20px;"><?php echo $livro['titulo'];?></p>
            </div>
        <?php endforeach; ?>
        <?php endif;?>


        <?php if (isset($livrosPesquisados) && !empty($livrosPesquisados)) : ?>
        <div class="lista-livros">
            <?php foreach ($livrosPesquisados as $livroa) : ?>
                <div class="livro">
                    <a href="livro.php?id=<?php echo $livroa['id']; ?>">
                        <img src="<?php echo $livroa['imagem'] ?>" alt="" width="250px" height="500px">
                    </a>
                    <p style="font-size: 20px;"><?php echo $livroa['titulo']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if(isset($livrosPesquisados) && empty($livrosPesquisados)) {
              echo "<p style='text-align: center;'>Nenhum livro encontrado.</p>";

        } ?>
        <a class="coiso" href="cadastrar_livro.php">Registrar Novo Livro</a>
    </form>
    <div class="pe">
    <footer>
        <p>©️Escola Estadual de Ensino Fundamental Pio XII 2023</p> 
    </footer>
    </div>
</body>
</html>
<style>
p{
  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
      html, body, h1, h2, h3, p, ul, li {
    margin: 0;
    padding: 0;
  }


  input[type="search"] {
    display: flex;
    justify-content: center;
    align-items: center;
  }



  #pesquisa {
              padding: 10px;
              width: 250px;
              border: 1px solid #ccc;
              border-radius: 5px;
              font-size: 16px;
          }
          #pesquisa:focus {
              outline: none;
              border-color: #007bff;
              box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
          }
          .lista-livros {
              display: flex;
              flex-wrap: wrap;
              justify-content: center;
              gap: 20px;
          }

          .livro {
              text-align: center;
              background-color: #f5f5f5;
              border: 1px solid #ddd;
              padding: 20px;
              border-radius: 5px;
              width: 250px;
              box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          }
          .livro p {
              margin: 10px 0;
              font-size: 16px;
          }

          .livro a {
              text-decoration: none;
              color: #333;
          }
          .livro:hover {
              transform: translateY(-5px);
              box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
          }
  .aluno {
      display: flex;
      flex-direction: row;
      position: relative;
      top: 0;
      left: -100%; 
      width: 300px;
      background-color: #007bff;
      color: #fff;
      padding: 10px;
      z-index: 1000; 
      animation: slideIn 0.5s forwards; 
      margin-right: 5px;
      margin-bottom: 5px;
      text-decoration: none;
  }
  a{
    text-decoration: none;
  }
  .aluno:hover {
      cursor: pointer;
      background-color: #0056b3;
  }


  .aluno-info {
      padding-left: 10px;
      text-decoration: none;
  }


  .aluno a {
      color: #fff;
      text-decoration: none;
  }
  @keyframes slideIn {
      from {
          left: -100%; 
      }
      to {
          left: 0; 
      }
  }
  .boxBig{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
  }
  .top{
      display: flex;
      justify-content: center;
      flex-direction: row;
      gap: 10vw;
      font-size: 30px;
  }
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
  }

  header {
    background-color: #FFD700;
    color: #fff;
    text-align: center;
    padding: 10px;
  }

  header h1 {
    font-size: 24px;
  }

  header a {
    color: #fff;
    text-decoration: none;
    margin: 0 10px;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  .container a {
    margin: 10px;
    text-decoration: none;
  }

  .container img {
    max-width: 200px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  .pe{
    width: 100%;
    margin: 20px; 
  }
footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    text-align: center;
    background-color: #3498db;
    color: #fff;
    padding: 10px;
    height: 10px;
}

  .coiso{
    position: fixed;
      bottom: 40px;
      left: 0;
      background-color: #fbd32b;
      color: #333;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      font-weight: bold;
  }

  @media screen and (max-width: 768px) {
    header {
      font-size: 18px;
    }

    .container img {
      max-width: 150px;
    }
    
    }
    
  </style>