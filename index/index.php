<?php
include("db/db.php");
if(!isset($_SESSION['id'])){
        header("location: login.php");
}
    $sql="SELECT * FROM livro";
    $resultado = $conn->query($sql);
    $livros = $resultado->fetch_all(MYSQLI_ASSOC);

    if(isset($_POST['registro'])){
      header("location: cadastrar_livro.php");
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
    <form action="" autocomplete="off" method="post">
        <header>
            <div class="top"> 
                <h1>Biblioteca</h1>
            </div>
        </header>
        <?php foreach($livros as $livro) : ?>
            <a href="livro.php?id=<?php echo $livro['id'];?>"><img src="<?php echo $livro['imagem']?>" alt=""></a>
        <?php endforeach ?>
        <a href="cadastrar_livro.php"><button name="registro">Registrar Livro</button></a>
        <footer>
            <p>©️Escola Estadual de Ensino Fundamental Pio XII 2023</p> 
        </footer>
    </form>
</body>
</html>
<style>
    html, body, h1, h2, h3, p, ul, li {
  margin: 0;
  padding: 0;
}
.top{
    display: flex;
    justify-content: center;
    flex-direction: row;
    gap: 10vw;
    font-size: 30px;
}
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
}

header {
  background-color: #FFD700;
  color: #fff;
  text-align: center;
  padding: 10px;
}

header h1 {
  font-size: 24px;
}

header a {
  color: #fff;
  text-decoration: none;
  margin: 0 10px;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.container a {
  margin: 10px;
  text-decoration: none;
}

.container img {
  max-width: 200px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

footer {
  text-align: center;
  background-color: #3498db;
  color: #fff;
  padding: 10px;
}

@media screen and (max-width: 768px) {
  header {
    font-size: 18px;
  }

  .container img {
    max-width: 150px;
  }
}
</style>