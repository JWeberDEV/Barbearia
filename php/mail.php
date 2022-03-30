<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../libs/PHPMailer/src/Exception.php';
require '../libs/PHPMailer/src/PHPMailer.php';
require '../libs/PHPMailer/src/SMTP.php';
include 'conexao.php';
include 'funcoes.php';

$acao = $_POST["acao"];

switch ($acao) {
  case 'ENVIA EMEAIL':
  
  $email = $_POST["email"];
  
  $sql = "SELECT id,nome_usuario FROM usuario WHERE email = '$email' ";
  $retorno = $mysqli->query($sql) or die ("ERRO: falha ao executar a query");

  if ($retorno->num_rows > 0) {
    
    $resultado = $retorno->fetch_all(MYSQLI_ASSOC);  
    
    foreach ($resultado as $key => $value) {
      $id = ($value ['id'] );
      $nome = ($value ["nome_usuario"] );
    }

    $resh = encrypt_decrypt($id,'encrypt');

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 4;
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.office365.com';                   // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'weberjosias1@hotmail.com';                 // SMTP username
    $mail->Password = 'AC04gr123@';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('weberjosias1@hotmail.com', '');
    $mail->addAddress($email, 'Usuario');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('weberjosias1@hotmail.com, 'Retorno');
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->CharSet = 'utf-8';
    $mail->Subject = 'Recuperação de Senha';
    $mail->Body    = "<h1>Ola $nome !</h1> <br>  Para recuperar o acesso do seu usuário, é necessário clicar no link abaixo para o redirecionamento a página onde sua senha será redefinida. <br><br> <a href='localhost/Barbearia/html/redefine.php?id=$resh'>Clique aqui para redefinir a senha</a>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
      echo "Um e-mail foi enviado para $email";
    }
  }else {
    echo("o e-mail digitado é inválido");
  }

  break;
  
}
?>