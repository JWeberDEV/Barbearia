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

  case 'FATURAMENTO_MENSAL':
    $sql = "SELECT MONTHNAME(data_atendimento) as mes, SUM(valor_servico) AS 'fatoramento_Mensal'  FROM agenda
    GROUP BY MONTH (data_atendimento)
    ORDER BY data_atendimento; ";

    $result = $mysqli->query($sql) or die ("ERRO: Falha ao trazer faturamento mensal");
    $fatoramento = $result->fetch_all(MYSQLI_ASSOC);
    echo(json_encode($fatoramento));

  break;
}

?>