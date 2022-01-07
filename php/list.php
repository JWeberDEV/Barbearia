<?php
include 'conexao.php';

$acao = $_POST['acao'];

switch ($acao) {
  case 'IDUSUARIO':
    $id =($_POST['id']);

    // traz os IDs da tabela usuario
    $sql = "SELECT id FROM usuario WHERE cpf = '$id' "; 
    $resultado = $mysqli->query($sql) or die ("ERRO: A query de relatorio esta incorreta");

    if ($resultado->num_rows > 0) {
      while($user = $resultado->fetch_assoc()) {
        $id = $user["id"];
        echo $id;
      }
    }
    break;
  
  case 'IDCLIENTE':
    $id =($_POST['id']);

    // traz os IDs da tabela usuario
    $sql = "SELECT id FROM cliente WHERE cpf = '$id' "; 
    $resultado = $mysqli->query($sql) or die ("ERRO: A query de relatorio esta incorreta");

    if ($resultado->num_rows > 0) {
      while($user = $resultado->fetch_assoc()) {
        $id = $user["id"];
        echo $id;
      }
    }
    break;
}

?>
