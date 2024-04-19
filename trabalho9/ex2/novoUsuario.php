<?php
require "usuarios.php";

// coleta os dados do formulário
$email = $_POST["email"] ?? "";
$senha = password_hash($_POST["senha"] ?? "", PASSWORD_DEFAULT);

// cria um novo contato e acrescenta no arquivo de texto
$novoContato = new Usuario($email, $senha);
$novoContato->AddToFile("usuarios.txt");

// redireciona o navegador para a página de listagem de usuarios
header("location: listaUsuarios.php");

?>