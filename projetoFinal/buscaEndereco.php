<?php

class Endereco implements JsonSerializable
{
    public $estado;
    public $bairro;
    public $cidade;

    function __construct($estado, $bairro, $cidade)
    {
        $this->estado = $estado;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
    }

    public function jsonSerialize()
    {
        return [
            'estado' => $this->estado,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade
        ];
    }
}

require "conexaoMysql.php";
require "sessionVerification.php";

session_start();
exitWhenNotLoggedIn();
$pdo = mysqlConnect();

$sql = <<<SQL
    SELECT Bairro, Cidade, Estado
    FROM BaseEnderecosAjax
    WHERE CEP = ?
SQL;

$cep = $_GET['cep'] ?? '';

$stmt =  $pdo->prepare($sql);
$stmt->execute([$cep]);

$dados = $stmt->fetch();

if ($dados)
    $endereco = new Endereco($dados['Estado'], $dados['Bairro'], $dados['Cidade']);
else
    $endereco = new Endereco('', '', '');

header('Content-Type: application/json; charset=utf-8');
echo json_encode($endereco);
