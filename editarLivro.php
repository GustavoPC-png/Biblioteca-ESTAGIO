<?php
    include "db/db.php";

    $sqlLivro = "SELECT * FROM livro WHERE {$_GET['id']} = id";
    $resultado = $conn->query($sqlLivro);
    $livros = $resultado->fetch_all(MYSQLI_ASSOC);

    if(isset($_POST['salvar'])){
        if($_POST['titulo'] != null && $_POST['autor'] != null){

            $uploadDir = "uploads/";
            $nomeArquivo = uniqid() . "_" . $_FILES["imagem"]["name"];
            $caminhoArquivo = $uploadDir . $nomeArquivo;
            
            if(move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoArquivo)){
            $sql = "UPDATE livro l SET l.titulo = '{$_POST['titulo']}', l.autor = '{$_POST['autor']}', l.imagem = '$caminhoArquivo' WHERE l.id = {$_GET['id']}";
            $resultado = $conn->query($sql);
            }
        }
        else{
            echo "<script> alert('Preencha todos os campos!') </script>";
        }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição do Livro</title>
</head>
<body>
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
                <h1>Edição de Livros</h1>
            </div>
        </header>
        <?php foreach($livros as $livro) : ?>
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" placeholder = "<?php echo $livro['titulo']; ?>"><br>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" placeholder="<?php echo $livro['autor'];?>"><br>
        <label for="imagem">Imagem do Livro:</label>
        <input type="file" name="imagem" accept="image/*" required><br>
        <input type="submit" name="salvar" value="Salvar Edições">
        <a href="livro.php?id=<?php echo $_GET['id']; ?>"><input type="button" value="Voltar" name="voltar"></a>
        <?php endforeach;?>
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
</body>
</html>