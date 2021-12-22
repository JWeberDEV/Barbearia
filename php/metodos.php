<?php 

include 'conexao.php';


$acao = $_POST['acao'];



switch ($acao) {
  case 'LOGIN':
    $login = addslashes($_POST['usuario']);
    $senha = addslashes($_POST['senha']);
    
    $sql = "SELECT nome_usuario,senha FROM usuario WHERE nome_usuario = '$login' and senha = '$senha'";
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
    
    $linha = mysqli_num_rows($resultado);

    $valida = 0;
    if($linha == 0){
      $valida = 0;
    }else{
      $valida = 1;
    }
    echo ($valida);
    
  break;
  
  case 'RELATORIO':
    $busca =($_POST['conteudo']);
    $status =($_POST['status']);
    

    $sql = "SELECT id,nome_usuario,email,perfil,user_status FROM usuario WHERE nome_usuario LIKE '%$busca%'"; 
    if($status !="Todos"){
    $sql .= " AND user_status = '$status'"; 
    }
    $sql .= " ORDER BY nome_usuario ";

    $resultado = $mysqli->query($sql) or die ("ERRO: A query de relatorio esta incorreta");
    
    if ($resultado->num_rows > 0) {
      while($user = $resultado->fetch_assoc()) {
        echo "<tr>
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
      }
    }
    break;
    case 'DELETAR':
      $id = ($_POST['id']);

      $mysqli->query("DELETE FROM usuario WHERE id = '$id'");

    break;
    case 'EXIBIR':
      $id = ($_POST['id']);

      $result = $mysqli->query("SELECT nome_usuario,cpf,telefone,email,perfil,user_status FROM usuario WHERE id = '$id'");
      $retorno = $result->fetch_all(MYSQLI_ASSOC);
      $retorno = json_encode($retorno);
      echo $retorno;

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
    // case '':
    //   $altnome = ($_POST['nome']);
    //   $altcpf = ($_POST['cpf']);
    //   $altemail = ($_POST['email']);
    //   $altnumero = ($_POST['numero']);
    //   $altdatanasc = ($_POST['datanasc']);
    //   $altprofissao = ($_POST['profissao']);
    //   $altcidade = ($_POST['cidade']);
    // break;

}


?>

