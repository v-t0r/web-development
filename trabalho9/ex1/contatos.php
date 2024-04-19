<?php
/*
Classe com operações relativas ao cadastramento e recuperação de clientes no arquivo txt
Os atributos da classe são fornecidos para o construtor e são o nome, email e telefone do cliente.
A classe possui dois métodos: AddToFile, que serve para adicionar ao final do arquivo um novo contato. O nome do arquivo
é passado por parâmetro na chamada da função. A outra, chamda carregaContatosDeArquivo, que percorre todo o arquivo 
chamado "contatos.txt" e retorna um array contendo os dados de todos os contatos cadastrados.
*/
class Contato
{
  public $nome;
  public $email;
  public $telefone;



  function __construct($nome, $email, $telefone)
  {
    $this->nome = $nome;
    $this->email = $email;
    $this->telefone = $telefone;
  }

  public function AddToFile($arquivo)
  {
    // abre o arquivo para escrita de conteúdo no final
    $arq = fopen($arquivo, "a");
    fwrite($arq, "\n{$this->nome};{$this->email};{$this->telefone}");
    fclose($arq); 
  }
}

function carregaContatosDeArquivo()
{
  $arrayContatos = null;
  
  // Abre o arquivo contatos.txt para leitura
  $arq = fopen("contatos.txt", "r");
  if ( !$arq )
    return null;

  // Le os dados do arquivo, linha por linha, e armazena no vetor $contatos
  while (!feof($arq)) {
    // fgets lê uma linha de texto do arquivo
    $contato = fgets($arq); 
    
    // Separa dados na linha utilizando o ';' como separador
    list($nome, $email, $telefone) = array_pad(explode(';', $contato), 3, null);

    // Cria novo objeto representado o contato e adiciona no final do array
    $novoContato = new Contato($nome, $email, $telefone);
    $arrayContatos[] = $novoContato;
  }
      
  // Fecha o arquivo
  fclose($arq);  
  return $arrayContatos;
}

?>