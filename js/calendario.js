var  calendar = null;

function initCalendar(){   
  

  var calendarEl = document.querySelector('.calendar');
  calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    selectable: true,
    headerToolbar:{
      start: 'prev,next,today',
      center: 'title',
      end: 'dayGridMonth, timeGridWeek, timeGridDay',
    },
    locale: 'pt-br',
    buttonText:{
      today: 'Hoje',
      month: 'Mês',
      week: 'Semana',
      day: 'Dia'
    },
    navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
    select: function(arg) {
      showEvent(arg);
      
    },
    editable: true,
    dayMaxEvents: true,
    events: function(fetchInfo, successCallback, failureCallback) {   
      agendamentos(function(data) {
        successCallback(data);
    });
    },
    eventClick: function(arg) {
      // openClose();
      $("input[name=id_agenda]").val(arg.event.id);
      $('#menu').modal('show');
      // SendInfoEdit(arg);
      
    },
    eventResize: function(arg) {
      arrastavel(arg)
    },
    eventDrop: function(arg) {
      arrastavel(arg)
    },
    
  });
  calendar.render();

}

// function edit() {
//   $('#editar').modal('show')
//   $('#menu').modal('hide')
// }

// function openClose() {
//   $('#menu').modal('show');
//   setTimeout(function () {
//       $('#menu').modal('hide')
//   }, 2000);
// }


async function atualizaCalendario() {
  calendar.refetchEvents();
}

// função que lista os atendentes cadastrados no banco e exibe num select
function professionals() {
    $.ajax({
      url:"http://localhost/barbearia/php/agendamentos.php",
      type: "post",
      data:{acao: 'PROFISSIONAIS'},
      dataType: "json",
      success:function(retorno) {
        console.log(retorno)
        let option = "<option value=''> Todos </option>";
        retorno.forEach(element => {
          option += `<option value='${element.id}'> ${element.nome} </option>`;
        });

        $("#filtro-profissional").html(option);
        $("#profissional").html(option);
        $("#profi").html(option);
      }
    })
}

// função que lista os clientes cadastrados no banco e exibe num select

function clients() {
  
  $.ajax({
    url:"http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data:{acao: 'CLIENTES'},
    dataType: "json",
    success:function(retorno) {
      console.log(retorno)
      let option = "";
      retorno.forEach(element => {
        option += `<option value='${element.id}'> ${element.nome_cliente} </option>`;
      });
      
      $("#cliente").html(option);
      $("#client").html(option);
    }
  })
}

// função que lista os serviços cadastrados no banco e exibe num select
function services() {
  $.ajax({
    url:"http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data:{acao: 'SERVICOS'},
    dataType: "json",
    success:function(retorno) {
      console.log(retorno)
      let option = "";
      retorno.forEach(element => {
        option += `<option value='${element.id}'> ${element.nome} </option>`;
      });
      
      $("#servico").html(option);
      $("#edit-servico").html(option);
    }
  })
}

// função que lista os status cadastrados no banco e exibe num select
function status() {
  $.ajax({
    url:"http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data:{acao: 'STATUS'},
    dataType: "json",
    success:function(retorno) {
      console.log(retorno)
      let option = "";
      retorno.forEach(element => {
        option += `<option value='${element.id}'> ${element.nome} </option>`;
      });
      
      $("#status").html(option);
    }
  })
}

// função  que traz os agendamentos do banco e exibe na tela
function agendamentos(callback) {
  let idProfissional = $("select[id=filtro-profissional]").val();
  let searchClient = $("input[name=client]").val();

  $.ajax({
    url:"http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data:{acao: 'AGENDAMENTOS', idProfissional, cliente: searchClient},
    dataType: "json",
    success: function(agendados) {
      let events = [];
      agendados.forEach(element => {
        events.push({
          title: element.nome_cliente, 
          start: element.data_atendimento + ' ' + element.hora_inicial,
          end: element.data_atendimento + ' ' + element.hora_final,
          id: element.id,
          color: element.cor_status

          // end: `${element.data_atendimento} ${element.hora_final}`,
          
        })
        
      });
       
      return callback(events);
      
    }
  });
  
}



