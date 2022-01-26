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
      $('#menu').modal('show');
      SendInfoEdit(arg);
      
    },
    
  });
  calendar.render();

}

function edit() {
  $('#editar').modal('show')
  $('#menu').modal('hide')
}

// function openClose() {
//   $('#menu').modal('show');
//   setTimeout(function () {
//       $('#menu').modal('hide')
//   }, 2000);
// }

// function agendar() {

//   var myModal = new bootstrap.Modal(document.getElementById('Novo'), {
//       keyboard: false
//   })
//   myModal.show();
// }

async function atualizaCalendario() {
  // calendar.refetchResources();
  calendar.refetchEvents();
}

function professionals() {
    $.ajax({
      url:"http://localhost/barbearia/php/agendamentos.php",
      type: "post",
      data:{acao: 'PROFISSIONAIS'},
      dataType: "json",
      success:function(retorno) {
        console.log(retorno)
        let option = "";
        retorno.forEach(element => {
          option += `<option value='${element.id}'> ${element.nome} </option>`;
        });

        $("#filtro-profissional").html(option);
        $("#profissional").html(option);
        $("#profi").html(option);
      }
    })
}

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

function agendamentos(callback) {
  $.ajax({
    url:"http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data:{acao: 'AGENDAMENTOS'},
    dataType: "json",
    success: function(agendados) {
      let events = [];
      agendados.forEach(element => {
        events.push({
          title: element.nome_cliente, 
          start: element.data_atendimento + ' ' + element.hora_inicial,
          end: element.data_atendimento + ' ' + element.hora_final,
          id: element.id
          // end: `${element.data_atendimento} ${element.hora_final}`,
          
        })
        
      }); 
      return callback(events);
    }
  });
}

async function showEvent(arg = false) {
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
      console.log(retornoAgendamento);
      if (retornoAgendamento == 1) {
        alert ("O agendamento foi criado com sucesso");
        atualizaCalendario();
      }else{
        alert ("Erro ao criar agendamento");
      }
      
    }
  });
  
}


// função qu serve para enviar as informações para o modal vindas do calendario e do banco
function SendInfoEdit(arg) {
  let info = arg;

  let id = info.event.id
  // let nome = info.event.title;
  $.ajax({
    url: "http://localhost/barbearia/php/agendamentos.php",
    type: "post",
    data: {acao: 'BUSCA_AGENDAMENTO', id},
    dataType: "text",
    success:function(agendamento) {
      agendamento = JSON.parse(agendamento);

      $("#client").val(agendamento[0].id_cliente);
      $("#edit-servico").val(agendamento[0].id_servico);
      $("#profi").val(agendamento[0].id_atendente);

    }
  });

  let data = info ? moment(info.event.start).format('YYYY-MM-DD') : info;
  let hora_inicial = info ? moment(info.event.start).format('HH:mm') : ' ';
  let hora_final = info ? moment(info.event.end).format('HH:mm') : ' ';

  $("input[id=data-edit]").val(data);
  $("input[id=edit-ini]").val(hora_inicial);
  $("input[id=edit-fin]").val(hora_final);

  
}



