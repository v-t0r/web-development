<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <meta name="description" content="AnúnciosAnúnicos - O melhor para comprar e vender de tudo!">
    <title>Anúncios&Anúncios</title>
</head>

<body>
    <header>
        <img id="logo" src="images/logo-branco.png" alt="logo da Anuncios&Anuncios">
        <h1>Anúncios&Anúncios</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Início</a></li>
            <li><a href="meusAnuncios.php">Perfil</a></li>
        </ul>
    </nav>
    <main>

        <?php

        require "sessionVerification.php";
        require 'conexaoMysql.php';
        session_start();
        exitWhenNotLoggedIn();

        $pdo = mysqlConnect();

        $codigo = $_GET['codigo'];
        $sql = <<<SQL
            SELECT Titulo, Descricao, Preco, DataHora, CEP, Estado, CodCategoria, CodAnunciante
            FROM Anuncio
            WHERE Codigo = ?
        SQL;

        $stmt =  $pdo->prepare($sql);
        $stmt->execute([$codigo]);

        $resultado = $stmt->fetch();

        $titulo = $resultado['Titulo'];
        $descricao = $resultado['Descricao'];
        $preco = $resultado['Preco'];

        $sql = <<<SQL
            SELECT NomeArqFoto
            FROM Foto
            WHERE CodAnuncio = ?
        SQL;

        $stmt =  $pdo->prepare($sql);
        $stmt->execute([$codigo]);

        $resultado = $stmt->fetch();
        $nomeFoto = "images/produtos/" . $resultado['NomeArqFoto'];

        //toda a página com as informações do produto
        $infoPage = <<<HTML
        <div class = "container">
            <div class="informacoes_produto fotos_produto">
                <div>
                    <h1>$titulo</h1>
                    <img id="imagem_atual" src=$nomeFoto alt=$nomeFoto>
                    <p>$descricao</p>
                </div>
                <div class="preco_comprar">
                    <p class="preco">R$ $preco</p>
                    <form action="apagaAnuncio.php" method="POST">
                        <input type="hidden" value=$codigo id="codigo" name="codigo">
                        <input type="hidden" value=$nomeFoto id="end_foto" name="end_foto">
                        <button id="apagar" name="apagar">Apagar Anúncio</button>
                    </form>
                    
                </div>

            </div>

            <div class = "registro_interesses fotos_produto">
                <h2>Registro de Interesses</h2>
            </div>

        </div>
        HTML;

        echo $infoPage;

        ?>
    </main>
    <footer>
        <p>Anúncios&Anúncios - Todos os direitos reservados - 2023</p>
    </footer>

    <script src="paginaProdutoAnunciante.js"></script>
</body>

</html>