<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imgs/img-removebg-preview.png" type="image/x-icon">
</head>
<body>
    <form action="adiciona_aluno.php" method="post" autocomplete="off">
        <header>
            <div class="top">
                <a href="index.html"><img src="imgs/img-removebg-preview.png" alt="" width="90" height="90"></a>
                <h1>Biblioteca</h1>
            </div>
        </header>
        <div class="mid1">
            <div class="inputbox">
                <input type="text" name="nome" required>
                <label for="">Nome do Aluno:</label>
            </div>
            <div class="inputbox">
                <input type="number" name="turma" required>
                <label for="turma">Turma:</label>
            </div>
            <div class="inputbox">
                <div class="custom-select yellow">
                    <select name="manha_tarde">
                    <option value="" selected disabled>Selecione o Turno</option>
                    <option value="1">Manhã</option>
                    <option value="2">Tarde</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mid2">
        <div class="inputbox">
                <input type="text" name="titulo" required>
                <label for="">Titulo do Livro:</label>
            </div>
            <div class="inputbox">
                <input type="text" name="autor" required>
                <label for="">Autor do Livro:</label>
            </div>
            <div class="inputbox">
                <h4 for="">Data da Retirada:</h4>
                <input type="date" name="retirada" required>    
            </div>
        </div>
        <div class="bttn">
            <button class="btn-one">Enviar</button>
        </div>
        <footer>
            <p>©️Escola Estadual de Ensino Fundamental Pio XI 2023</p> 
        </footer>
    </form>
</body>
</html>