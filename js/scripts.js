/*!
* Start Bootstrap - Simple Sidebar v6.0.3 (https://startbootstrap.com/template/simple-sidebar)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-simple-sidebar/blob/master/LICENSE)
*/
// 
// Scripts
// 
// --------------------------------------------------------------------------------------------

function login() {
    var usuario = $("#usuario").val();
    var senha = $("#senha").val();

    if(usuario.trim() == "" || senha.trim() == ""){
        alert("Preencha os campos");
        return;
    }

    $.ajax({
        url: "../barbearia/php/metodos.php",
        type: "post",
        data: {acao: 'LOGIN', usuario, senha},
        dataType: "text",
        success: function(data){
            if(data == 1){
                window.location.href = "../Barbearia/html/home.php";
            }else{
                alert("Os Dados Preenchidos, estão incorretos.");
            }
        }
    });
}

function changePassWord() {
  var newPD1 = $("#newPD1").val();
  var newPD2 = $("#newPD2").val();
  var id = $("#id").val();
  var resh = $("#resh").val();
  var mail = $("input[name=mail]").val();

  if (newPD1.trim() === newPD2.trim()) {
    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data: {acao: 'TROCA SENHA', id, resh,newPass: newPD1 },
        success:function(retorno) {
          if (retorno != 1) {
            alert("Não foi possível alterar a senha");
          }
          else{
            alert("Senha alterada com sucesso");
            if (mail = 1) {
                home();
            }
          }
        }
    });
  }else{
    alert("As senhas não são iguais");
  }
}

function home() {
    window.location.href = "../html/home.php";
}

function sendEmail(){
    var email = $("#email").val();
    if(email.trim() == ""){
    alert("Preencha o Campo");
    return;
    }else{
    $(".salvar").attr("disabled",true);
    $(".salvar").addClass("loader");
    $(".salvar").text("");
    $.ajax({
        url: '../php/mail.php',
        type: 'post',
        data: {acao: 'ENVIA EMEAIL', email },
        success:function (retorno) {
            $(".salvar").attr("disabled",false)
            $(".salvar").removeClass("loader");
            $(".salvar").text("Enviar");
        }
        
    });
    
      window.location.href = "../index.html";
    }

}

function logOut() {
    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data: {acao: 'FINALIZA'},
        success:function () {
            window.location.href = "../index.html";
        }
    });
}

function newuser() {
    event.preventDefault()
    var nomecompleto = $("#fullname").val();
    var cpf = $("#cpf").val();
    var email = $("#email").val();
    var perfil = $("#profile").val();
    var login = $("#login").val();
    var pass1 = $("#pass1").val();
    var pass2 = $("#pass2").val();
    var statusUser = $("#status").val();

    
    if (login == "" || pass1 == "" || pass2 == "" ||statusUser == "" ) {
        alert("Os Campos obrigatórios precisam ser preenchidos");
        return;
    }

    if (pass1 != pass2) {
        alert("As senhas não são iguais");
        return;
    }

    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data: {acao: 'NEW_USER',nome: nomecompleto, cpf, email, perfil, login, password: pass1, status: statusUser },
        datatype: "text",
        success: function name(data) {
            if(data == 1){
                alert("Usuário criado com sucesso");
                window.location.href = "../html/users.php"
            }else{
                alert("Erro ao criar o usuario");
            }
        }
        
    });
}

function listarUsuarios(){
    var pesquisa = $("#pesquisa").val();
    var status = $("#status").val();
    var limit = $('#limit').val();
    var page = $(".cad_num_page").val();

    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao: 'RELATORIO', conteudo: pesquisa, status, limit, page},
        dataType: "text",
        success: function (data) {
            $("#tabela-usuario").html(data)
            paginacao(listarUsuarios);
        }

        
    });

}

function deletar(id) {
    
    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao: 'DELETAR', id: id},
        dataType: "text",
        success: function (data) {
            
            $("#tabela-usuario").html(data)
            listarUsuarios();
        }

    });
}

