/*!
* Start Bootstrap - Simple Sidebar v6.0.3 (https://startbootstrap.com/template/simple-sidebar)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-simple-sidebar/blob/master/LICENSE)
*/
// 
// Scripts
// 

document.addEventListener("keypress", function(e) {

    const btn = document.querySelector("#send");

    btn.click();

    });

function login() {
    var usuario = document.getElementById("usuario").value;
    var senha = document.getElementById("senha").value;

    if(usuario.trim() == "" || senha.trim() == ""){
        alert("Preencha os campos");
        return;
    }

    $.ajax({
        url: "php/metodos.php",
        type: "post",
        data: {acao: 'LOGIN', usuario, senha},
        dataType: "text",
        success: function(data){
            if(data == 1){
                window.location.href = "html/home.html";
            }else{
                alert("Os Dados Preenchidos, estão incorretos.");
            }
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


    $.ajax({
        url: "http://localhost/barbearia/php/metodos.php",
        type: "post",
        data: {acao: 'NEW_CLIENT', nome, cpf, email, numero, datanasc, profissao, cidade },
        datatype: "text",
        success: function name(data) {
            if(data == 1){
                alert("Sucesso");
            }else{
                alert("erro");
            }
        }
    })
}

function newuser() {
    event.preventDefault()
    var nome = document.getElementById("altname").value;
    var nome = document.getElementById("altname").value;
    var nome = document.getElementById("altname").value;
    var nome = document.getElementById("altname").value;
    var nome = document.getElementById("altname").value;
    var nome = document.getElementById("altname").value;
    var nome = document.getElementById("altname").value;


    $.ajax({
        url: "http://localhost/barbearia/php/metodos.php",
        type: "post",
        data: {acao: 'NEW_USER', nome, cpf, email, numero, datanasc, profissao, cidade },
        datatype: "text",
        success: function name(data) {
            if(data == 1){
                alert("Sucesso");
            }else{
                alert("erro");
            }
        }
    })
}

function listarUsuarios(){
    var pesquisa = document.getElementById("pesquisa").value;
    var status = document.getElementById("status").value;


    $.ajax({
        url: "http://localhost/barbearia/php/metodos.php",
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
        url: "http://localhost/barbearia/php/metodos.php",
        type: "post",
        data:{acao: 'DELETAR', id: id},
        dataType: "text",
        success: function (data) {
            $("#tabela-usuario").html(data)
            listarUsuarios();
        }

        
    });
}

function exibir(id) {

    $.ajax({
        url: "http://localhost/barbearia/php/metodos.php",
        type: "post",
        data:{acao: 'EXIBIR', id: id},
        dataType: "text",
        success: function (data) {
            data = JSON.parse(data);
            console.log(data)
            $("#altname").val(data[0].nome_usuario);
            $("#altcpf").val(data[0].cpf);
            $("#altnumberclient").val(data[0].telefone);
            $("#altmailclient").val(data[0].email);
        }

        
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
