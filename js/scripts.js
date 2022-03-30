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
    var usuario = document.getElementById("usuario").value;
    var senha = document.getElementById("senha").value;

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
            // console.log(retorno);
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
    var nomecompleto = document.getElementById("fullname").value;
    var cpf = document.getElementById("cpf").value;
    var email = document.getElementById("email").value;
    var perfil = document.getElementById("profile").value;
    var login = document.getElementById("login").value;
    var password = document.getElementById("password").value;
    var status_user = document.getElementById("status").value;

    
    if (password == "" || status_user == "" ) {
        alert("Os Campos obrigatórios precisam ser preenchidos");
        return;
    }

    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data: {acao: 'NEW_USER',nome: nomecompleto, cpf, email, perfil, login, password, status: status_user },
        datatype: "text",
        success: function name(data) {
            if(data == 1){
                alert("Usuário criado com sucesso");
                window.location.href = "http://localhost/barbearia/html/users.php"
            }else{
                alert("Erro ao criar o usuario");
            }
        }
        
    });
}

function listarUsuarios(){
    var pesquisa = document.getElementById("pesquisa").value;
    var status = document.getElementById("status").value;


    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao: 'RELATORIO', conteudo: pesquisa, status },
        dataType: "text",
        success: function (data) {
            $("#tabela-usuario").html(data)
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
            
            exibeid = (data[0].cpf);
            return exibeid;
        }
        
    });
    
}

function editar() {
    var alteranome = document.getElementById("altname").value;
    var alteracpf = document.getElementById("altcpf").value;
    var alteranumero = document.getElementById("altnumberclient").value;
    var alteraemail = document.getElementById("altmailclient").value;
    var alteraprofile = document.getElementById("altprofile").value;
    var alterastatus = document.getElementById("altstatus").value;
    $.ajax({
        url: "http://localhost/barbearia/php/list.php",
        type: "post",
        data: {acao: 'IDUSUARIO',id: exibeid },
        dataType: "text",
        success: function (data) {
            $.ajax({
                url: "../php/metodos.php",
                type: "post",
                data:{acao: 'EDITAR', id: data, altnome: alteranome, altcpf: alteracpf, altnumero: alteranumero, altemail: alteraemail, altprofissao: alteraprofile, altstatus: alterastatus},
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
    });

}

function newclient() {
    event.preventDefault()
    var nome = document.getElementById("name").value;
    var cpf = document.getElementById("cpf").value;
    var email = document.getElementById("mailclient").value;
    var numero = document.getElementById("numberclient").value;
    var datanasc = document.getElementById("dateborn").value;
    var profissao = document.getElementById("profi").value;
    var cidade = document.getElementById("city").value;

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
                window.location.href = "http://localhost/barbearia/html/clients.php"
            }else{
                alert("Erro ao criar o usuario");
            }
        }
    })
}

function listarclientes() {
    var cliente = document.getElementById("nome").value;
    var cpf= document.getElementById("cpf").value;

    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data:{acao: 'RELATORIO CLIENTE', cliente, cpf },
        dataType: "text",
        success: function (data) {
            $("#tabela-clientes").html(data)
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
            $("#clientname").val(data[0].nome_cliente);
            $("#clientcpf").val(data[0].cpf);
            $("#clientnumber").val(data[0].telefone);
            $("#clientmail").val(data[0].email);
            $("#clientdateborn").val(data[0].data_nasc);
            $("#clientprofi").val(data[0].profissao);
            $("#clientcity").val(data[0].cidade);
            
            clientid = (data[0].cpf);
            return clientid;
        }
        
    });
}

function editarcliente() {
    var altnome = document.getElementById("clientname").value;
    var altcpf = document.getElementById("clientcpf").value;
    var altnumero = document.getElementById("clientnumber").value;
    var altemail = document.getElementById("clientmail").value;
    var altdata = document.getElementById("clientdateborn").value;
    var altprofissao = document.getElementById("clientprofi").value;
    var altcidade = document.getElementById("clientcity").value;
    $.ajax({
        url: "http://localhost/barbearia/php/list.php",
        type: "post",
        data: {acao:'IDCLIENTE' ,id: clientid },
        dataType: "text",
        success: function (data) {
            alert(data);
            $.ajax({
                url: "../php/metodos.php",
                type: "post",
                data:{acao: 'EDITA CLIENTE', id: data, altnome: altnome, altcpf: altcpf, altnumero: altnumero, altemail: altemail, altdata: altdata, altprofissao: altprofissao, altcidade: altcidade},
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
    });

}

function criaservico() {
    var nomeservico = document.getElementById("servico").value;
    var precoservico = document.getElementById("preco").value;

    $.ajax({
        url: "../php/metodos.php",
        type: "post",
        data: {acao: 'CRIA SERVICO', servico: nomeservico, preco: precoservico },
        dataType: "text",
        success: function (data) {
            if(data == 1){
                alert("Usuário criado com sucesso");
                window.location.href = "http://localhost/barbearia/html/services.php"
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
            $("#tabela-servicos").html(data)
            paginacao();
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
    var nome = document.getElementById("altname").value;
    var preco = document.getElementById("altpreco").value;
    
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

function paginacao() {
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
                console.log("ojashfouhasoidfja");
                $("input[name=cad_num_page]").val(page);
                
                listarServicos();
            }
        }).on('page', function (event, page) {
            console.info(page + ' (from event listening)');
        });
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
