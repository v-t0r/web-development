<?php
require "sessionVerification.php";

session_start();
exitWhenNotLoggedIn();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <meta name="description" content="AnúnciosAnúnicos - O melhor para comprar e vender de tudo!">
    <title>Anúncios&Anúncios - Página do Anunciante</title>
</head>

<body>
    <header>
        <img id="logo" src="images/logo-branco.png" alt="logo da Anuncios&Anuncios">
        <h1>Anúncios&Anúncios</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Início</a></li>
            <li><a href="meusAnuncios.php">Meus Anúncios</a></li>
            <li><a href="criarAnuncio.php">Criar Novo Anúncio</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
    <main>
        <h1>Meus Anúncios</h1>
        <div class = "container" id="area_resultados">
            
        </div>
    </main>
    <footer>
        <p>Anúncios&Anúncios - Todos os direitos reservados - 2023</p>
    </footer>

    <script src="meusAnuncios.js"></script>
</body>

</html>