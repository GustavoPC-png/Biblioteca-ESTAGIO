<?php
    include ("db/db.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome_aluno'];
    $turma = $_POST['turma'];

    $sql= "INSERT INTO livro_retirada (nome_aluno,turma,id_livro,data_retirada) VALUES('$nome',$turma,{$_GET['id']}, NOW()) ";

        if(isset($_POST['enviar'])){
        $resultado = $conn->query($sql);
        if($resultado){
            $sql_up = "UPDATE livro l SET l.status = 'indisponivel' WHERE l.id = {$_GET['id']};";
            $enviar = $conn->query($sql_up);
            header("location: index.php");
        }
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
        <input type="text" name="nome_aluno" id="nome_aluno">
        <input type="number" name="turma" id="turma">
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>