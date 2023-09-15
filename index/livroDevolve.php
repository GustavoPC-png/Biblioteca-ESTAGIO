<?php 
    include("db/db.php");

    $sql = "UPDATE livro SET status = 'disponivel' WHERE id = {$_GET['id']}";
    $resutado = $conn->query($sql);

    $sql_a= "UPDATE livro_retirada lr SET data_entrega = now() WHERE id_livro = {$_GET['id']} AND lr.status = 'pendente'";
    $rest = $conn->query($sql_a);
    $sql_b = "UPDATE livro_retirada lr SET lr.status = 'entregue' WHERE id_livro = {$_GET['id']}";
    $re = $conn->query($sql_b);

    header("location: livro.php?id={$_GET['id']}");
?>