<?php
if (isset($_GET['pesquisa'])) {
    $termoPesquisa = $_GET['pesquisa'];

    $sql = "SELECT * FROM livro WHERE titulo LIKE '%$termoPesquisa%'";
    $resultado = $conn->query($sql);
}