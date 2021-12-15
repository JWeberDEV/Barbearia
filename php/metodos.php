<?php 

include 'conexao.php';

$login = addslashes($_POST['usuario']);
$senha = addslashes($_POST['senha']);
$acao = $_POST['acao'];



switch ($acao) {
  case 'LOGIN':
    
    $sql = "SELECT nome_usuario,senha FROM usuario WHERE nome_usuario = '$login' and senha = '$senha'";
    $resultado = $mysqli->query($sql) or die ("ERRO: A query de consulta esta incorreta");

    $linha = mysqli_num_rows($resultado);

    $valida = 0;
    if($linha == 0){
      $valida = 0;
    }else{
      $valida = 1;
    }

    echo ($valida);

  break;

  case 'NEW_USER':
    
    $nome = ($_POST['nome']);
    $cpf = ($_POST['cpf']);
    $email = ($_POST['email']);
    $numero = ($_POST['numero']);
    $datanasc = ($_POST['datanasc']);
    $profissao = ($_POST['profissao']);
    $cidade = ($_POST['cidade']);

    $sql = "INSERT INTO cliente (nome_cliente,cpf,email,telefone,data_nasc,profissao,cidade) VALUES ('$nome','$cpf','$email','$numero','$datanasc','$profissao','$cidade')";
    $resultado = $mysqli->query($sql) or die ("ERRO: A query de criacao esta incorreta");
    
    $linha = mysqli_num_rows($resultado);

    $valida = 0;
    if($linha == 0){
      $valida = 0;
    }else{
      $valida = 1;
    }
    echo ($valida);
    
  break;
  
  default:
    # code...
    break;
}


?>

