<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>REDEFINÇÃO DE SENHA</title>
  <link rel="icon" href="../img/logo_barber.png" alt="Icone Pagina" />
  <link rel="stylesheet" href="../libs/font-awesome-4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="../libs/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>
  <?php 
    $resh = $_GET["id"];

    function encrypt_decrypt($text, $method = 'encrypt'){ 
      
      if($method == 'encrypt'){ 
          $text = base64_encode(openssl_encrypt($text, 'AES-256-CBC', '457jk9@','0', '1234567891011121')); 
      }elseif($method == 'decrypt'){ 
          $text = openssl_decrypt(base64_decode($text), 'AES-256-CBC', '457jk9@','0', '1234567891011121'); 
      }                 
    
      return $text; 
    }

    $id = encrypt_decrypt($resh,'decrypt');
    
    ?>
  
    <main class="form">
      <form class="formulario">
        <div class="itens">
          <legend class="legenda">
            <h1>Redefinição de Senha</h1>
          </legend>
          <div class="caixa">
            <input type="hidden" id="id" value="<?=$id?>">
            <span>Nova Senha</span>
            <input class="campos" type="text" id="newPD1" autocomplete="off" class="inputCustom" placeholder="Nova senha">
            <span>Confirme a nova Senha</span>
            <input class="campos" type="text" id="newPD2" autocomplete="off" class="inputCustom" placeholder="Confirmação">
          </div>
          <br/>
          <div class="submit">
            <button class="salvar" type="button"> Enviar </button>
        </div>
      </form>  
    </main>
  
<script src="../js/scripts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>


<script>
  $("newPass1").keyup(function(event) {
  if (event.keyCode === 13) {
    $(".salvar").click();
  }
  });

  $("newPass2").keyup(function(event) {
  if (event.keyCode === 13) {
    $(".salvar").click();
  }
  });

  $(".salvar").click(function() {
    changePassWord()
  });


</script>