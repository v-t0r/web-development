<?php
require 'conexaoMysql.php';
$pdo = mysqlConnect();

$nome = $_POST["input_nome"];
$cpf = $_POST["input_cpf"];
$tel = $_POST["input_tel"];
$email = $_POST["input_email"];
$senha = password_hash($_POST["input_senha"] ?? "", PASSWORD_DEFAULT);

$sql = <<<SQL
    INSERT INTO Anunciante(Nome, CPF, Email, SenhaHash, Telefone)
    VALUES (?, ?, ?, ?, ?)
    SQL;

try{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $cpf, $email, $senha, $tel]);
    
    echo("Cadastrado com sucesso!");
    header("location: login.html");
}catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Falha: ' . $e->getMessage());
}