var exibeid;

function exibir(id) {
    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao: 'EXIBIR', id: id},
        dataType: "text",
        success: function (data) {
            data = JSON.parse(data);
            $("#altname").val(data[0].nome);
            $("#altcpf").val(data[0].cpf);
            $("#altnumberclient").val(data[0].telefone);
            $("#altmailclient").val(data[0].email);
            $("#altprofile").val(data[0].perfil);
            $("#altstatus").val(data[0].user_status);
            
            exibeid = id;
            return exibeid;
        }
        
    });
    
}

function editar(id = exibeid) {
    var alteranome = $("#altname").val();
    var alteracpf = $("#altcpf").val();
    var alteranumero = $("#altnumberclient").val();
    var alteraemail = $("#altmailclient").val();
    var alteraprofile = $("#altprofile").val();
    var alterastatus = $("#altstatus").val();
    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao: 'EDITAR', id: id, altnome: alteranome, altcpf: alteracpf, altnumero: alteranumero, altemail: alteraemail, altprofissao: alteraprofile, altstatus: alterastatus},
        dataType: "text",
        success: function (data) {
            if(data == 1){
                alert("Usuário editado com sucesso");
                listarUsuarios();
            }else{
                alert("Erro ao criar o usuario");
            }
        }
    });
}


function newclient() {
    event.preventDefault()
    var nome = $("#name").val();
    var cpf = $("#cpf").val();
    var email = $("#mailclient").val();
    var numero = $("#numberclient").val();
    var datanasc = $("#dateborn").val();
    var profissao = $("#profi").val();
    var cidade = $("#city").val();

    if (nome == "" || cpf == "" || numero =="" || email == "") {
        alert("Os Campos obrigatórios precisam ser preenchidos");
        return;
    }

    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data: {acao: 'NEW_CLIENT', nome, cpf, email, numero, datanasc, profissao, cidade },
        datatype: "text",
        success: function name(data) {
            if(data == 1){
                alert("Usuário criado com sucesso");
                window.location.href = "../html/clients.php"
            }else{
                alert("Erro ao criar o usuario");
            }
        }
    })
}

function listarclientes() {
    var cliente = $("#nome").val();
    var cpf= $("#cpf").val();
    var limit = $('#limit').val();
    var page = $(".cad_num_page").val();

    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao: 'RELATORIO CLIENTE', cliente, cpf, limit, page},
        dataType: "text",
        success: function (data) {
            $("#tabela-clientes").html(data);

            paginacao(listarclientes);
        }

        
    });
}

function deletarcliente(id) {
    
    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao:'DELETA CLIENTE',id: id},
        dataType: "text",
        success: function (data) {
            
            $("#tabela-usuario").html(data)
            listarclientes();
        }

    });
}

var clientid;

function exibircliente(id) {
    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao: 'EXIBIR CLIENTE', id: id},
        dataType: "text",
        success: function (data) {
            data = JSON.parse(data);
            $("#id").val(data[0].id);
            $("#clientname").val(data[0].nome_cliente);
            $("#clientcpf").val(data[0].cpf);
            $("#clientnumber").val(data[0].telefone);
            $("#clientmail").val(data[0].email);
            $("#clientdateborn").val(data[0].data_nasc);
            $("#clientprofi").val(data[0].profissao);
            $("#clientcity").val(data[0].cidade);
            
            clientid = (id);
            return clientid;
        }
        
    });
}

