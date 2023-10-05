<?php
include 'db/db.php';

$sql = 'SELECT * FROM livro';
$resultado = $conn->query($sql);
$livros = $resultado->fetch_all(MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Registro'])) {

    $livro = $_POST['livroSelecionado'];
    $seriado = $_POST['seriado'];

    $sql_verificacao = "SELECT * FROM livro_seriado WHERE livro_seriado.seriado = $seriado";
    $result = $conn->query($sql_verificacao);
    if($result-> num_rows > 0){
        echo '<script>alert("Série Já Registrada!");</script>';
        $conn->close();
    } else {
        $sql_insert = "INSERT INTO livro_seriado (id_livro,seriado) VALUES ('{$livro}',$seriado);";
        $resultado2 = $conn->query($sql_insert);
        header("location: index.php");
        $conn->close();
    }
    
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="icon" href="imgs/img-removebg-preview.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #fff;
            color: #333;
        }

        .container {
            min-width: 500px;
            padding: 50px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .top {
            background-color: #fbd32b; 
            color: #333;
            text-align: center;
            padding: 20px 0;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .top img {
            margin-right: 10px;
        }

        select {
            padding: 10px;
            background-color: #ffc107; 
            color: #333;
            border: none;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 24px;
            margin: 0;
        }

        form {
            max-width: 90%;
            margin-top: 10px;
            margin:-10px 5px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"],
        input[type="button"] {
            background-color: #fbd32b; /* Amarelo */
            color: #333;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #f9c622; /* Amarelo mais escuro */
        }

        @media (min-width: 768px) {
            /* Estilos para tablets e desktops */
            h1 {
                font-size: 28px;
            }

            form {
                min-width: 400px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="top">
                <a href="index.php"><img src="imgs/img-removebg-preview.png" alt="" width="90" height="90"></a>
                <h1>Cadastro de Série em Livros</h1>
            </div>
        </header>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="livro">Escolha um Livro:</label>
            <select name="livroSelecionado" id="livro" required>
                <option value="">Selecione o Livro:</option>
                <?php foreach($livros as $livro) : ?>
                <option value="<?php echo $livro['id'] ?>"><?php echo $livro['titulo']?></option required>
                <?php endforeach; ?>
            </select>
            <label for="">Seriado:</label>
            <input type="text" id="numero" name="seriado" oninput="limitarCaracteres(this, 11)" required>
            <input type="submit" value="Cadastrar" name="Registro">
            <a href="index.php"><input type="button" value="Voltar" name="voltar"></a>
        </form>
    </div>
</body>
</html>
<script>
    function limitarCaracteres(elemento, maxCaracteres) {
      if (elemento.value.length > maxCaracteres) {
        elemento.value = elemento.value.slice(0, maxCaracteres);
      }
    }
  </script>