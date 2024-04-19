<?php
require "conexaoMysql.php";

$pdo = mysqlConnect();

$dados = file_get_contents("php://input");
$dados = json_decode($dados, true);

$codigo = $dados['codigo'];
$mensagem = $dados['mensagem'];
$contato = $dados['contato'];

$sql = <<<SQL
    INSERT INTO Interesse(Mensagem, DataHora, Contato, CodAnuncio)
    VALUE(?,NOW(),?,?)
    SQL;

try{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$mensagem, $contato, $codigo]);
    
}catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Falha: ' . $e->getMessage());
}
    