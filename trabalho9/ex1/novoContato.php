<?php
/*
Este arquivo recebe os dados inseridos no formulario, instancia uma classe com os dados obtidos, e adiciona este novo contato no final
do arquivo, utilizando a função AddToFile disponivel na classe Contato, que foi definida no arquivo Contatos.php
Por fim, redireciona o navegador para a página que lista os contatos já cadastrados.
*/
require "contatos.php";

// coleta os dados do formulário
$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";

// cria um novo contato e acrescenta no arquivo de texto
$novoContato = new Contato($nome, $email, $telefone);
$novoContato->AddToFile("contatos.txt");

// redireciona o navegador para a página de listagem de contatos
header("location: listaContatos.php");

?>