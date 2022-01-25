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

  case 'SERVICOS':
    $sql = "SELECT id,nome FROM servicos ORDER BY nome ASC";

    $result = $mysqli->query($sql) or die ("ERRO: Falha ao trazer a lista de servicos");

    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    echo json_encode($result);
  break;

  case 'NOVO_AGENDAMENTO':
    $cliente = $_POST["cliente"];
    $profissional = $_POST["profissional"];
    $servico = $_POST["servico"];
    $criaData = $_POST["data"];
    $criaHoraIni = $_POST["inicial"];
    $criaHoraFin = $_POST["final"];

    $sql = "INSERT INTO agenda (id_cliente,id_atendente,data_atendimento,hora_inicial,hora_final,id_servico) 
    VALUES ($cliente,$profissional,'$criaData','$criaHoraIni','$criaHoraFin',$servico)";
    
    $result = $mysqli->query($sql) or die ("ERRO: Falha criar agendamento");

    echo $result;
  break;
}

?>