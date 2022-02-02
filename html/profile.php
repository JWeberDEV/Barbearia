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
                        <label>Seu Nome</label>
                        <input id="id-login" type="hidden" >
                        <input class="campos2" type="text" name="nome" autocomplete="off" value="<?php print($_SESSION['nome']);?>">
                    </div>
                    <div class="item2">
                        <label>CPF</label>
                        <input class="campos2" type="text" name="nome" autocomplete="off" value="<?php print($_SESSION['cpf']);?>">
                    </div>
                    <div class="item2">
                        <label>Email</label>
                        <input class="campos2" type="text" name="nome" autocomplete="off" value="<?php print($_SESSION['email']);?>">
                    </div>
                    <div class="item2">
                        <label>Perfil</label>
                        <select class="status" name="Perfil">
                            <option value="<?php print($_SESSION['email']);?>"><?php print($_SESSION['perfil']);?></option>
                            
                        </select>
                    </div>
                    <div class="item2">
                        <label>Nova Senha</label>
                        <input class="campos2" type="password" name="nome" autocomplete="off" placeholder="">
                    </div>
                    <div class="item2">
                        <label>Confirma Senha</label>
                        <input class="campos2" type="password" name="nome" autocomplete="off" placeholder="">
                    </div>
                    <div class="item2">
                        <div class="submit">
                            <br>
                            <button class="salvar" type="submit">Salvar</button>
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
    dadosProfile()
</script>
