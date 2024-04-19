<?php
require "conexaoMysql.php";
require "sessionVerification.php";

session_start();
exitWhenNotLoggedIn();
$pdo = mysqlConnect();

$sql1 = <<<SQL
    DELETE FROM Anuncio
    WHERE Codigo = ? AND CodAnunciante = ?
SQL;

$sql2 = <<<SQL
    DELETE FROM Foto
    WHERE CodAnuncio = ?
SQL;

$sql3 = <<<SQL
    DELETE FROM Interesse
    WHERE CodAnuncio = ?
SQL;

$codAnuncio = $_POST['codigo'];
$codAnunciante = $_SESSION['user'];

$endFoto = $_POST['end_foto'];

try{
    $pdo->beginTransaction();

    $stmt1 = $pdo->prepare($sql1);
    if(!$stmt1->execute([$codAnuncio, $codAnunciante]))
        throw new Exception('Falha no primeiro sql');

    $stmt2 = $pdo->prepare($sql2);
    if(!$stmt2->execute([$codAnuncio]))
        throw new Exception('Falha no segundo sql');

    $stmt2 = $pdo->prepare($sql3);
    if(!$stmt2->execute([$codAnuncio]))
        throw new Exception('Falha no terceiro sql');

    if (!unlink($endFoto))
        throw new Exception('Falha ao apagar a imagem');
    
    $pdo->commit();

}catch(Exception $e){
    $pdo->rollBack();
    exit('Falha: ' . $e->getMessage());
    
}

header("location: meusAnuncios.php");
exit();
?>

