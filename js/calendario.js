(function(win,doc) {
  
  let calendarEl = doc.querySelector('.calendar');
  let calendar = new FullCalendar.Calendar(calendarEl, {
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
    eventClick: function(arg) {
      if (confirm('Are you sure you want to delete this event?')) {
        arg.event.remove()
      }
    },
    editable: true,
    dayMaxEvents: true,
    
  });
  calendar.render();

})(window,document)

function agendar() {

  var myModal = new bootstrap.Modal(document.getElementById('Novo'), {
      keyboard: false
  })
  myModal.show();
}

function professionals() {
    $.ajax({
      url:"http://localhost/barbearia/php/agendamentos.php",
      type: "post",
      data:{acao: 'PROFISSIONAIS'},
      dataType: "json",
      success:function name(retorno) {
        console.log(retorno)
        let option = "";
        retorno.forEach(element => {
          option += `<option value='${element.id}'> ${element.nome_usuario} </option>`;
        });

        $("#profissional").html(option);
      }
    })
}

// function name(params) {
//   // console.log(document.getElementsByClassName("teste1"))
//   //    document.getElementsByClassName("teste1")[2].innerHTML = `<button type="button" class="hmodal" data-bs-toggle="modal" data-bs-target="#menu">
//   //     Agendamento
//   // </button>`;

//   // el.innerHTML = `<button type="button" class="hmodal" data-bs-toggle="modal" data-bs-target="#menu">
//   //     Agendamento
//   // </button>`;
// }