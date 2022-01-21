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
      agendar()
      // var title = prompt('Titulo do evento:');
      // if (title) {
      //   calendar.addEvent({
      //     title: title,
      //     start: arg.start,
      //     end: arg.end,
      //     allDay: arg.allDay
      //   })
      // }
      // calendar.unselect()
    },
    dateClick:function (info) {
      alert('Clicked on: ' + info.dateStr);
      alert('Coordinates: ' + info.jsEvent.pagex);
      alert('Current view: ' + info.view.type);
    },
    editable: true,
    dayMaxEvents: true,
    // events: 'http://localhost/barbearia/libs/fullcalendar-5.10.1/examples/json/events.json',
    events: function(fetchInfo, successCallback, failureCallback) {   
      agendamentos(function(data) {
        successCallback(data);
    });
    },
        eventClick: function(arg) {
      alert('Event: ' + info.event.title);
      alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
      alert('View: ' + info.view.type);
    },
    
  });
  calendar.render();

}

function agendar() {

  var myModal = new bootstrap.Modal(document.getElementById('Novo'), {
      keyboard: false
  })
  myModal.show();
}

function professionals() {
    $.ajax({
      url:"http://localhost/barbearia/php/agendamentos.php?",
      type: "post",
      data:{acao: 'PROFISSIONAIS'},
      dataType: "json",
      success:function(retorno) {
        console.log(retorno)
        let option = "";
        retorno.forEach(element => {
          option += `<option value='${element.id}'> ${element.nome_usuario} </option>`;
        });

        $("#filtro-profissional").html(option);
        $("#profissional").html(option);
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
          // end: `${element.data_atendimento} ${element.hora_final}`,
          
        })
        
      }); 
      return callback(events);
    }
  });
}

function novoAgendamento(params) {
  
}

// $('button').click(function(){
//   $('#Novo').modal('show');
// });

// function name(params) {
//   // console.log(document.getElementsByClassName("teste1"))
//   //    document.getElementsByClassName("teste1")[2].innerHTML = `<button type="button" class="hmodal" data-bs-toggle="modal" data-bs-target="#menu">
//   //     Agendamento
//   // </button>`;

//   // el.innerHTML = `<button type="button" class="hmodal" data-bs-toggle="modal" data-bs-target="#menu">
//   //     Agendamento
//   // </button>`;
// }