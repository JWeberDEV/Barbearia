<?php 

include 'conexao.php';

$relatorio = $_POST['relatorio'];


switch ($relatorio) {
  case 'AGENDAMENTOS_POR_CLIENTE':

    $sql = " SELECT COUNT(a.id_cliente) agendamentos,c.nome_cliente FROM cliente c
    INNER JOIN agenda a ON c.id = a.id_cliente
    GROUP BY a.id_cliente
    ORDER BY COUNT(a.id_cliente) DESC; ";
    
    $result = $mysqli->query($sql) or die ("ERRO: Falha ao trazer a contagem de agendamentos por cliente");
    $retorno = $result->fetch_all(MYSQLI_ASSOC);
    echo(json_encode($retorno));

  break;
  
  case 'QUANTIDADE_AGENDAMENTOS_ATENDENTE':
    $sql = " SELECT COUNT(a.id_status) AS 'finalizado',u.nome_usuario FROM agenda a
    INNER JOIN usuario u ON u.id = a.id_atendente
    WHERE a.id_status = 2
    GROUP BY a.id_atendente
    ORDER BY Finalizado DESC ";

    $result = $mysqli->query($sql) or die ("ERRO: Falha ao trazer a contagem de agendamentos encerrados por atendente");
    $quantidade = $result->fetch_all(MYSQLI_ASSOC);
    echo(json_encode($quantidade));

  break;

  // SET GLOBAL lc_time_names = 'pt_PT'; <- para resolver o problema da linguagem é preciso mudar a variável global do banco executando essa query;
  case 'FATURAMENTO_MENSAL':

    $sql = "SET lc_time_names = 'pt_PT'; SELECT MONTHNAME(data_atendimento) as mes, SUM(valor_servico) AS 'fatoramento_Mensal'  FROM agenda
    GROUP BY MONTH (data_atendimento)
    ORDER BY data_atendimento; ";

    $result = $mysqli->multi_query($sql) or die ("ERRO: Falha ao trazer faturamento mensal");
    do { 
      if ($result = $mysqli->store_result()) { 
        echo(json_encode($result->fetch_all(MYSQLI_ASSOC)));
        $result->free(); 
      } 
    } while ($mysqli->more_results() && $mysqli->next_result());
    
    // while ($mysqli->next_result()) {;}

  break;

  case 'FATURAMENTO_PROFI':
    $sql = "SELECT MONTHNAME(a.data_atendimento) AS 'mensal' ,u.nome_usuario, SUM(a.valor_servico) AS 'faturamento_funcionario' 
    FROM agenda a
    INNER JOIN usuario u ON u.id = a.id_atendente
    WHERE a.id_status = 2
    GROUP BY MONTH(a.data_atendimento), u.nome_usuario
    ORDER BY MONTH(a.data_atendimento), faturamento_funcionario,u.nome_usuario DESC;";

    $result = $mysqli->query($sql) or die ("ERRO: Falha ao trazer a contagem de agendamentos encerrados por atendente");
    $quantidade = $result->fetch_all(MYSQLI_ASSOC);
    echo(json_encode($quantidade));

  break;
}

?>