// função que envia as infrormações de data e hora para o modal que cria eventos
function showEvent(arg = false) {
  let dataAgenda = arg;
  
  // reset_form(".form-event");

  let data = arg ? moment(arg.start).format('YYYY-MM-DD') : dataAgenda;
  let hora_inicial = arg ? moment(arg.start).format('HH:mm') : '';
  let hora_final = arg ? moment(arg.end).format('HH:mm') : '';

  $("input[id=data-at]").val(data);
  $("input[id=hora-ini]").val(hora_inicial);
  $("input[id=hora-fin]").val(hora_final);

  $('#Novo').modal('show');
}

// função que cria um novo agendamento
function newEvent() {
  let data = document.getElementById("data-at").value;
  let inicial = document.getElementById("hora-ini").value;
  let final = document.getElementById("hora-fin").value;
  let cliente = document.getElementById("cliente").value;
  let profissional = document.getElementById("profissional").value;
  let servico = document.getElementById("servico").value;
  $.ajax({
    url:"http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data: {acao: 'NOVO_AGENDAMENTO', data, inicial, final, cliente, profissional, servico},
    dataType: "json",
    success: function (retornoAgendamento) {
      if (retornoAgendamento == 1) {
        alert ("O agendamento foi criado com sucesso");
        atualizaCalendario();
      }else{
        alert ("Erro ao criar agendamento");
      }
      
    }
  });
  
}

// função que serve para enviar as informações para o modal vindas do calendario e do banco
function ShowInfoEvent() {

  const id = $("input[name=id_agenda]").val();
      
  $('#editar').modal('show'); 
  $('#menu').modal('hide');

  $.ajax({
    url: "http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data: {acao: 'BUSCA_AGENDAMENTO', id},
    dataType: "text",
    success:function(agendamento) {
      agendamento = JSON.parse(agendamento);
      $("#idAgendamento").val(agendamento[0].id);
      $("#client").val(agendamento[0].id_cliente);
      $("#edit-servico").val(agendamento[0].id_servico);
      $("#profi").val(agendamento[0].id_atendente);
      $("#data-edit").val(agendamento[0].data_atendimento);
      $("#edit-ini").val(agendamento[0].hora_inicial);
      $("#edit-fin").val(agendamento[0].hora_final);
      $("#status").val(agendamento[0].id_status);
    }
  });


}

function editaAgendamento() {
  let id = document.getElementById("idAgendamento").value;
  let cliente = document.getElementById("client").value;
  let servico = document.getElementById("edit-servico").value;
  let data = document.getElementById("data-edit").value;
  let horaInicial = document.getElementById("edit-ini").value;
  let horaFinal = document.getElementById("edit-fin").value;
  let atendente = document.getElementById("profi").value; 
  let status = document.getElementById("status").value;
  
  $.ajax({
    url:"http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data: {acao: 'EDITA_AGENDAMENTO', id,cliente, servico, data, horaInicial, horaFinal, atendente,status},
    dataType: "text",
    success:function (retorno) {
      if (retorno != 1) {
        alert("Erro ao editar o agendamento");
        atualizaCalendario()
        
      }
      else{
        alert("Agendamento alterado com sucesso.")
        atualizaCalendario();
        
      }
    }
  });
  
}

function arrastavel(info) {

  var dialog = confirm("Este registro será modificado deseja continuar?");

  if (dialog) {
    let id = info.event.id;
    let cliente = info.event.title;
    let data = moment(info.event.start).format('YYYY/MM/DD');
    let horaInicial = moment(info.event.start).format('HH:mm');
    let horaFinal = moment(info.event.end).format('HH:mm');
    
    

    $.ajax({
      url:"http://localhost/barbearia/php/agendamentos.php",
      type: "post",
      data: {acao: 'REDIMENCIONA_AGENDAMENTO', id, data, horaInicial, horaFinal},
      dataType: "text",
      success:function (retorno) {
        if (retorno != 1) {
          alert("Erro ao editar o agendamento");
          atualizaCalendario()
          
        }
        else{
          alert("Agendamento alterado com sucesso.")
          atualizaCalendario();
          
        }
      }
    });
  }else{
    atualizaCalendario();
  }
  
}

