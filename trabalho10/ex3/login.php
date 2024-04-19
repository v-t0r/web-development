<?php

  function checkLogin($pdo, $email, $senha)
  {
    $sql = <<<SQL
      SELECT Hash
      FROM Cliente
      WHERE Email = ?
      SQL;

    try {
      // Neste caso utilize prepared statements para prevenir
      // ataques do tipo SQL Injection, pois precisamos
      // inserir dados fornecidos pelo usuário na 
      // consulta SQL (o email do usuário)
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$email]);
      $row = $stmt->fetch();
      if (!$row) return false; // nenhum resultado (email não encontrado)

      return password_verify($senha, $row['Hash']);
    } 
    catch (Exception $e) {
      //error_log($e->getMessage(), 3, 'log.php');
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }

  require "../ex1/conexaoMysql.php";
  $pdo = mysqlConnect();

  $email = $_POST["email"] ?? "";
  $senha = $_POST["senha"] ?? "";

  if (checkLogin($pdo, $email, $senha)){
    header("location: home.html");
    exit();
  }else{
    header("location: testaLogin.html");
    exit();
  }
