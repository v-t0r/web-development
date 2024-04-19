<?php
require 'conexaoMysql.php';
$pdo = mysqlConnect();

class RequestResponse
{
  public $success;
  public $detail;

  function __construct($success, $detail)
  {
    $this->success = $success;
    $this->detail = $detail;
  }
}

function checkLogin($pdo, $email, $senha)
{
  $sql = <<<SQL
    SELECT SenhaHash, Codigo
    FROM Anunciante
    WHERE Email = ?
    SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $resultado = $stmt->fetch();
    if (!$resultado) return false; // nenhum resultado (email não encontrado)

    if(password_verify($senha, $resultado['SenhaHash'])){ //senhas coincidem
      return $resultado['Codigo'];
    }else
      return false;
  } 
  catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

$email = $_POST["input_email"] ?? "";
$senha = $_POST["input_senha"] ?? "";
$codigo = checkLogin($pdo, $email, $senha);
if ($codigo){
    $cookieParams = session_get_cookie_params();
    $cookieParams['httponly'] = true;
    session_set_cookie_params($cookieParams);

    // cria uma nova sessão para o usuário
    session_start();
    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $codigo;
    $response = new RequestResponse(true, 'meusAnuncios.php');
}else{
    $response = new RequestResponse(false, '');
}

header('Content-type: application/json');
echo json_encode($response);