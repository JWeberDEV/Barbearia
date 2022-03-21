<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SERVIÇOS</title>
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
                    <a href="create_services.php">
                        <button type="button" class="salvar" style="background-color: #5c50e0;">Novo</button>
                    </a>
                </div>
            </div>

            <div class="container nome_status" >
                <div class="row">
                    <div class="col-md-4">
                        <label>Serviços</label>
                        <input id="servico" class="campos" type="text" autocomplete="off" placeholder="Nome do serviço">
                    </div>
                    <div class="col-md-4">
                        <label>Preço</label>
                        <input id="preco" class="campos" type="text" autocomplete="off" placeholder="Preços">
                    </div>
                    <div class="col-md-2">
                        <label>Itens</label>
                        <select class="campos" id="limit" onchange="listarServicos();">
                            <option value="T">Todos</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top: 2%;">
                        <button class="buscar" style="background-color: #5c50e0;" ><i class="fa fa-search" aria-hidden="true" onclick="listarServicos()"></i></button>
                    </div>
                </div >
            </div>

            <div style="padding-top: 1.5%;">
                <div class="tabela tabela table-responsive-md container">
                    <table class="table table-striped ">
                        <thead style="background-color: #aea7f8;">
                        <tr>
                            <th scope="col">Serviço</th>
                            <th scope="col">Preço</th>
                            <th scope="col" style="padding-left: 7%;">Ações</th>
                        </tr>
                        </thead>
                        <tbody id="tabela-servicos">
                        
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-12" style="margin: 0px; padding-top: 1rem; text-align: center;">
                <span class="returned_rows "></span>
            </div>

            <nav aria-label="Page navigation" class="d-flex justify-content-center pagination" >
                <input type="hidden" name="">
                <input type="hidden">
                <ul class="pagination-demo" id="pagination-demo">
                
                </ul>
            </nav>

            <!--------------------------------------------------------->
            <!------------------------ modal -------------------------->
            <!--------------------------------------------------------->

            <div class="modal" id="editar-servico">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <div class="modal-header" style="background-color: #aea7f8;">
                            <h4 class="modal-title">Editar Usuário</h4>
                            <button type="button" class="close" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                
                        <div class="modal-body">
                            <form class="formulario2">
                                <div class="item3">
                                    <label>Nome Usuário</label>
                                    <input id="altname" class="itens" type="text" name="nome" autocomplete="off" placeholder=" Nome Completo">
                                </div>
                                <div class="item3">
                                    <label>CPF Usuário</label>
                                    <input id="altpreco" class="itens" type="text" name="nome" autocomplete="off" placeholder="___.___.___-__">
                                </div>
                            </form>
                                <div style="padding-top: 1%;">
                                    <button class="btn-success btnmodal" type="button" onclick="editarservico()" >Salvar</button>
                                </div>
                                <div style="padding-top: 1%;">
                                    <button type="button" class="btn-primary btnmodal " data-bs-dismiss="modal">Finalizar</button>
                                </div>
                            </div>
                        </div>
                
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php require_once "../includes/inportacoes _scripts.php"; ?>
    <script src="../libs/pagination/jquery.twbsPagination.min.js" type="text/javascript"></script>
</body>
</html>


<script>
    mascara();
    listarServicos();

    $("#servico").keyup(function(event) {
      if (event.keyCode === 13) {
        $(".buscar").click();
      }
    });

    $("#preco").keyup(function(event) {
      if (event.keyCode === 13) {
        $(".buscar").click();
      }
    });

    $(".buscar").click(function() {
        listarServicos();
    });

   function mascara(){
        $('#preco').mask('R$ 000.00', {reverse: true});
        
    };

    function pagination(params) {
            //DEFINE AS VARIAVEIS
        var cad_page_atual = $("input[name=cad_num_page]").val();
        var cad_qtde_rows_page = ($("select[name=cad_qtde_rows_page]")[0]) ? $("select[name=cad_qtde_rows_page]").val() : "10";
        var cad_qtde_rows_geral = $("input[name=returned_rows_geral]").val();

        //CALCULA QUAL A QUANTIDADE DE PAGINAS
        var cad_total_page = Math.ceil(cad_qtde_rows_geral / cad_qtde_rows_page);

        //FINALIZA O PLUGIN
        $('#pagination-demo').twbsPagination('destroy');

        if(!cad_total_page) return;

        //INICIALIZA NOVAMENTE
        $('#pagination-demo').twbsPagination({

            //ATRIBUI A PAGINA ATUAL E TOTAL DE PAGINA
            startPage: parseInt(cad_page_atual),
            totalPages: cad_total_page,
            visiblePages: 3,       
            next: '<i style="font-size:25px;" class="fa fa-angle-right" data-tt="tooltip" data-placement="top" title="Próximo"></i>',
            prev: '<i style="font-size:25px;" class="fa fa-angle-left" data-tt="tooltip" data-placement="top" title="Anterior"></i>',
            first: '<i style="font-size:25px;" class="fa fa-angle-double-left" data-tt="tooltip" data-placement="top" title="Primeiro"></i>',
            last: ($('input[name=cad_perfil_sessao]').val() == "Administrador" || $('input[name=cad_perfil_sessao]').val() == "Colaborador") ? '' : '<i style="font-size:25px;" class="fa fa-angle-double-right" data-tt="tooltip" data-placement="top" title="Último"></i>',
            onPageClick: function (event, page) {            
                //NO CLIQUE MANDA O VALOR PARA O CAMPO
                $("input[name=cad_num_page]").val(page);

                //EXECUTA A FUNCAO QUE FOI PASSADA POR PARAMETRO                        
                cad_nome_funcao();
            }        
        });

    }

</script>
