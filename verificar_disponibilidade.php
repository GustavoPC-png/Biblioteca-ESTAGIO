<?php
include "db/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['seriado'])) {
    $seriado = $_POST['seriado'];

    $sqlCoisa = "SELECT * FROM livro_seriado lr WHERE lr.seriado = '{$seriado}'";
    $resultados = $conn->query($sqlCoisa);
    $livrosDisponiveis = $resultados->fetch_all(MYSQLI_ASSOC);

    if (count($livrosDisponiveis) > 0) {
        echo "<p>Livro disponível.</p>";
    } else {
        echo "<p>Livro não está disponível.</p>";
    }
}
?>
