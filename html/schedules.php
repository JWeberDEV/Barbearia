<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>AGENDA</title>
    <?php require_once "../includes/inportacoes _css.php"; ?>
    
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <?php require_once "../includes/menu.php"?>
        
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php require_once "../includes/navbar.php"?>

            <div class="container nome_status">
                <div class="row">
                    <div class="col-md-4 status" style="align-items: flex-start;">
                        <label for="status">Proffissional</label>
                        <select id="filtro-profissional">
                            
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Cliente</label>
                        <input class="campos" type="text" name="client" autocomplete="off" class="inputCustom">
                    </div>
                    <div class="col-md-4">
                        <br>
                        <button class="buscar" style="background-color: #5c50e0;"onclick=" atualizaCalendario()"><i class="fa fa-search" aria-hidden="true" ></i></button>
                    </div>
                </div>
            </div>

            <div style="padding-top: 2%;">
                <div class="tabela-sch table-responsive-md container">
                    <div class="calendar"></div>
                </div>
            </div>
        </div>
    </div>

<!--------------------------------------------------------->
<!----------------------- Modal --------------------------->
<!--------------------------------------------------------->

<div class="modal" id="menu">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" name="id_agenda">
            <div class="modal-header" style="background-color: #aea7f8;">
                <h4 class="modal-title">Opções Agendamento</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
    
            <div class="modal-body corpomodal" >
                <div>
                    <button type="button" class="btn-warning btnmodal" onclick="ShowInfoEvent()">Editar<i class="fa fa-pencil pull-right" aria-hidden="false"></i></button>
                </div>
                <div>
                    <button type="button" class="btn-danger btnmodal" data-bs-toggle="modal" data-bs-target="#cancelar" onclick="ExibeMotivo()">Cancelar<i class="fa fa-ban pull-right" aria-hidden="true"></i></button>
                </div>
                <div>
                    <button type="button" class="btn-success btnmodal" data-bs-toggle="modal" data-bs-target="#finalizar" onclick="contaAgendamentos()">Finalizar<i class="fa fa-check-circle pull-right" aria-hidden="true"></i></button>
                </div>
                <div>
                    <button type="button" class="btn-secondary btnmodal" data-bs-toggle="" data-bs-target="" onclick="deletaEvento()">Remover<i class="fa fa-times-circle-o pull-right" aria-hidden="true"></i></button>
                </div>
            </div>
    
        </div>
    </div>
</div>

<!--------------------------------------------------------->
<!--------------------- Finaliza -------------------------->
<!--------------------------------------------------------->

<div class="modal" id="finalizar">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #aea7f8;">
                <h4 class="modal-title">Finalizar agendamento</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
    
            <div class="modal-body corpomodal">
                <input type="hidden" name="qtd">
                <div class="quantidade-qtd">
                
                </div>
                <div>
                    <button type="button" class="btn-success btnmodal" data-bs-dismiss="modal" value="Cancel" onclick="finalizaAgendamento()">Finalizar</button>
                </div>
            </div>
    
            
        </div>
    </div>
</div>

<!--------------------------------------------------------->
<!---------------------- Cancelar ------------------------->
<!--------------------------------------------------------->

<div class="modal" id="cancelar">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #aea7f8;">
                <h4 class="modal-title">Finalizar agendamento</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
    
            <div class="modal-body">
                <div class="">
                    <textarea class="campotexto" id="story" name="story" rows="5" cols="33" required></textarea>
                </div>
                <div>
                    <button type="button" class="btn-success btnmodal " onclick="CancelaAgendamento()">Confirmar</button>
                </div>
            </div>
    
            
        </div>
    </div>
</div>

<!--------------------------------------------------------->
<!----------------------- Editar -------------------------->
<!--------------------------------------------------------->

<div class="modal" id="editar">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #aea7f8;">
                <h4 class="modal-title">Editar agendamento</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <form autocomplete="off">
                            <input id="idAgendamento" type="hidden">
                            <div class="col-md-12">
                                <label>Cliente:</label>
                                <select class="campos2" id="client">

                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Servico:</label>
                                <select class="campos2" id="edit-servico">

                                </select>
                            </div>
                            <div class="col-md-12" style="padding-top: 1%;">
                                <label>Valor</label>
                                <input class="campos2" type="text" id="editaValorvalor">
                            </div>
                            <div class="col-md-12">
                                <label>Atendente:</label>
                                <select id="profi" class="campos2" name="Perfil">
                            
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>Status:</label>
                                <select id="status" class="campos2" >
                            
                                </select>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6" style="padding-top: 1%;">
                                    <label>Data:</label>
                                    <input id="data-edit" class="campos2" type="date" autocomplete="off" placeholder=" __/__/____">
                                </div>
                                <div class="col-md-6" style="padding-top: 1%;">
                                    <label>Horario Inicial:</label>
                                    <input id="edit-ini" class="campos2" type="text" autocomplete="off" placeholder="00:00">
                                </div>
                                <div class="col-md-6" style="padding-top: 1%;">
                                    <label>Horario Final:</label>
                                    <input id="edit-fin" class="campos2" type="text" autocomplete="off" placeholder="00:00">
                                </div>
                            </div>
                            
                            <div style="padding-top: 3%;">
                                <button type="button" class="btn-success btnmodal " data-bs-dismiss="modal" onclick="editaAgendamento()">Finalizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    
            
        </div>
    </div>
</div>

<!--------------------------------------------------------->
<!------------------ Novo Agendamento --------------------->
<!--------------------------------------------------------->

<div class="modal" id="Novo">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #aea7f8;">
                <h4 class="modal-title">Novo Agendamento</h4>
                <button type="button" class="close" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
    
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <form class="form-event" autocomplete="off">
                            <div class="col-md-12">
                            <label>Cliente</label>
                                <select class="campos2" id="cliente">
                                    
                                </select>
                            </div>
                            <div class="col-md-12" style="padding-top: 1%;">
                                <label>Servicos</label>
                                    <select class="campos2" id="servico" onchange="valorServico(this)">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding-top: 1%;">
                                <label>Valor</label>
                                <input class="campos2" type="text" id="valor">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6" style="padding-top: 1%;">
                                    <label>Data</label>
                                    <input id="data-at" class="campos2" type="date" autocomplete="off" placeholder=" __/__/____">
                                </div>
                                <div class="col-md-6" style="padding-top: 1%;">
                                    <label>Hora Inicial</label>
                                    <input id="hora-ini" class="campos2" type="text" autocomplete="off" placeholder=" 00:00 ">
                                </div>
                                <div class="col-md-6" style="padding-top: 1%;">
                                    <label>Hora Final</label>
                                    <input id="hora-fin" class="campos2" type="text" autocomplete="off" placeholder=" 00:00 ">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Atendente</label>
                                <select id="profissional" class="campos2" name="Perfil">
                            
                                </select>
                            </div>
                            <div style="padding-top: 3%;">
                                <button type="button" class="btn-primary btnmodal " data-bs-dismiss="modal" onclick="newEvent()">Cadastrar</button>
                                <button type="button" class="btn-success btnmodal " data-bs-dismiss="modal">Finalizar</button>
                            </div>
                        </form>
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
        $('#edit-ini').mask('00:00',);

        };

    mascara();
    professionals();
    clients();
    services();
    status();
    initCalendar();


</script>