function CancelaAgendamento() {
  const id = $("input[name=id_agenda]").val();
  let justificativa = document.getElementById("story").value;
  
  if(!justificativa){
    return alert('Prencha o campo');
    
  }

  $.ajax({
    url:"http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data: {acao: 'CANCELA_EVENTO', id, justificativa},
    dataType: "text",
    success:function (retorna) {
      if (retorna != 1) {
        alert("Erro ao editar o agendamento");
        atualizaCalendario()
      }
      else{
        alert("Agendamento alterado com sucesso.")
        atualizaCalendario()
        $('#cancelar').modal('hide');
      }
    }
  });

}

// função que traz do banco o motivo pelo qual foi cancelado o agendamento
function ExibeMotivo() {
  const id = $("input[name=id_agenda]").val();

  $.ajax({
    url:"http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data: {acao: 'EXIBE_JUSTIFICATIVA',id},
    dataType: "text",
    success:function (justify) {
      justify = JSON.parse(justify);
      $("#story").val(justify[0].justificativa);
      
    }
  });
}

// função que traz a quantidade de vezes que um cliente foi ao estabelecimento
function contaAgendamentos() {
  const id = $("input[name=id_agenda]").val();

  $.ajax({
    url:"http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data: {acao:'CONTA_AGENDAMENTOS', id},
    dataType: "text",
    success:function (qtd) {
      qtd = JSON.parse(qtd);
      $("input[name=qtd]").val(qtd[0].total_agendamentos);
      const quantidade = $("input[name=qtd]").val();
      
      if (quantidade >= 10) {
        $("div.quantidade-qtd").html(`<h1 style='text-align: center;'> Yuppp!!! </h1>
        <br>
        <p style='text-align: center;'> Este cliente ja tem mais de 10 agendamentos, que tal um deconto? </p>`);
      }else{
        $("div.quantidade-qtd").html(`<h1 style='text-align: center;'> Clique em finalizar, para encerrar o agendamento </h1>`);
        
      }
    }
  });
}

function finalizaAgendamento() {
  const id = $("input[name=id_agenda]").val();

  $.ajax({
    url:"http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data: {acao: 'FINALIZA_ATENDIMENTO',id},
    dataType: "text",
    success:function (retorno) {
      if (retorno != 1) {
        alert("Erro ao finalizar o agendamento");
        atualizaCalendario();
      }
      else{
        alert("Agendamento encerrado com sucesso.");
        atualizaCalendario();
        
      }
    }  
  });

}

function deletaEvento() {
  const id = $("input[name=id_agenda]").val();

  var dialog = confirm("Este registro será removido totalemnte do sistema. Tem certeza que deseja continuar?");
  
  if (dialog) {
    

    $.ajax({
      url:"http://localhost/barbearia/php/agendamentos.php",
      type: "post",
      data: {acao: 'DELETA_AGENDAMENTO',id},
      dataType: "text",
      success:function () {
        $('#menu').modal('hide');
        atualizaCalendario();
      }
    });
  }
  else {
    
    $('#menu').modal('hide');
  }
}

// function cancelEvent(){
//   const justify = prompt("Informe a justificativa");

//   if(!justify){
//     return alert('Prencha o campo');
//   }

//   console.log(justify);

//   const id = $("input[name=id_agenda]").val();


// }

// função que cria mascara para textos
// $(function(){
//   $('.date').mask("00/00/0000", { placeholder: "__/__/____" });
//   $('.hour').mask("00:00", { placeholder: "__:__" });
//   $('.cpf').mask('000.000.000-00', { clearIfNotMatch: true, reverse: true, placeholder: "000.000.000-00"});
//   $('.phone').mask(validate, { clearIfNotMatch: true, placeholder: "(00) 00000-0000"});

//   load();
// })