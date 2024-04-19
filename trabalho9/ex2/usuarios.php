<?php
class Usuario
{
  public $email;
  public $senha;

  function __construct($email, $senha)
  {
    $this->email = $email;
    $this->senha = $senha;
  }

  public function AddToFile($arquivo)
  {
    // abre o arquivo para escrita de conteúdo no final
    $arq = fopen($arquivo, "a");
    fwrite($arq, "\n{$this->email};{$this->senha}");
    fclose($arq); 
  }
}

function carregaUsuariosDeArquivo()
{
  $arrayUsuarios = null;
  
  // Abre o arquivo contatos.txt para leitura
  $arq = fopen("usuarios.txt", "r");
  if ( !$arq )
    return null;

  // Le os dados do arquivo, linha por linha, e armazena no vetor $usuarios
  while (!feof($arq)) {
    // fgets lê uma linha de texto do arquivo
    $usuario = fgets($arq); 
    
    // Separa dados na linha utilizando o ';' como separador
    list($email, $senha) = array_pad(explode(';', $usuario), 2, null);

    // Cria novo objeto representado o contato e adiciona no final do array
    $novoUsuario = new Usuario($email, $senha);
    $arrayUsuarios[] = $novoUsuario;
  }
      
  // Fecha o arquivo
  fclose($arq);  
  return $arrayUsuarios;
}

?>