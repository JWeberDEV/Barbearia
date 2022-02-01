<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>NOVO SERVIÇO</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../img/logo_barber.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/styles 2.css" rel="stylesheet" />
    <link rel="stylesheet" href="../libs/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../libs/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css">">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper" style="background-color: #5c50e0;">
            <div class="sidebar-heading border-bottom" style="background-color: #5c50e0;">Barbearia </div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3 flut" href="users.php">Usuários <i class="fa fa-user" aria-hidden="true"></i></a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 flut" href="Clients.php">Clientes <i class="fa fa-users" aria-hidden="true"></i></a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 flut" href="services.php">Serviços <i class="fa fa-scissors" aria-hidden="true"></i></a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 flut" href="schedules.php">Agenda <i class="fa fa-calendar" aria-hidden="true"></i></a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 flut" href="profile.php">Meu Perfil <i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 flut" href="../index.html">Nome do usuário logado <i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
        </div>
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn" style="background-color: #5c50e0;" id="sidebarToggle"><strong>Menu</strong></button>
                </div>
            </nav>
            <!-- Page content-->
            <div class="fundo">
                <img class="fundo" src="../img/Fundo.png" alt="Plano de fundo">
            </div>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/scripts.js"></script>
</body>
</html>
