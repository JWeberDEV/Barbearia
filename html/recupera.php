<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RECUPERAR</title>
  <link rel="icon" href="../img/logo_barber.png" alt="Icone Pagina" />
  <link rel="stylesheet" href="../libs/font-awesome-4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="../libs/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>

  <main class="form">
    <form class="formulario" action="#" method="#">
      <div class="itens">
        <legend class="legenda">
          <h1>Recuperar senha</h1>
        </legend>
        <div class="caixa">
          <input class="campos" type="text" id="email" autocomplete="off" class="inputCustom" placeholder="Informe seu e-mail">
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
  $("#email").keyup(function(event) {
  if (event.keyCode === 13) {
    $(".salvar").click();
  }
  });

  $(".salvar").click(function() {
    sendEmail();
  });


</script>