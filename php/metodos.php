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
  
  case 'NEW_USER':
    
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
    

    $sql = "SELECT nome_usuario,email,perfil,user_status FROM usuario WHERE nome_usuario LIKE '%$busca%'"; 
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
                        <a href='create_users.html'><button class='funcoes'><i class='fa fa-pencil pencil' aria-hidden='true'></i></button></a>
                        <a href='#'><button class='funcoes'><i class='fa fa-times cross' aria-hidden='true'></i></button></a>
                    </div>
                  </div>
                </td>
              </tr>";
      }
    }
    break;
}


?>

