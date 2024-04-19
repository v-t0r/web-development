<?php
require "../ex1/conexaoMysql.php";
$pdo = mysqlConnect();

try{

    $sql = <<<SQL
    SELECT Nome, CPF, Email, Endereco, Bairro, Cidade, Estado, CEP
    FROM Cliente INNER JOIN ClienteEndereco ON Cliente.ID = ClienteID
    SQL;

    $stmt = $pdo->query($sql);

}catch(Exception $e){
    exit("Falha: " . $e->getMessage());
}

?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista de Clientes</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <style>
    body {
      padding-top: 2rem;
    }
  </style>
</head>

<body>

  <div class="container">
    <h3>Clientes</h3>
    <table class="table table-striped table-hover">
      <tr>
        <th>Nome</th>
        <th>CPF</th>
        <th>Email</th>
        <th>CEP</th>
        <th>Endereco</th>
        <th>Bairro</th>
        <th>Cidade</th>
        <th>Estado</th>
      </tr>

      <?php
      while ($row = $stmt->fetch()) {

        $nome = htmlspecialchars($row['Nome']);
        $cpf = htmlspecialchars($row['CPF']);
        $email = htmlspecialchars($row['Email']);

        $cep = htmlspecialchars($row['CEP']);
        $endereco = htmlspecialchars($row['Endereco']);
        $bairro = htmlspecialchars($row['Bairro']);
        $cidade = htmlspecialchars($row['Cidade']);
        $estado = htmlspecialchars($row['Estado']);
       
        echo <<<HTML
          <tr>
            <td>$nome</td> 
            <td>$cpf</td>
            <td>$email</td>

            <td>$cep</td>
            <td>$endereco</td>
            <td>$bairro</td>
            <td>$cidade</td>
            <td>$estado</td>

          </tr>      
        HTML;
      }
      ?>

    </table>
    <a href="index.html">Voltar</a>
  </div>

</body>

</html>