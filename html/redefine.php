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
    // if (!$_get["id"]) {
    //   header('location: ../index.html')
    // }
    $resh = $_GET["id"];
  ?>
  
    <main class="form">
      <form class="formulario">
        <div class="itens">
          <legend class="legenda">
            <h1>Redefinição de Senha</h1>
          </legend>
          <div class="caixa">
            <input type="hidden" id="resh" value="<?=$resh?>">
            <div style="padding-top:3%">
              <span>Nova Senha</span>
              <input type="hidden" name="mail" value="1">
              <input class="campos" type="password" id="newPD1" autocomplete="off" class="inputCustom" placeholder="Nova senha">
            </div>
            <div style="padding-top:3%">
              <span>Confirme a nova Senha</span>
              <input class="campos" type="password" id="newPD2" autocomplete="off" class="inputCustom" placeholder="Confirmação">
            </div>
          </div>
          
          <div class="submit" style="padding-top: 3%">
            <button class="salvar" type="button"> Enviar </button>
        </div>
      </form>  
    </main>
  
<script src="../js/scripts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>


<script>
  $("#newPD1").keyup(function(event) {
  if (event.keyCode === 13) {
    $(".salvar").click();
  }
  });

  $("#newPD2").keyup(function(event) {
  if (event.keyCode === 13) {
    $(".salvar").click();
  }
  });

  $(".salvar").click(function() {
    changePassWord();
  });


</script>