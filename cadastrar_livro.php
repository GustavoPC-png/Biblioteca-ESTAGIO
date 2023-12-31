<?php
require_once("db/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $publicacao = $_POST['publicacao'];

    $sql_verificacao = "SELECT * FROM livro WHERE titulo = '$titulo'";
    $resultado_verificacao = $conn->query($sql_verificacao);

    if ($resultado_verificacao->num_rows > 0) {
        echo '<script>alert("Título já registrado!");</script>';
    } else {
        $uploadDir = "uploads/";
        $nomeArquivo = uniqid() . "_" . $_FILES["imagem"]["name"];
        $caminhoArquivo = $uploadDir . $nomeArquivo;

        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoArquivo)) {
            $sql = "INSERT INTO livro (titulo, autor, publicacao ,imagem) VALUES ('$titulo', '$autor', '$publicacao' ,'$caminhoArquivo')";
            $resultado = $conn->query($sql);

            if ($resultado) {
                header("location: index.php");
            } else {
                echo "Erro ao cadastrar o livro: " . $conn->error;
            }
        }
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
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data">
        <header>
            <div class="top">
                <a href="index.php"><img src="imgs/img-removebg-preview.png" alt="" width="90" height="90"></a>
                <h1>Cadastro de Livros</h1>
            </div>
        </header>
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" required><br>
        <label for="autor">Publicação:</label>
        <input type="text" name="publicacao" required><br>
        <label for="imagem">Imagem do Livro:</label>
        <input type="file" name="imagem" accept="image/*" required><br>
        <input type="submit" value="Cadastrar">
        <a href="index.php"><input type="button" value="Voltar" name="voltar"></a>
    </form>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.top{
    background-color: #fbd32b; /* Amarelo */
    color: #333;
    text-align: center;
    padding: 20px 0;
    border-radius: 6px;
}

.top {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.top a img {
    margin-right: 10px;
}

h1 {
    font-size: 24px;
    margin: 0;
}

form {
    max-width: 90%;
    margin: 0 auto;
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
        min-width: 600px;
    }
}

</style>