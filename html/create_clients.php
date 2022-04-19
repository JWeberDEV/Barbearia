<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>CRIA USUÁRIO</title>
    <?php require_once "../includes/inportacoes _css.php"; ?>

</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <?php require_once "../includes/menu.php"?>

        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php require_once "../includes/navbar.php"?>

            <div style="padding-top: 7%; padding-left: 5%;">
                    <form class="formulario container2 tabela">
                        <div class="item2">
                            <label class="required">Nome Cliente</label>
                            <input id="name" class="itens" type="text" autocomplete="off" placeholder=" Nome Completo" required>
                        </div>
                        <div class="item2">
                            <label class="required">CPF Cliente</label>
                            <input id="cpf" class="itens" type="text" autocomplete="off" placeholder="___.___.___-__" required>
                        </div>
                        <div class="item2">
                            <label class="required">Numero Cliente</label>
                            <input id="numberclient" class="itens" type="text" autocomplete="off" placeholder="(__) _____-____" required>
                        </div>
                        <div class="item2">
                            <label class="required">Email Usuário</label>
                            <input id="mailclient" class="itens" type="email" autocomplete="off" placeholder="email@exemplo.com" required>
                        </div>
                        <div class="item2">
                            <label>Data de Nascimento</label>
                            <input id="dateborn" class="itens" type="date" autocomplete="off" placeholder="__/__/___">
                        </div>
                        <div class="item2">
                            <label>Profissão</label>
                            <input id="profi" class="itens" type="text" autocomplete="off">
                        </div>
                        <div class="item2">
                            <label>Cidade</label>
                            <input id="city" class="itens" type="text" autocomplete="off" placeholder="Novo Hambrugo">
                        </div>
                        <div class="item2">
                            
                        </div>
                        <div class="btnfull">
                            <div class="submit">
                                <br>
                                <button class="salvar" type="submit" onclick="newclient()">Salvar</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <?php require_once "../includes/inportacoes _scripts.php"; ?>
    
    
</body>
</html>

<script>
    mascara();

    function mascara(){
        $('#cpf').mask('000.000.000-00', {reverse: true});
        $('#numberclient').mask('(00) 0000-00000');
        
    };

</script>