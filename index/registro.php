<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="registro.css">
</head>
<body>
    <form action="adicionaprofe.php" method="post">
        <div class="tudo">    
            <div class="coisa">
            </div>
            <section>
                <div class="box">
                <div class="input-box">
                        <input type="text" name="nome" id="nome">
                        <label class="a2" for="">Nome</label>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" id="email">
                        <label class="a" for="">Email</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="senha" id="senha">
                        <label class="a1" for="">Senha</label>
                    </div>
                    <div class="input-box">
                        <button>Entrar</button>
                        <a href="login.php">>Fazer Login<</a>
                    </div>
                </div>
            </section>
        </div> 
    </form>   
</body>
</html>