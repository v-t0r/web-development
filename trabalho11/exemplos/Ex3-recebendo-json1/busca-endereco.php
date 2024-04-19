<?php
/*
Define uma classe Endereco que contem rua, bairro e cidade. Quando chamada, verifica se o cep recebido existe. Caso exista, 
instancia uma classe Endereco com as informações de endereço daquele cep. Define o tipo de conteudo como json e retorna a 
classe Endereco codificada como json.
*/

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

$cep = $_GET['cep'] ?? '';

if ($cep == '38400-100')
  $endereco = new Endereco('Av Floriano', 'Centro', 'Uberlândia');
else if ($cep == '38400-200')
  $endereco = new Endereco('Rua Tiradentes', 'Fundinho', 'Uberlândia');
else {
  $endereco = new Endereco('', '', '');
}

header('Content-type: application/json');
echo json_encode($endereco);
