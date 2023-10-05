<?php
    include ("db/db.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome_aluno'];
    $turma = $_POST['turma'];

    $sql = "INSERT INTO livro_retirada (nome_aluno, turma, id_livro,serie,data_retirada) VALUES ('$nome', $turma, {$_GET['id']},{$_GET['serie']} ,NOW())";

        if(isset($_POST['enviar'])){
        $resultado = $conn->query($sql);
        if($resultado){
            $sql_up = "UPDATE livro_seriado l SET l.status = 'indisponivel' WHERE l.id_livro = {$_GET['id']} AND l.seriado = {$_GET['serie']};";
            $enviar = $conn->query($sql_up);
            header("location: index.php");
        }
    }
    if(isset($_POST['voltar'])){
      
        header("location: livro.php?id={$_GET['id']}");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Aluno</title>
</head>
<body>
    <form action="" method="POST">
        <label for="">Nome do Aluno:</label>
        <input type="text" name="nome_aluno" id="nome_aluno">
        <label for="">Turma:</label>
        <input type="number" name="turma" id="turma">
        <input type="submit" value="Enviar" name="enviar">
        <input type="submit" value="Voltar" name="voltar">
    </form>
</body>
</html>
<style>
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 0;
}

form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="number"] {
  width: 95%;
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

input[type="submit"] {
  background-color: #fff000;
  color: #fff;
  border: none;
  border-radius: 3px;
  padding: 10px 50px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #2187c4;
}

html, body {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

form > * {
  margin-top: 10px;
}
</style>