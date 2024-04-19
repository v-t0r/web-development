
<?php
require "conexaoMysql.php";
require "sessionVerification.php";

session_start();
exitWhenNotLoggedIn();
$pdo = mysqlConnect();

$sql = <<<SQL
    SELECT Codigo, Titulo, Descricao, Preco, DataHora, CEP, Estado, CodCategoria, CodAnunciante
    FROM Anuncio
    WHERE CodAnunciante = ?
    ORDER BY DataHora DESC
SQL;

$codigo = $_SESSION['user'];

$stmt =  $pdo->prepare($sql);
$stmt->execute([$codigo]);

$resultados = $stmt->fetchAll(PDO::FETCH_OBJ);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($resultados);



