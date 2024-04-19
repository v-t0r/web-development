<?php
    require "../ex1/conexaoMysql.php";
    $pdo = mysqlConnect();

    $nome = $_POST["nome"] ?? "";
    $cpf = $_POST["cpf"] ?? "";
    $email = $_POST["email"] ?? "";
    $senha = password_hash($_POST["senha"] ?? "", PASSWORD_DEFAULT);
    
    $cep = $_POST["cep"] ?? "";
    $endereco = $_POST["endereco"] ?? "";
    $bairro = $_POST["bairro"] ?? "";
    $cidade = $_POST["cidade"] ?? "";
    $estado = $_POST["estado"] ?? "";

    $sql1 = <<<SQL
        INSERT INTO Cliente(Nome, CPF, Email, Hash)
        VALUES (?, ?, ?, ?)
        SQL;

    $sql2 = <<<SQL
        INSERT INTO ClienteEndereco(ClienteID, CEP, Endereco, Bairro, Cidade, Estado)
        VALUES (?, ?, ?, ?, ?, ?)
        SQL;

    try{
        $pdo->beginTransaction();

        $stmt1 = $pdo->prepare($sql1);
        if(!$stmt1->execute([$nome, $cpf, $email, $senha]))
            throw new Exception('Falha na primeira inserção');


        $idCliente = $pdo->lastInsertId();
        $stmt2 = $pdo->prepare($sql2);
        if(!$stmt2->execute([$idCliente, $cep, $endereco, $bairro, $cidade, $estado]))
            throw new Exception('Falha na segunda inserção');

        $pdo->commit();

        header("location: index.html");
        exit();

    }catch(Exception $e){
        $pdo->rollBack();
        exit('Falha: ' . $e->getMessage());
        
    }

?>