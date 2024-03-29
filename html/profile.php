<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>CLIENTES</title>
    <?php require_once "../includes/inportacoes _css.php"; ?>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <?php require_once "../includes/menu.php"?>

        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php require_once "../includes/navbar.php"?>

            <div style="padding-top: 7%;">
                <div class="container2 tabela">
                    <div class="item2">
                        <input type="hidden" id="id" value="<?php print($_SESSION['id']);?>">
                        <label>Nome</label>
                        <input id="id-login" type="hidden" >
                        <input id="nome" class="campos2" type="text" desabled="ture" autocomplete="off" value="<?php print($_SESSION['nome']);?>">
                    </div>
                    <div class="item2">
                        <label>CPF</label>
                        <input id="cpf" class="campos2" type="text" autocomplete="off" value="<?php print($_SESSION['cpf']);?>">
                    </div>
                    <div class="item2">
                        <label>Email</label>
                        <input id="email" class="campos2" type="email" autocomplete="off" value="<?php print($_SESSION['email']);?>">
                    </div>
                    <div class="item2">
                        <label>Perfil</label>
                        <select id="status" class="status" name="Perfil">
                            <option value="<?php print($_SESSION['email']);?>"><?php print($_SESSION['perfil']);?></option>
                            
                        </select>
                    </div>
                    <div class="item2">
                        <label>Nova Senha</label>
                        <input id="newPD1" class="campos2" type="password" autocomplete="off" placeholder="">
                    </div>
                    <div class="item2">
                        <label>Confirma Senha</label>
                        <input id="newPD2" class="campos2" type="password" autocomplete="off" placeholder="">
                    </div>
                    <div class="item2 d-flex justify-content-center">
                        <div class="submit">
                            <br>
                            <button id="changePD" class="salvar" type="button" onclick="changePassWord()">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once "../includes/inportacoes _scripts.php"; ?>
    
</body>
</html>

<script>
    mascara();
    inputDisable();

$("#newPD1").keyup(function(event) {
  if (event.keyCode === 13) {
    $("#changePD").click();
  }
});

$("#newPD2").keyup(function(event) {
  if (event.keyCode === 13) {
    $("#changePD").click();
  }
});

$("#changePD").click(function() {
  changePassWord()
});

function mascara(){
    $('#cpf').mask('000.000.000-00', {reverse: true});
    // $('#numberclient').mask('(00) 0000-00000');
    
};

function inputDisable(){
    $('#nome').attr('disabled', true);
    $('#cpf').attr('disabled', true);
    $('#email').attr('disabled', true);
    $('#status').attr('disabled', true);
}
</script>
