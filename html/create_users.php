<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>NOVO USUÁRIO</title>
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
                        <label>Nome Usuário</label>
                        <input id="fullname" class="campos2" type="text" autocomplete="off" placeholder=" Nome Completo">
                    </div>
                    <div class="item2">
                        <label>CPF Usuário</label>
                        <input id="cpf" class="campos2" type="text" autocomplete="off" placeholder="___.___.___-__">
                    </div>
                    <div class="item2">
                        <label>Email Usuário</label>
                        <input id="email" class="campos2" type="email" autocomplete="off" placeholder="email@exemplo.com">
                    </div>
                    <div class="item2">
                        <label>Perfil</label>
                        <br>
                        <select id="profile" class="" name="Perfil">
                            <option value="Analista de Sistemas">Analista de Sistemas</option>
                            <option value="ADM">ADM</option>
                            <option value="Profissional">Profissional</option>
                            <option value="TI">TI</option>
                        </select>
                    </div>
                    <div class="item2">
                        <label class="required">Usuário</label>
                        <input id="login" class="campos2" type="text" autocomplete="off" placeholder="Usuário Login" required>
                    </div>
                    <div class="item2">
                        <label class="required">Senha</label>
                        <input id="password" class="campos2" type="password" autocomplete="off" placeholder="*****" required>
                    </div>
                    <div class="item2">
                        <label for="status">Status</label>
                        <br>
                        <select id="status" class="" name="status">
                            <option value="Ativo">Ativo</option>
                        </select>
                    </div>
                    <div class="item2">
                        <div class="submit">
                            <br>
                            <button class="salvar" type="submit" onclick="newuser()" >Salvar</button>
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
    function mascara(){
        $('#cpf').mask('000.000.000-00', {reverse: true});
    };

    mascara()
</script>