<?php 
    include("db/db.php");

    $sql = "UPDATE livro SET status = 'disponivel' WHERE id = {$_GET['id']}";
    $resutado = $conn->query($sql);

    $sql_a= "UPDATE livro_retirada lr SET data_entrega = NOW() WHERE id_livro = {$_GET['id']} ";
    $rest = $conn->query($sql_a);

    header("location: livro.php?id={$_GET['id']}");
?>