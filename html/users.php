<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>USUÁRIOS</title>
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
                    <a href="create_users.php">
                        <button type="button" class="salvar" style="background-color: #5c50e0;">Novo</button>
                    </a>
                </div>
            </div>

                <div class="container nome_status">
                    <div class="row">
                        <div class="col-md-5">
                            <label>Seu Nome</label>
                            <input id="pesquisa" class="campos" type="text" name="nome" autocomplete="off" placeholder="Nome do Usuário" required>
                        </div>
                        <div class="col-md-5 status">
                            <label for="status">Status</label>
                            <select name="cars" id="status">
                                <option value="Todos">Todos</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 1.5%;">
                            <button class="buscar" style="background-color: #5c50e0;" onclick="listarUsuarios() "><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            <div  style="padding-top: 3%;">
                <div class="tabela table-responsive-md container">
                    <table class="table table-striped">
                        <thead style="background-color: #aea7f8;">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody id="tabela-usuario">
                        
                        </tbody>
                        
                    </table>
                </div>
            </div>
            
            <!--------------------------------------------------------->
            <!------------------------ modal -------------------------->
            <!--------------------------------------------------------->

            <div class="modal" id="editar">
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
                                    <input id="altcpf" class="itens" type="text" name="nome" autocomplete="off" placeholder="___.___.___-__">
                                </div>
                                <div class="item3">
                                    <label>Numero Usuário</label>
                                    <input id="altnumberclient" class="itens" type="text" name="nome" autocomplete="off" placeholder="(__) _____-____">
                                </div>
                                <div class="item3">
                                    <label>Email Usuário</label>
                                    <input id="altmailclient" class="itens" type="text" name="nome" autocomplete="off" placeholder="email@exemplo.com">
                                </div>
                                <div class="item3">
                                    <label>Data de Nascimento:</label>
                                    <input id="altdateborn" class="itens" type="date" name="nome" autocomplete="off" >
                                </div>
                                <div class="item3">
                                    <label>Perfil</label>
                                    <br>
                                    <select id="altprofile" name="Perfil">
                                        <option value="Analista de Sistemas">Analista de Sistemas</option>
                                        <option value="ADM">ADM</option>
                                        <option value="Profissional">Profissional</option>
                                        <option value="Programador">Programador</option>
                                        <option value="TI">TI</option>
                                    </select>
                                </div>
                                <div class="item3">
                                    <label for="status">Status</label>
                                    <br>
                                    <select id="altstatus">
                                        <option value="Ativo">Ativo</option>
                                        <option value="Inativo">Inativo</option>
                                    </select>
                                </div>
                            </form>
                                <div style="padding-top: 1%;">
                                    <button class="btn-success btnmodal" type="button" onclick="editar()" >Salvar</button>
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
        $('#altcpf').mask('000.000.000-00', {reverse: true});
        $('#altnumberclient').mask('(00) 00000-0000');
    };

    mascara();
    listarUsuarios();
    
</script>