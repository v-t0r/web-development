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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_form.css">
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
        <form action="cadastraAnuncio.php" method="post" enctype="multipart/form-data" onsubmit="return validaFormulario()">
            <div class="container my-5">
                <h1>Criar Novo Anúncio</h1>
                <div class="row gy-3">
                    <!--Linha com campos de nome e cpf-->
                    <div class="col-sm-9">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="col-sm-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="form-control" id="preco" name="preco" pattern="\d+(\.\d{2})?" placeholder="Ex: 199.99" required>
                    </div>


                    <div class="col-12">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" cols="30" rows="10" required></textarea>
                    </div>

                    <div class="col-sm-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select class="form-select" id="categoria" name="categoria" required>
                            <option value="" selected>Selecione</option>
                            <option value="1">Veículo</option>
                            <option value="2">Eletroeletrônico</option>
                            <option value="3">Imóvel</option>
                            <option value="4">Vestuário</option>
                            <option value="5">Outro</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" pattern="\d{5}-\d{3}" maxlength="9" placeholder="Ex: 38400-000" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" required>
                    </div>

                    <!--Linha com campos de CEP e endereço-->
                    <div class="col-sm-9">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                    </div>
                    <div class="col-sm-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="" selected>Selecione</option>
                            <option value="MG">MG</option>
                            <option value="SP">SP</option>
                            <option value="RJ">RJ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="imagem">Selecione uma imagem</label>
                        <input type="file" class="form-control-file" name="arquivo" id="arquivo" required>
                    </div>

                    <!--Botão-->
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Cadastrar</button>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <footer>
        <p>Anúncios&Anúncios - Todos os direitos reservados - 2023</p>
    </footer>

    <script src="criarAnuncio.js"></script>

</body>

</html>