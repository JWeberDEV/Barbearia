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

  case 'STATUS':
    
    $sql = "SELECT id,nome FROM status_agenda ORDER BY id ASC";

    $result = $mysqli->query($sql) or die ("ERRO: Falha ao trazer a lista de status");

    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    echo json_encode($result);
  break;
  
  case 'AGENDAMENTOS':
    $sql = " SELECT a.id, c.nome_cliente, a.data_atendimento, a.hora_inicial, a.hora_final,s.chave,s.cor_status FROM agenda a 
    INNER JOIN usuario u ON u.id = a.id_atendente 
    INNER JOIN cliente c ON c.id = a.id_cliente 
    INNER JOIN status_agenda s ON s.id = a.id_status ";

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

    $sql = "INSERT INTO agenda (id_cliente,id_atendente,data_atendimento,hora_inicial,hora_final,id_servico,id_status) 
    VALUES ($cliente,$profissional,'$criaData','$criaHoraIni','$criaHoraFin',$servico,1)";
    
    $result = $mysqli->query($sql) or die ("ERRO: Falha criar agendamento");

    echo $result;
  break;

  case 'BUSCA_AGENDAMENTO':
    $idAgendamento =$_POST["id"];

    $sql = " SELECT id,id_cliente,id_atendente,id_servico,data_atendimento,hora_inicial,hora_final,id_status FROM agenda WHERE id = '$idAgendamento'  ";
    
    $result = $mysqli->query($sql) or die ("ERRO: Falha ao trazer o agendamento");

    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    echo json_encode($result);

  break;

  case 'EDITA_AGENDAMENTO':
    $id = $_POST["id"];
    $cliente = $_POST["cliente"];
    $servico = $_POST["servico"];
    $data = $_POST["data"];
    $horaInicial = $_POST["horaInicial"];
    $horaFinal = $_POST["horaFinal"];
    $atendente = $_POST["atendente"];

    $sql = " UPDATE agenda SET id_cliente = $cliente, id_servico = $servico, data_atendimento = '$data', hora_inicial = '$horaInicial', hora_final =  '$horaFinal', id_atendente= $atendente WHERE id = $id ";

    $resultado = $mysqli->query($sql) or die ("ERRO: A query de edição de úsuário, esta incorreta");

    echo $resultado;
  break;
}

?>
