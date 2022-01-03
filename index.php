<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>
  <link rel="icon" href="img/logo_barber.png" alt="Icone Pagina" />
  <!-- <link rel="stylesheet" href="../bootstrap-5.1.3-dist/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/login.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

  <?php
   if ($_SERVER['REQUEST_METHOD'] == "POST") {
     echo "USUARIO -> ";
     echo $_POST['usuario'];
     echo "<br>imagina que aqui vem um monte de coisa pra conectar com o banco e
     dizer pro backend que está logado <br>
     sem JS, apenas PHP bem arcaico";
   }
   else{ ?>
  <main class="form">
    <form class="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="itens">
        <legend class="legenda">
          <h1>Barbearia Login</h1>
        </legend>
        <div class="caixa" style="padding-top: 4%;">
          <input class="campos" type="text" id="usuario" name='usuario' autocomplete="off" placeholder="Login" required>
        </div>
        <div class="caixa" style="padding-top: 4%;">
          <input class="campos" type="password" id="senha" name='senha' autocomplete="off" placeholder="Senha" required>
        </div>
        <br/>
        <div class="submit">
          <button type="submit" name="button"></button>
        </div>
      </div>
    </form>
  </main>
<?php } ?>

</body>
</html>
