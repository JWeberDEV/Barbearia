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

            <div class="btns">
                <div>
                    <a href="create_clients.php">
                        <button type="button" class="salvar" style="background-color: #5c50e0;">Novo</button>
                    </a>
                </div>
            </div>
            
            <div class="container nome_status">
                <div class="row">
                    <div class="col-md-4">
                        <label>Seu Nome</label>
                        <input id="nome" class="campos" type="text" autocomplete="off" placeholder="Nome do cliente">
                    </div>
                    <div class="col-md-4">
                        <label>CPF</label>
                        <input id="cpf" class="campos" type="text" autocomplete="off" placeholder="CPF do cliente">
                    </div>
                    <div class="col-md-2">
                        <label>Itens</label>
                        <select class="campos" id="limit" name="cad_qtde_rows_page" onchange="listarclientes();">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="T">Todos</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top: 2%;">
                        <button class="buscar" style="background-color: #5c50e0;" ><i class="fa fa-search" aria-hidden="true" onclick="listarclientes();"></i></button>
                    </div>
                </div >
            </div>
        <br>
            <div style="padding-top: 1.5%;">
                <div class="tabela tabela table-responsive-md container">
                    <table class="table table-striped ">
                        <thead style="background-color: #aea7f8;">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">total agendamentos</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody id="tabela-clientes">
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12" style="margin: 0px; padding-top: 1rem; text-align: center;">
                <span class="returned_rows"></span>
            </div>

            <nav aria-label="Page navigation" class="d-flex justify-content-center pagination" >
                <input type="hidden" name="returned_rows_geral" class="returned_rows_geral" id="returned_rows_geral">
                <input type="hidden" name="cad_num_page" class="cad_num_page" value="1">
                <ul class="pagination-demo" id="pagination-demo">
                
                </ul>
            </nav>
        </div>
    </div>

            <!--------------------------------------------------------->
            <!------------------------ modal -------------------------->
            <!--------------------------------------------------------->

    <div class="modal" id="editarcliente">
        <div class="modal-dialog">
            <div class="modal-content">
    
                <div class="modal-header" style="background-color: #aea7f8;">
                    <h4 class="modal-title">Editar Cliente</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
        
                <div class="modal-body">
                    <form class="formulario2">
                        <div class="item3">
                            <label>Nome Cliente</label>
                            <input id="clientname" class="itens" type="text" autocomplete="off" placeholder="Nome Completo">
                        </div>
                        <div class="item3">
                            <label>CPF Cliente</label>
                            <input id="clientcpf" class="itens" type="text" autocomplete="off" placeholder="___.___.___-__">
                        </div>
                        <div class="item3">
                            <label>Numero Cliente</label>
                            <input id="clientnumber" class="itens" type="text" autocomplete="off" placeholder="(__) _____-____">
                        </div>
                        <div class="item3">
                            <label>Email Usuário</label>
                            <input id="clientmail" class="itens" type="text" autocomplete="off" placeholder="E-mail">
                        </div>
                        <div class="item3">
                            <label>Data de Nascimento</label>
                            <input id="clientdateborn" class="itens" type="date" autocomplete="off" >
                        </div>
                        <div class="item3">
                            <label>Profissão</label>
                            <input id="clientprofi" class="itens" type="text" autocomplete="off" placeholder="TI">
                        </div>
                        <div class="item3">
                            <label>Cidade</label>
                            <input id="clientcity" class="itens" type="text" autocomplete="off" placeholder="Novo Hamburgo">
                        </div>
                    </form>
                        <div style="padding-top: 1%;">
                            <button class="btn-success btnmodal" type="button" onclick="editarcliente()" >Salvar</button>
                        </div>
                        <div style="padding-top: 1%;">
                            <button type="button" class="btn-primary btnmodal " data-bs-dismiss="modal">Finalizar</button>
                        </div>
                    </div>
                </div>
        
                
            </div>
        </div>
    </div>

</body>
</html>

<?php require_once "../includes/inportacoes _scripts.php"; ?>

<script>
    $("#nome").keyup(function(event) {
      if (event.keyCode === 13) {
        $(".buscar").click();
      }
    });

    $("#cpf").keyup(function(event) {
      if (event.keyCode === 13) {
        $(".buscar").click();
      }
    });

    $(".buscar").click(function() {
        listarclientes();
    });
    
    function mascara(){
        $('#cpf').mask('000.000.000-00', {reverse: true});
        $('#clientnumber').mask('(00) 00000-0000', {placeholder: "(00) 00000-0000"});
        
    };

    mascara();
    listarclientes();

    

</script>