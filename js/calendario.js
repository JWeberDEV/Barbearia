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
    
  });
  calendar.render();

})(window,document)