<?php
require "conexaoMysql.php";
require "sessionVerification.php";

session_start();
exitWhenNotLoggedIn();

$pdo = mysqlConnect();

$titulo = $_POST["titulo"];
$preco = $_POST["preco"];
$descricao = $_POST["descricao"];
$email = $_POST["categoria"];
$cep = $_POST["cep"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$categoria = $_POST["categoria"];

$arquivo = $_FILES["arquivo"];

$sql1 = <<<SQL
    INSERT INTO Anuncio(Titulo, Descricao, Preco, DataHora, CEP, Bairro, Cidade, Estado, CodCategoria, CodAnunciante)
    VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?)
    SQL;

$sql2 = <<<SQL
    INSERT INTO Foto(CodAnuncio, NomeArqFoto)
    VALUE (?, ?)
    SQL;

session_start();

try{
    $pdo->beginTransaction();

    $stmt1 = $pdo->prepare($sql1);
    if(!$stmt1->execute([$titulo, $descricao, $preco, $cep, $bairro, $cidade, $estado, $categoria, $_SESSION['user']]))
        throw new Exception('Falha na primeira inserção');

    //define o nome do arquivo baseado no codigo do anuncio
    $codAnuncio = $pdo->lastInsertId();
    $nomeArq = $codAnuncio . "." . pathinfo($arquivo["name"], PATHINFO_EXTENSION);

    $stmt2 = $pdo->prepare($sql2);
    if(!$stmt2->execute([$codAnuncio, $nomeArq]))
        throw new Exception('Falha na segunda inserção');


    if (move_uploaded_file($arquivo["tmp_name"], "images/produtos/" . $nomeArq)) {
        echo "Arquivo salvo com sucesso!";
    } else {
        echo "Erro ao salvar o arquivo.";
        throw new Exception('Falha no processamento da imagem');
    }

    $pdo->commit();

}catch(Exception $e){
    $pdo->rollBack();
    exit('Falha: ' . $e->getMessage());
    
}

header("location: meusAnuncios.php");
exit();

?>
