
<?php
require 'conexaoMysql.php';
$pdo = mysqlConnect();

$busca = $_GET['busca'] ?? '';
$offset= $_GET['offset'];
$ondeBuscar = $_GET['ondeBuscar'];
$numCategoria = $_GET['categoria'];
$precoMin = $_GET['precoMin'];
$precoMax = $_GET['precoMax'];

if($numCategoria == "0")
    $categoria = "0";
else
    $categoria = "CodCategoria";

$sql = <<<SQL
    SELECT Codigo, Titulo, Descricao, Preco, DataHora, CEP, Estado, CodCategoria, CodAnunciante
    FROM Anuncio
    WHERE $ondeBuscar LIKE ? AND
        $ondeBuscar LIKE ? AND
        $ondeBuscar LIKE ? AND
        $ondeBuscar LIKE ? AND
        $ondeBuscar LIKE ? AND
        $categoria = ? AND
    Preco >= ? AND Preco <= ?
    ORDER BY DataHora DESC
    LIMIT 6 OFFSET ?
SQL;


if ($busca != ''){
    $palavras = explode(" ", $busca);

    if(count($palavras) < 5){ //lida quando não foram inseridas pelo menos 5 palavras
        for($i = 0; $i<4; $i++){
            $palavras[] = $palavras[0];
            if(count($palavras) == 5){
                break;
            }
        }
    }else if(count($palavras) > 5){ //utiliza somente as 5 primeiras palavras
        $palavras = array_slice($palavras, 0, 5);
    }

    for($i=0; $i<5; $i++){
        $palavras[$i] = "%" . $palavras[$i] . "%";
    }

    $stmt =  $pdo->prepare($sql);
    
    $stmt->execute([$palavras[0], 
                    $palavras[1], 
                    $palavras[2], 
                    $palavras[3], 
                    $palavras[4], 
                    $numCategoria,
                    $precoMin, $precoMax,
                    $offset]);

    $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($resultados);
}


