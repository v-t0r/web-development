<?php

require"../ex1/conexaoMysql.php";
$pdo = mysqlConnect();

$name = $_POST["name"] ?? "";
$email = $_POST["email"] ?? "";
$message = $_POST["message"] ?? "";

try {

    $sql = <<<SQL
    INSERT INTO Contato (name, email, message)
    VALUES ('$name', '$email', '$message');
    SQL;

    $pdo->exec($sql);
    header("location: listaContatos.php");
    exit();
    
}catch(Exception $e) {
    exit('Falha no cadastro: ' . $e->getMessage());
}
?>