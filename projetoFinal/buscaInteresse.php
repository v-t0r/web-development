<?php
require "conexaoMysql.php";
require "sessionVerification.php";

session_start();
exitWhenNotLoggedIn();
$pdo = mysqlConnect();

$sql = <<<SQL
    SELECT Codigo, Mensagem, Contato
    FROM Interesse
    WHERE CodAnuncio = ?
    ORDER BY DataHora DESC
SQL;

$codigo = $_GET['codigo'];

$stmt =  $pdo->prepare($sql);
$stmt->execute([$codigo]);

$resultados = $stmt->fetchAll(PDO::FETCH_OBJ);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($resultados);
