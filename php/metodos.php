<?php 

include 'conexao.php';
include 'funcoes.php';

$acao = $_POST['acao'];


switch ($acao) {
  case 'LOGIN':
    $usuario = addslashes($_POST['usuario']);
    $senha = addslashes($_POST['senha']);
    
    $sql = "SELECT id,nome_usuario,senha,user_status,perfil,cpf,email,nome FROM usuario WHERE BINARY nome_usuario = '$usuario' AND senha = '$senha' AND user_status = 'Ativo'";
    $resultado = $mysqli->query($sql) or die ("ERRO: A query de consulta esta incorreta");
    
    $linha = mysqli_num_rows($resultado);
    $dados = mysqli_fetch_object($resultado);
    

    $valida = " ";
    $_SESSION['login'] =  FALSE;
    if($linha == 0){
      $valida = 0;
    }else{
      $valida = 1;
      session_start();
      $_SESSION['login'] =  TRUE;
      $_SESSION['id'] = $dados->id;
      $_SESSION['nome'] = $dados->nome;
      $_SESSION['perfil'] = $dados->perfil;
      $_SESSION['status'] = $dados->user_status ;
      $_SESSION['cpf'] = $dados->cpf ;
      $_SESSION['email'] = $dados->email ;
    }

    echo ($valida);


  break;

  case 'TROCA SENHA':
    $resh = isset($_POST['resh']) ? $_POST['resh'] : "";
    $ID = encrypt_decrypt($resh, 'decrypt');

    $id = isset($_POST['id']) ? $_POST['id'] : $ID;
    $newPass = $_POST['newPass'];

    $sql = "UPDATE usuario SET senha = '$newPass' WHERE id = '$id' ";
    $resultado = $mysqli->query($sql) or die ("ERRO: Não foi possível alterar a senha");
    echo $resultado;
  break;

  case 'FINALIZA':
    session_start();
    session_destroy();
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

    echo ($valida);

  break;
  
  case 'RELATORIO':
    $busca =($_POST['conteudo']);
    $status =($_POST['status']);
    $limit = $_POST['limit'] == "T" ? 0 : $_POST['limit'];
    if (isset($_POST["page"])) { $page  = $_POST["page"]; } else { $page=1; };  

    $start_from = ($page-1) * $limit; 

    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE nome LIKE '%$busca%'"; 
    if($status !="Todos"){
    $sql .= " AND user_status = '$status'"; 
    }
    $sql .= " ORDER BY nome ";

    $resultado = $mysqli->query($sql) or  die ("ERRO: A query de relatorio esta incorreta");
    $returned_rows 	= mysqli_num_rows($resultado);

    $exec_calc_rows 	= $mysqli->query("SELECT FOUND_ROWS() AS cad_rows_found;");
    $retorno_rows_found = mysqli_fetch_object($exec_calc_rows);

    $pagina = $start_from + $limit;
    if ($pagina >= $retorno_rows_found->cad_rows_found || $pagina == 0) {
      $pagina = $retorno_rows_found->cad_rows_found;
    }
    
    if ($resultado->num_rows > 0) {
      while($user = $resultado->fetch_assoc()) {
        $resultClients = "<tr>
                <td>".$user["nome"]."</td>
                <td>".$user["nome_usuario"]."</td>
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

              $resultClients .= "<script>
                  $('.returned_rows').html('[ <b>".$pagina."</b> ] de [ <b>".$retorno_rows_found->cad_rows_found."</b> ] registro(s) encontrado(s).');
									$('.returned_rows_geral').val('".$retorno_rows_found->cad_rows_found."');
            </script>";
        
              echo $resultClients ; 
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
    $limit = $_POST['limit'] == "T" ? 0 : $_POST['limit'];
    if (isset($_POST["page"])) { $page  = $_POST["page"]; } else { $page=1; };  

    $start_from = ($page-1) * $limit; 


    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM cliente WHERE nome_cliente LIKE '%$cliente%'"; 
    if($cpf !=""){
    $sql .= " AND cpf LIKE '%$cpf%'"; 
    }
    $sql .= " ORDER BY nome_cliente ";

    if($limit !="T"){
      $sql .= " LIMIT $start_from, $limit "; 
    }

    $resultado = $mysqli->query($sql) or  die ("ERRO: A query de relatorio esta incorreta");
    $returned_rows 	= mysqli_num_rows($resultado);

    $exec_calc_rows 	= $mysqli->query("SELECT FOUND_ROWS() AS cad_rows_found;");
    $retorno_rows_found = mysqli_fetch_object($exec_calc_rows);

    $pagina = $start_from + $limit;
    if ($pagina >= $retorno_rows_found->cad_rows_found || $pagina == 0) {
      $pagina = $retorno_rows_found->cad_rows_found;
    }

    if ($resultado->num_rows > 0) {
      while($client = $resultado->fetch_assoc()) {
        $resulClientes = "<tr>
              <input type='hidden' id='id'>
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

            $resulClientes .= "<script>
                  $('.returned_rows').html('[ <b>".$pagina."</b> ] de [ <b>".$retorno_rows_found->cad_rows_found."</b> ] registro(s) encontrado(s).');
									$('.returned_rows_geral').val('".$retorno_rows_found->cad_rows_found."');
            </script>";

            echo $resulClientes;
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
      
      $resultado = $mysqli->query($sql) or die ("ERRO: A query de edição de úsuário, esta incorreta");

      echo $resultado;

      break;

      case 'CRIA SERVICO':
        $nomeservico = ($_POST['servico']);
        $precoservico = ($_POST['preco']);

        $sql = "INSERT INTO servicos (nome,valor) VALUES ('$nomeservico','$precoservico')";
        $result = $mysqli->query($sql) or die ("ERRO: A querry de inserção esta incorreta");

        $valida = 1;

        if ($result != 1) {
          $valida = o;
        }
        
        echo ($valida);
      break;

      case 'RELATORIO SERVICO':
        $busca = $_POST['conteudo'];
        $valor = $_POST['preco'];
        $limit = $_POST['limit'] == "T" ? 0 : $_POST['limit'];
        if (isset($_POST["page"])) { $page  = $_POST["page"]; } else { $page=1; };  

        $start_from = ($page-1) * $limit; 
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM servicos WHERE nome like '%$busca%' ";
        if($valor !=""){
          $sql .= " AND valor LIKE '%$valor%'"; 
        }

        $sql .= " ORDER BY nome ";

        if($limit !="T"){
          $sql .= " LIMIT $start_from, $limit "; 
        }

        $resultado = $mysqli->query($sql) or  die ("ERRO: A query de relatorio esta incorreta");
			  $returned_rows 	= mysqli_num_rows($resultado);

        $exec_calc_rows 	= $mysqli->query("SELECT FOUND_ROWS() AS cad_rows_found;");
			  $retorno_rows_found = mysqli_fetch_object($exec_calc_rows);

        $pagina = $start_from + $limit;
        if ($pagina >= $retorno_rows_found->cad_rows_found || $pagina == 0) {
          $pagina = $retorno_rows_found->cad_rows_found;
        }

        if ($resultado->num_rows > 0){
          while($servico = $resultado->fetch_assoc()) {
            $resulServicos = "<tr>
              <td>".$servico["nome"]."</td>
              <td>".$servico["valor"]." </td> 
              <td>
                  <div class='btnfunc'>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <a onclick='exibirservico(".$servico["id"].")' href='#'><button data-bs-toggle='modal' data-bs-target='#editar-servico' class='funcoes'><i class='fa fa-pencil pencil' aria-hidden='true'></i></button></a>
                      <a onclick='deletaservico(".$servico["id"].")' href='#'><button class='funcoes'><i class='fa fa-times cross' aria-hidden='true'></i></button></a>
                  </div>
                </div>
              </td>
            </tr>";

            $resulServicos .= "<script>
                  $('.returned_rows').html('[ <b>".$pagina."</b> ] de [ <b>".$retorno_rows_found->cad_rows_found."</b> ] registro(s) encontrado(s).');
									$('.returned_rows_geral').val('".$retorno_rows_found->cad_rows_found."');
            </script>";

            

            echo $resulServicos;
          }
        }
        break;

        case 'DELETA SERVICO':
          $id = ($_POST['id']);

          $mysqli->query("DELETE FROM servicos WHERE id = '$id'") or die ("ERRO: Não foi Possivel deletar o registro");
          
        break;

        case 'EXIBIR SERVICO':
          $id = ($_POST['id']);

          $sql = "SELECT * FROM servicos WHERE id = $id";

          $resultado = $mysqli->query($sql) or die ("ERRO: A query de exibção esta incorreta");
          $retorno = $resultado->fetch_all(MYSQLI_ASSOC);
          $retorno = json_encode($retorno);
          echo $retorno;

        break;

        case 'EDITAR SERVICO':
          $id = ($_POST['id']);
          $altnome = ($_POST['nome']);
          $altvalor = ($_POST['preco']);

          $sql = " UPDATE servicos SET nome = '$altnome', valor = '$altvalor' WHERE id = '$id' ";
          
          $resultado = $mysqli->query($sql) or die ("ERRO: A query de edição de úsuário, esta incorreta");

          echo $resultado;

        break;
}
// $data->cad_busca = str_replace(' ','',$data->cad_busca);

?>


