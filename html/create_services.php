<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>NOVO SERVIÇO</title>
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
                        <label class="required">Serviço</label>
                        <input id="servico" class="itens" type="text" name="nome" autocomplete="off" placeholder=" Nome do Serviço" required>
                    </div>
                    <div class="item2">
                        <label class="required">Preço</label>
                        <input id="preco" class="itens" type="text" name="nome" autocomplete="off" placeholder="R$ 00.00" required>
                    </div>
                    <div class="btnfull">
                        <div class="submit">
                            <br>
                            <button class="salvar" type="submit" onclick="criaservico()">Salvar</button>
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
    function mascara(){
        $('#preco').mask('R$ 000-00', {reverse: true});
        
    };

    mascara()

</script>