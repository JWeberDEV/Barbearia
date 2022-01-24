<?php 
// print_r($result); ou var_dump para mostrar um array em PHP.

include 'conexao.php';

$acao = $_POST['acao'];

switch ($acao) {
  case 'PROFISSIONAIS':
    $sql = "SELECT id,nome FROM usuario ORDER BY nome ASC";

    $result = $mysqli->query($sql) or die ("ERRO: Falha ao trazer a lista de proffisionais");

    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($result);

    // if ($result -> num_rows > 0) {
    //   while ($profissional = $result->fetch_assoc()) {
    //     echo $profissional["nome_usuario"];
    //   }
    // }
  break;

  case 'CLIENTES':
    $teste = $_POST["teste"];
    $sql = "SELECT id,nome_cliente FROM cliente ORDER BY nome_cliente ASC";

    $result = $mysqli->query($sql) or die ("ERRO: Falha ao trazer a lista de clientes");

    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    echo json_encode($result);
  break;
  
  case 'AGENDAMENTOS':
    $sql = " SELECT a.id, c.nome_cliente, a.data_atendimento, a.hora_inicial, a.hora_final FROM agenda a 
    INNER JOIN usuario u ON u.id = a.id_atendente 
    INNER JOIN cliente c ON c.id = a.id_cliente ";

    $result = $mysqli->query($sql) or die ("ERRO: Falha ao trazer os agendamentos");

    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($result);
  break;
}

?>