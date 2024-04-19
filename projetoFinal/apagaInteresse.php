<?php
require "conexaoMysql.php";
require "sessionVerification.php";

session_start();
exitWhenNotLoggedIn();
$pdo = mysqlConnect();

$dados = file_get_contents("php://input");
$dados = json_decode($dados, true);

$codInteresse = $dados['codigo'];
$codAnunciante = $_SESSION['user'];

$sql = <<<SQL
    DELETE FROM Interesse
    WHERE Codigo = ? AND CodAnuncio IN (SELECT Codigo FROM Anuncio WHERE CodAnunciante = ?);
SQL;


try{

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$codInteresse, $codAnunciante]);

}catch(Exception $e){
    exit('Falha: ' . $e->getMessage());
    
}


