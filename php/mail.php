<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../libs/PHPMailer/src/Exception.php';
require '../libs/PHPMailer/src/PHPMailer.php';
require '../libs/PHPMailer/src/SMTP.php';


$acao = $_POST["acao"];

switch ($acao) {
  case 'ENVIA EMEAIL':
  
  $email = $_POST["email"];
  
  $mail = new PHPMailer(true);
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
  $mail->isSMTP();     
  $mail->SMTPDebug = 4;                                 // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'weberjosias1@gmail.com';                 // SMTP username
  $mail->Password = '8653454513';                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port = 587;                                    // TCP port to connect to

  $mail->setFrom('weberjosias1@gmail.com ', 'Josias');
  $mail->addAddress($email, 'Usuario');     // Add a recipient
  // $mail->addAddress('ellen@example.com');               // Name is optional
  // $mail->addReplyTo('weberjosias1@gmail.com, 'Retorno');
  

  // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->CharSet = 'utf-8';
  $mail->Subject = 'Recuperação de Senha';
  $mail->Body    = 'Teste de mensagem pra ver se ta funcionando o PHPMail';
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo "Um e-mail foi enviado para $email";
  }

  break;
  
}
?>