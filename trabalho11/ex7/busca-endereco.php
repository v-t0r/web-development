<?php
  class Endereco
  {
    public $rua;
    public $bairro;
    public $cidade;

    function __construct($rua, $bairro, $cidade)
    {
      $this->rua = $rua;
      $this->bairro = $bairro;
      $this->cidade = $cidade;
    }

  }

  require "conexaoMysql.php";
  $pdo = mysqlConnect();

  $cep = $_GET['cep'] ?? '';

  $sql = <<<SQL
    SELECT rua, bairro, cidade
    FROM endereco
    WHERE cep = ?
    SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$cep]);

  $dados = $stmt->fetch(PDO::FETCH_OBJ);
  if($dados)
    $endereco = new Endereco($dados['rua'], $dados['bairro'], $dados['cidade']);
  else
    $endereco = new Endereco('', '', '');

  header('Content-type: application/json');

  echo json_encode($endereco);

?>
