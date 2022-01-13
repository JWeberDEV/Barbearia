<?php 

include 'conexao.php';

$acao = $_POST['acao'];


switch ($acao) {
  case 'LOGIN':
    $login = addslashes($_POST['usuario']);
    $senha = addslashes($_POST['senha']);
    
    $sql = "SELECT nome_usuario,senha,user_status FROM usuario WHERE BINARY nome_usuario = '$login' AND senha = '$senha' AND user_status = 'Ativo'";
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
    $perfil = ($_POST['perfil']);
    $login = ($_POST['login']);
    $password = ($_POST['password']);
    $status = ($_POST['status']);

    $sql = "INSERT INTO usuario (nome_usuario,cpf,email,telefone,senha,perfil,user_status,nome) VALUES ('$login','$cpf','$email','NULL','$password','$perfil','$status','$nome')";
    $resultado = $mysqli->query($sql) or die ("ERRO: A query de criacao esta incorreta");

    $valida = 1;
    
    if ($resultado != 1) {
      $valida = o;
    }

    // echo ($valida);

  break;
  
  case 'RELATORIO':
    $busca =($_POST['conteudo']);
    $status =($_POST['status']);
    

    $sql = "SELECT id,nome,email,perfil,user_status FROM usuario WHERE nome LIKE '%$busca%'"; 
    if($status !="Todos"){
    $sql .= " AND user_status = '$status'"; 
    }
    $sql .= " ORDER BY nome ";

    $resultado = $mysqli->query($sql) or die ("ERRO: A query de relatorio esta incorreta");
    
    if ($resultado->num_rows > 0) {
      while($user = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>".$user["nome"]."</td>
                <td>".$user["email"]." </td> 
                <td>".$user["perfil"]."</td>
                <td>".$user["user_status"]."</td>
                <td>
                    <div class='divfunc'>
                        <a onclick='exibir(".$user["id"].")' href='#'><button data-bs-toggle='modal' data-bs-target='#editar' class='funcoes'><i class='fa fa-pencil pencil' aria-hidden='true'></i></button></a>
                        <a onclick='deletar(".$user["id"].")' href='#'><button class='funcoes'><i class='fa fa-times cross'  aria-hidden='true'></i></button></a>
                    </div>
                  </div>
                </td>
              </tr>";
        
      }
    }

    break;

    case 'DELETAR':
      $id = ($_POST['id']);

      $mysqli->query("DELETE FROM usuario WHERE id = '$id'");

    break;

    case 'EXIBIR':
      $id = ($_POST['id']);

      $result = $mysqli->query("SELECT nome,cpf,telefone,email,perfil,user_status FROM usuario WHERE id = '$id'");
      $retorno = $result->fetch_all(MYSQLI_ASSOC);
      $retorno = json_encode($retorno);
      echo $retorno;

    break;
    
    case 'EDITAR':
      $id = ($_POST['id']);
      $altnome = ($_POST['altnome']);
      $altcpf = ($_POST['altcpf']);
      $altemail = ($_POST['altemail']);
      $altnumero = ($_POST['altnumero']);
      $altprofissao = ($_POST['altprofissao']);
      $altstatus = ($_POST['altstatus']);
      
      $sql = "UPDATE usuario SET nome = '$altnome', cpf = '$altcpf', email = '$altemail', telefone = '$altnumero', perfil= '$altprofissao', user_status = '$altstatus' WHERE id = '$id' ";
      
      $resultado = $mysqli->query($sql) or die ("ERRO: A query de edição de úsuário, esta incorreta");
      echo $resultado;

    break;
    
    case 'NEW_CLIENT':
    
      $nome = ($_POST['nome']);
      $cpf = ($_POST['cpf']);
      $email = ($_POST['email']);
      $numero = ($_POST['numero']);
      $datanasc = ($_POST['datanasc']);
      $profissao = ($_POST['profissao']);
      $cidade = ($_POST['cidade']);
  
      $sql = "INSERT INTO cliente (nome_cliente,cpf,email,telefone,data_nasc,profissao,cidade) VALUES ('$nome','$cpf','$email','$numero','$datanasc','$profissao','$cidade')";
      
      $resultado = $mysqli->query($sql) or die ("ERRO: A query de criacao esta incorreta");
      
  
      $valida = 1;
    
      if ($resultado != 1) {
        $valida = o;
      }
      
      echo ($valida);
      

    break;

    case 'RELATORIO CLIENTE':
    $cliente = ($_POST['cliente']);
    $cpf = ($_POST['cpf']);

    $sql = "SELECT id,nome_cliente,email,telefone,total_agendados FROM cliente WHERE nome_cliente LIKE '%$cliente%'"; 
    if($cpf !=""){
    $sql .= " AND cpf LIKE '%$cpf%'"; 
    }
    $sql .= " ORDER BY nome_cliente ";

    $resultado = $mysqli->query($sql) or die ("ERRO: A query de relatorio esta incorreta");
    
    if ($resultado->num_rows > 0) {
      while($client = $resultado->fetch_assoc()) {
      echo "<tr>
              <td>".$client["nome_cliente"]."</td>
              <td>".$client["email"]." </td> 
              <td>".$client["telefone"]."</td>
              <td>".$client["total_agendados"]."</td>
              <td>
                  <div class='divfunc'>
                      <a onclick='exibircliente(".$client["id"].")' href='#'><button data-bs-toggle='modal' data-bs-target='#editarcliente' class='funcoes'><i class='fa fa-pencil pencil' aria-hidden='true'></i></button></a>
                      <a onclick='deletarcliente(".$client["id"].")' href='#'><button class='funcoes'><i class='fa fa-times cross' aria-hidden='true'></i></button></a>
                  </div>
                </div>
              </td>
            </tr>";
      }
    }

      break;

    case 'DELETA CLIENTE':
      $id = ($_POST['id']);

      $mysqli->query("DELETE FROM cliente WHERE id = '$id'");
      break;
    
    case 'EXIBIR CLIENTE':
      $id = ($_POST['id']);

      $sql = "SELECT nome_cliente,cpf,telefone,email,data_nasc,profissao,cidade FROM cliente WHERE id = $id";
      $resultado = $mysqli->query($sql) or die ("ERRO: A query de exibção esta incorreta");
      $retorno = $resultado->fetch_all(MYSQLI_ASSOC);
      $retorno = json_encode($retorno);
      echo $retorno;

      break;  

    case 'EDITA CLIENTE':
      $id = ($_POST['id']);
      $altnome = ($_POST['altnome']);
      $altcpf = ($_POST['altcpf']);
      $altemail = ($_POST['altemail']);
      $altnumero = ($_POST['altnumero']);
      $altdata = ($_POST['altdata']);
      $altprofissao = ($_POST['altprofissao']);
      $altcidade = ($_POST['altcidade']);
      
      $sql = " UPDATE cliente SET nome_cliente = '$altnome', cpf = '$altcpf', email = '$altemail', telefone = '$altnumero', data_nasc =  '$altdata', profissao= '$altprofissao', cidade = '$altcidade' WHERE id = '$id' ";
      echo $sql;
      $resultado = $mysqli->query($sql) or die ("ERRO: A query de edição de úsuário, esta incorreta");

      echo $resultado;

      break;
      case 'RELATORIO SERVICO':
        $busca =($_POST['conteudo']);
        $valor =($_POST['preco']);

        $sql = "SELECT * FROM servicos WHERE nome like '%$busca%' ";
        if($valor !=""){
          $sql .= " AND valor LIKE '%$valor%'"; 
        }
        $sql .= " ORDER BY nome ";
        echo $sql;
        $resultado = $mysqli->query($sql) or  die ("ERRO: A query de relatorioesta incorreta");

        if  ($resultado->num_rows > 0){
          while($servico = $resultado->fetch_assoc()) {
            echo "<tr>
              <td>".$servico["nome"]."</td>
              <td>".$servico["valor"]." </td> 
              <td>
                  <div class='divfunc'>
                      <a onclick='exibircliente(".$servico["id"].")' href='#'><button data-bs-toggle='modal' data-bs-target='#editarcliente' class='funcoes'><i class='fa fa-pencil pencil' aria-hidden='true'></i></button></a>
                      <a onclick='deletarcliente(".$servico["id"].")' href='#'><button class='funcoes'><i class='fa fa-times cross' aria-hidden='true'></i></button></a>
                  </div>
                </div>
              </td>
            </tr>";
          }
        }
        break;
}

?>


