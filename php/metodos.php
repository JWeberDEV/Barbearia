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

            //   "<div class='modal' id='editar'>
            //     <div class='modal-dialog'>
            //         <div class='modal-content'>
            
            //             <div class='modal-header' style='background-color: #aea7f8;'>
            //                 <h4 class='modal-title'>Finalizar agendamento</h4>
            //                 <button type='button' class='close' data-bs-dismiss='modal'><i class='fa fa-times' aria-hidden='true'></i></button>
            //             </div>
                
            //             <div class='modal-body'>
            //                 <form class='formulario'>
            //                     <div class='item2'>
            //                         <label>Nome Usuário:</label>
            //                         <input id='altname' class='itens' type='text' name='nome' autocomplete='off' placeholder=' Nome Completo'>
            //                     </div>
            //                     <div class='item2'>
            //                         <label>CPF Usuário:</label>
            //                         <input id='altcpf' class='itens' type='text' name='nome' autocomplete='off' placeholder='___.___.___-__'>
            //                     </div>
            //                     <div class='item2'>
            //                         <label>Numero Usuário:</label>
            //                         <input id='altnumberclient' class='itens' type='text' name='nome' autocomplete='off' placeholder='(__) _____-____'>
            //                     </div>
            //                     <div class='item2'>
            //                         <label>Email Usuário:</label>
            //                         <input id='altmailclient' class='itens' type='text' name='nome' autocomplete='off' placeholder='email@exemplo.com'>
            //                     </div>
            //                     <div class='item2'>
            //                         <label>Data de Nascimento:</label>
            //                         <input id='altdateborn' class='itens' type='date' name='nome' autocomplete='off' >
            //                     </div>
            //                     <div class='item2'>
            //                         <label>Perfil:</label>
            //                         <br>
            //                         <select id='altprofile' name='Perfil'>
            //                             <option value='Analista de Sistemas'>Analista de Sistemas</option>
            //                             <option value='ADM'>ADM</option>
            //                             <option value='Profissional'>Profissional</option>
            //                             <option value='TI'>TI</option>
            //                         </select>
            //                     </div>
            //                     <div class='item2'>
            //                         <label for='status'>Status:</label>
            //                         <br>
            //                         <select id='altstatus' name='status'>
            //                             <option value='Ativo'>Ativo</option>
            //                             <option value='Inativo'>Inativo</option>
            //                         </select>
            //                     </div>
            //                 </form>
            //                     <div style='padding-top: 1%;'>
            //                         <button class='btn-success btnmodal' type='button' onclick='editar(".$user["id"].")' >Salvar</button>
            //                     </div>
            //                     <div style='padding-top: 1%;'>
            //                         <button type='button' class='btn-primary btnmodal close' data-bs-dismiss='modal'>Finalizar</button>
            //                     </div>
            //                 </div>
            //             </div>
                
                        
            //         </div>
            //     </div>
            // </div>";
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
    case 'EDITAR':
      
      $altnome = ($_POST['altnome']);
      $altcpf = ($_POST['altcpf']);
      $altemail = ($_POST['altemail']);
      $altnumero = ($_POST['altnumero']);
      $altdatanasc = ($_POST['altdatanasc']);
      $altprofissao = ($_POST['altprofissao']);
      $altstatus = ($_POST['altstatus']);

      $result = $mysqli->query("SELECT cpf FROM usuario WHERE cpf = '$altcpf' ");
      $retorno = $result->fetch_all(MYSQLI_ASSOC);
      $condicao = (double) $retorno;

      if ($condicao == 1) {
        $sql = "UPDATE usuario SET nome = '$altnome', WHERE id = '$id'";
        
      }
    break;
    
    
}


?>

