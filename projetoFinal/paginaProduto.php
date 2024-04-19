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
        require 'conexaoMysql.php';
        $pdo = mysqlConnect();

        $codigo = $_GET['codigo'];
        $sql = <<<SQL
            SELECT Titulo, Descricao, Preco, Estado, Cidade, Bairro
            FROM Anuncio
            WHERE Codigo = ?
        SQL;

        $stmt =  $pdo->prepare($sql);
        $stmt->execute([$codigo]);

        $resultado = $stmt->fetch(); 
        
        $titulo = $resultado['Titulo'];
        $descricao = $resultado['Descricao'];
        $preco = $resultado['Preco'];
        $nomeFoto = "images/produtos/" . $codigo . ".jpg";

        $estado = $resultado['Estado'];
        $cidade = $resultado['Cidade'];
        $bairro = $resultado['Bairro'];


        //toda a página com as informações do produto
        $infoPage = <<<HTML
        <div class = "container">
            <div class = "fotos_produto">
                <img id="imagem_atual" src=$nomeFoto alt=$titulo>
            </div>
            <div class="informacoes_produto">
                <div>
                    <input type="hidden" id="codigo" name="codigo" value=$codigo>
                    <h1>$titulo</h1>
                    <h3>Descrição</h3>
                    <p>$descricao</p>
                    <h3>Endreço</h3>
                    <p>Estado: $estado</p>
                    <p>Cidade: $cidade</p>
                    <p>Bairro: $bairro</p>
                </div>
                <div class="preco_comprar">
                    <p class="preco">R$ $preco</p>
                    <button id="interesse" type="button">TENHO INTERESSE</button>
                </div>
            </div>
        </div>

        <!-- Janela para demonstrar interesse -->
        <div id="centralized_window">
            <textarea id = "mensagem" name="mensagem" rows="10" placeholder="Deixe uma mensagem para o anunciante..." required></textarea>
            <input input="text" id="contato" name="contato" placeholder="Insira seu contato" required>
            <button type="button" id="enviar" name="enviar">Enviar</button>
        </div>

        HTML;

        echo $infoPage;

    ?>
    </main>
    <footer>
        <p>Anúncios&Anúncios - Todos os direitos reservados - 2023</p>
    </footer>

    <script src="paginaProduto.js"></script>
</body>

</html>