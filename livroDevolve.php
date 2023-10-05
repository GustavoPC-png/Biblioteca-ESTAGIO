<?php 
    include("db/db.php");

$sql = "UPDATE livro_seriado SET status = 'disponivel' WHERE id_livro = {$_GET['id']} AND seriado = {$_GET['serie']}";
    $resutado = $conn->query($sql);

    $sql_a= "UPDATE livro_retirada lr SET data_entrega = now() WHERE id_livro = {$_GET['id']} AND lr.status = 'pendente'";
    $rest = $conn->query($sql_a);
    $sql_b = "UPDATE livro_retirada lr SET lr.status = 'entregue' WHERE id_livro = {$_GET['id']} AND lr.serie = {$_GET['serie']}";
    $re = $conn->query($sql_b);

    $sql_livro = "SELECT livro.titulo AS titulo FROM livro where livro.id = {$_GET['id']}";
    $resultado_livro = $conn->query($sql_livro);
    $livro = $resultado_livro->fetch_all(MYSQLI_ASSOC);

    $sql_aluno = "SELECT nome_aluno AS nome FROM livro_retirada WHERE id_livro = {$_GET['id']}";
    $resultado_aluno = $conn->query($sql_aluno);
    $aluno = $resultado_aluno->fetch_all(MYSQLI_ASSOC);

header("location:livro.php?id={$_GET['id']}");

?>