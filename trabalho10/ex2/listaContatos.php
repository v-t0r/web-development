<?php
require "../ex1/conexaoMysql.php";
$pdo = mysqlConnect();

try {
  $sql = <<<SQL
    SELECT name, email, message
    FROM Contato
  SQL;

  $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <h1>Lista de Contatos</h1>
    <table class="table table-striped table-hover">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Mensagem</th>
    </tr>
    <?php
    while ($row = $stmt->fetch()){
        $name = $row["name"];
        $email = $row["email"];
        $message = $row["message"];

        echo <<<HTML
        <tr>
            <td>$name</td>
            <td>$email</td>
            <td>$message</td>
        </tr>
        HTML;
    }
    ?>
    </table>
    <a href="index.html">Voltar</a>

</body>

</html>