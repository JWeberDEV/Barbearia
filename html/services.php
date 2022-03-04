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
                    <div class="col-md-5">
                        <label>Serviços</label>
                        <input id="servico" class="campos" type="text" autocomplete="off" placeholder="Nome do serviço">
                    </div>
                    <div class="col-md-5">
                        <label>Preço</label>
                        <input id="preco" class="campos" type="text" autocomplete="off" placeholder="Preços">
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

</body>
</html>


<script>
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

    mascara();
    listarServicos();

</script>
