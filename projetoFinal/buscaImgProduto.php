
<?php
require 'conexaoMysql.php';
$pdo = mysqlConnect();

$sql = <<<SQL
    SELECT NomeArqFoto
    FROM Foto
    WHERE CodAnuncio = ?
SQL;

$codigo = $_GET['codigo'] ?? '';

$stmt =  $pdo->prepare($sql);
$stmt->execute([$codigo]);

$resultado = $stmt->fetch(PDO::FETCH_OBJ);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($resultado);