function editarcliente(id = clientid) {
    var altnome = $("#clientname").val();
    var altcpf = $("#clientcpf").val();
    var altnumero = $("#clientnumber").val();
    var altemail = $("#clientmail").val();
    var altdata = $("#clientdateborn").val();
    var altprofissao = $("#clientprofi").val();
    var altcidade = $("#clientcity").val();
    var teste = id;
    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao: 'EDITA CLIENTE', id: id, altnome: altnome, altcpf: altcpf, altnumero: altnumero, altemail: altemail, altdata: altdata, altprofissao: altprofissao, altcidade: altcidade},
        dataType: "text",
        success: function (data) {
            if(data == 1){
                alert("Usuário editado com sucesso");
                listarclientes();
            }else{
                alert("Erro ao criar o usuario");
            }
        }
    });
}

function criaservico() {
    var nomeservico = $("#servico").val();
    var precoservico = $("#preco").val();

    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data: {acao: 'CRIA SERVICO', servico: nomeservico, preco: precoservico },
        dataType: "text",
        success: function (data) {
            if(data == 1){
                alert("Usuário criado com sucesso");
                window.location.href = "../barbearia/html/services.php";
            }else{
                alert("Erro ao criar o usuario");
            }
        }
    })
}

function listarServicos(){
    var pesquisa = $("#servico").val();
    var preco = $("#preco").val();
    var limit = $('#limit').val();
    var page = $(".cad_num_page").val();
    
    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao: 'RELATORIO SERVICO', conteudo: pesquisa, preco, limit, page},
        dataType: "text",
        success: function (data) {
            $("#tabela-servicos").html(data);

            paginacao(listarServicos);
        }

        
    });

}

function deletaservico(id) {

    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data: {acao: 'DELETA SERVICO', id},
        dataType: "text",
        success: function (data) {
            $("#tabela-servicos").html(data)
            listarServicos();
        }
    })
}

var servicoid;

function exibirservico(id) {
    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao: 'EXIBIR SERVICO', id: id},
        dataType: "text",
        success: function (data) {
            data = JSON.parse(data);
            $("#altname").val(data[0].nome);
            $("#altpreco").val(data[0].valor);
            
            servicoid = (data[0].id);
            return servicoid;
            
        }
        
    });
}

function editarservico(id = servicoid) {
    var nome = $("#altname").val();
    var preco = $("#altpreco").val();
    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data: {acao: 'EDITAR SERVICO', nome, preco, id},
        dataType: "text",
        success: function (retorno) {
            if(retorno == 1){
                alert("Serviço alterado com sucesso");
                listarServicos();
            }else{
                alert("Erro ao criar o usuario");
            }
        }
    });
}

function paginacao(cad_nome_funcao) {
    var cad_page_atual = $("input[name=cad_num_page]").val();
    var cad_qtde_rows_page = ($("select[name=cad_qtde_rows_page]")[0]) ? $("select[name=cad_qtde_rows_page]").val() : "10";
    var cad_qtde_rows_geral = $("#returned_rows_geral").val();

    var cad_total_page = Math.ceil(cad_qtde_rows_geral / cad_qtde_rows_page);

    $('#pagination-demo').twbsPagination('destroy');

    if(!cad_total_page) return;

    $(function () {
        window.pagObj = $('#pagination-demo').twbsPagination({
            startPage: parseInt(cad_page_atual),
            totalPages: cad_total_page,
            visiblePages: 3,
            next: '<i style="font-size:25px;" class="fa fa-angle-right" data-tt="tooltip" data-placement="top" title="Próximo"></i>',
            prev: '<i style="font-size:25px;" class="fa fa-angle-left" data-tt="tooltip" data-placement="top" title="Anterior"></i>',
            first: '<i style="font-size:25px;" class="fa fa-angle-double-left" data-tt="tooltip" data-placement="top" title="Primeiro"></i>',
            last: '<i style="font-size:25px;" class="fa fa-angle-double-right" data-tt="tooltip" data-placement="top" title="Último"></i>',
            initiateStartPageClick: false,
            onPageClick: function (event, page) {
                $("input[name=cad_num_page]").val(page);
                
                cad_nome_funcao();
            }
        })
        // .on('page', function (event, page) {
        //     console.info(page + ' (from event listening)');
        // });
    });

}

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
