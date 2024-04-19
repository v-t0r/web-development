<?php
/* 
O codigo pega o cep recebido por GET e confere se ele é um dos cadastrados.
Em caso positivo, devolve a cidade a qual o cep pertence. Em caso negativo,
informa o erro 404 e devolve uma mensagem informado que o cep não está disponível.
*/ 

$cep = $_GET['cep'] ?? '';

if ($cep == '38400-100')
  echo 'Uberlândia';
else if ($cep == '38700-000')
  echo 'Patos de Minas';
else {
  http_response_code(404);
  echo "$cep is not available";
}