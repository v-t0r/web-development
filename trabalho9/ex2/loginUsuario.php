<?php
    require "usuarios.php";

    // coleta os dados do formulário
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";

    $arrayUsuarios = carregaUsuariosDeArquivo();	
    if ($arrayUsuarios != NULL){

        foreach ($arrayUsuarios as $usuario){ //para cada usuario cadastrado obtem-se o email e o hash

            $emailSalvo = $usuario->email;
            $hash = $usuario->senha;

            if($email == $emailSalvo){ //Se o email encontrado na lista for o fornecido no login
                if(password_verify($senha, $hash)){ //verifica se a senha bate com o hash armazenado
                   header("location: loginSucesso.html");
                   exit();
                }
            }
        }
    }		

    // redireciona o navegador para a página de listagem de usuarios
    header("location: login.html");
    exit();

?>