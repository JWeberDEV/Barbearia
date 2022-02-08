<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HOME</title>
    <?php require_once "../includes/inportacoes _css.php"; ?>
    
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <?php require_once "../includes/menu.php"?>

        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php require_once "../includes/navbar.php"?>
            <div style="padding-top: 5%;"></div>
            <div class="container bem-vindo">
                <h1>Bem vindo <?php print($_SESSION['nome']);?></h1>
            </div>

            <div class="container" style="padding-top: 3%;">
                <div class="tabela">
                    <figure class="highcharts-figure">
                        <div id="agendamentos-por-cliente"></div>
                    </figure>
                </div>
            </div>

            <div class="container" style="padding-top: 3%;">
                <div class="tabela">
                    <figure class="highcharts-figure">
                        <div id="agendamentos-encerrados"></div>
                    </figure>
                </div>
            </div>

            <div class="container" style="padding-top: 3%;">
                <div class="tabela">
                    <figure class="highcharts-figure">
                        <div id="faturamentos"></div>
                    </figure>
                </div>
            </div>

            <div class="container" style="padding-top: 3%;">
                <div class="tabela">
                    <figure class="highcharts-figure">
                        <div id="faturamento-profi"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <?php require_once "../includes/inportacoes _scripts.php"; ?>
    
</body>
</html>

<script>
    
    frequenciaClientes(); 
    finalizadosAtendentes(); 
    faturmanetoMensal();
    faturmanetoProfissioanis();

</script>
