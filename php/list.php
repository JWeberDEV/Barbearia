<?php
include 'conexao.php';

$cpf =($_POST['cpf']);

// traz os IDs da tabela usuario
$sql = "SELECT id FROM usuario WHERE cpf = '$cpf' "; 
$resultado = $mysqli->query($sql) or die ("ERRO: A query de relatorio esta incorreta");

if ($resultado->num_rows > 0) {
  while($user = $resultado->fetch_assoc()) {
    $id = $user["id"];
    echo $id;
  }
}
?>