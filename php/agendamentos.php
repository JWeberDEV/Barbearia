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
    $idProfissional = $_POST["idProfissional"];
    $buscaCliente = $_POST["cliente"];
    
    $sql = 
      "SELECT 
        a.id, 
        c.nome_cliente, 
        a.data_atendimento, 
        a.hora_inicial, 
        a.hora_final,
        s.chave,
        s.cor_status,
        a.id_servico
    FROM agenda a 
    INNER JOIN usuario u ON u.id = a.id_atendente 
    INNER JOIN cliente c ON c.id = a.id_cliente 
    INNER JOIN status_agenda s ON s.id = a.id_status
    WHERE 1 = 1";

    if($idProfissional){
      $sql .= " AND a.id_atendente = $idProfissional";
    }
    if ($buscaCliente) {
      $sql .= " AND c.nome_cliente LIKE '%$buscaCliente%' ";
    }
    

    // if($idCliente){
    //   sql.= " AND a.id_cliente = $idCliente";
    // }

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

  case 'VALOR_AGENDAMENTO':
    $servico = $_POST['servico'];

    $sql = "SELECT valor FROM servicos WHERE id = '$servico' ";
    $query = $mysqli->query($sql) or die ("ERRO: ao trazer o valor");
    $result =  mysqli_fetch_object($query);
    $valor = $result->valor;
    echo $valor;

  break;

  case 'NOVO_AGENDAMENTO':
    $cliente = $_POST["cliente"];
    $profissional = $_POST["profissional"];
    $servico = $_POST["servico"];
    $criaData = $_POST["data"];
    $criaHoraIni = $_POST["inicial"];
    $criaHoraFin = $_POST["final"];
    $preco = $_POST["preco"];

    $sql = "INSERT INTO agenda (id_cliente,id_atendente,data_atendimento,hora_inicial,hora_final,id_servico,valor_servico,id_status) 
    VALUES ($cliente, $profissional, '$criaData', '$criaHoraIni', '$criaHoraFin', $servico, $preco, 1)";
    
    $result = $mysqli->query($sql) or die ("ERRO: Falha criar agendamento");

    echo $result;
  break;

  case 'BUSCA_AGENDAMENTO':
    $idAgendamento =$_POST["id"];

    $sql = " SELECT id,id_cliente,id_atendente,id_servico,data_atendimento,hora_inicial,hora_final,id_status,valor_servico FROM agenda WHERE id = '$idAgendamento'  ";
    
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
    $status = $_POST["status"];
    $valor = $_POST["valor"];

    $sql = " UPDATE agenda SET id_cliente = $cliente, id_servico = $servico, data_atendimento = '$data', hora_inicial = '$horaInicial', hora_final =  '$horaFinal', id_atendente = $atendente, id_status = $status, valor_servico = '$valor' WHERE id = $id ";

    $resultado = $mysqli->query($sql) or die ("ERRO: A query de edição de úsuário, esta incorreta");

    echo $resultado;
  break;

  case 'CANCELA_EVENTO':
    $id = $_POST["id"];
    $justificativa = $_POST["justificativa"];

    $sql = "UPDATE agenda SET justificativa = '$justificativa', id_status = 4 WHERE id = '$id'";

    $resultado = $mysqli->query($sql) or die ("ERRO: A query de edição de úsuário, esta incorreta");

    echo $resultado;
  break;

  case 'EXIBE_JUSTIFICATIVA':
    $id = $_POST["id"];

    $sql = "SELECT justificativa FROM agenda WHERE id = $id";

    $result = $mysqli->query($sql) or die ("ERRO: Falha ao trazer a justificativa");

    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    echo json_encode($result);
  break;

  case 'FINALIZA_ATENDIMENTO':
    $id = $_POST["id"];
    $consulta = " SELECT s.valor FROM agenda a
    INNER JOIN servicos s ON s.id = a.id_servico
    WHERE a.id = $id ";
    $query = $mysqli->query($consulta) or die ("ERRO: Falha ao trazer o valor do servico");
    $result =  mysqli_fetch_object($query);
    $valor = $result->valor;

    $sql = "UPDATE agenda SET id_status = 2, valor_servico = '$valor'  WHERE id = $id";
    $resultado = $mysqli->query($sql) or die ("ERRO: Ao finalizar agendamento");
    echo $resultado;
  break;

  case 'CONTA_AGENDAMENTOS':
    $id = $_POST["id"];

    $sql = " SELECT a.id_cliente FROM agenda a WHERE id = $id";
    $agenda = $mysqli->query($sql) or die ("ERRO: trazer o id do cliente");

    if($agenda->num_rows > 0){
      $objectClient = mysqli_fetch_object($agenda);
      $idCliente = $objectClient->id_cliente;
      
      $sql2 = " SELECT COUNT(a.id_cliente) AS 'total_agendamentos' FROM agenda a WHERE id_cliente = $idCliente /*AND id_servico = 2*/";
      echo $sql2;
      $result = $mysqli->query($sql2) or die ("ERRO: ao trazer a quantidade de agendamentos");
      $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
      echo json_encode($result);

    }

  break;

  case 'DELETA_AGENDAMENTO':
    $id = $_POST["id"];

    $mysqli->query(" DELETE FROM agenda WHERE id = $id ");

  break;

  case 'REDIMENCIONA_AGENDAMENTO':
    $id = $_POST["id"];
    $data = $_POST["data"];
    $horaInicial = $_POST["horaInicial"];
    $horaFinal = $_POST["horaFinal"];

    $sql = " UPDATE agenda SET data_atendimento = '$data', hora_inicial = '$horaInicial', hora_final =  '$horaFinal' WHERE id = $id ";
    
    $resultado = $mysqli->query($sql) or die ("ERRO: A query de edição de úsuário, esta incorreta");

    echo $resultado;
  break;
}

?>
