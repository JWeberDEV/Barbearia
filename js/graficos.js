
function frequenciaClientes(){

  let chart, options = {
    chart: {
        type: 'column',
        renderTo: 'agendamentos-por-cliente',
    },
    title: {
        text: 'Frequência dos clientes'
    },
    subtitle: {
        text: 'Anual'
    },
    credits: {
        enabled: false
    },
    xAxis: {
        categories: [],
        crosshair: true
    },
    series: []
  };

  chart = new Highcharts.Chart(options);


  $.ajax({
    url: "../php/relatorios.php",
    type: "post",
    data: {relatorio: 'AGENDAMENTOS_POR_CLIENTE'},
    dataType: "json",
    success: function (relatorio) {
      let category = [];
      let series = [{
        name: 'agendamentos',
        data: []
      }];

      relatorio.forEach(element => {
        category.push(element.nome_cliente);
        series[0].data.push(parseInt(element.agendamentos));
      });

      options.xAxis.categories = category;
      options.series = series;

      chart = new Highcharts.Chart(options);
      
    }
  });

}

function finalizadosAtendentes(){

  let chart, options = {
    chart: {
        type: 'column',
        renderTo: 'agendamentos-encerrados',
    },
    title: {
        text: 'Agendamentos encerrados por Atendente'
        
    },
    subtitle: {
        text: 'Anual'
    },
    credits: {
        enabled: false
    },
    xAxis: {
        categories: [],
        crosshair: true
    },
    series: []
  };

  chart = new Highcharts.Chart(options);


  $.ajax({
    url: "../php/relatorios.php",
    type: "post",
    data: {relatorio: 'QUANTIDADE_AGENDAMENTOS_ATENDENTE'},
    dataType: "json",
    success: function (relatorio) {
      console.log(relatorio);
      let category = [];
      let series = [{
        name: 'Atendimentos Finalizados',
        data: [],
        color: '#8ff7c6'
      }];

      relatorio.forEach(element => {
        category.push(element.nome_usuario);
        series[0].data.push(parseInt(element.finalizado));
      });

      options.xAxis.categories = category;
      options.series = series;

      chart = new Highcharts.Chart(options);
      
    }
  });

}

function finalizadosAtendentes(){

  let chart, options = {
    chart: {
        type: 'column',
        renderTo: 'agendamentos-encerrados',
    },
    title: {
        text: 'Agendamentos encerrados por Atendente'
        
    },
    subtitle: {
        text: 'Anual'
    },
    credits: {
        enabled: false
    },
    xAxis: {
        categories: [],
        crosshair: true
    },
    series: []
  };

  chart = new Highcharts.Chart(options);


  $.ajax({
    url: "../php/relatorios.php",
    type: "post",
    data: {relatorio: 'QUANTIDADE_AGENDAMENTOS_ATENDENTE'},
    dataType: "json",
    success: function (relatorio) {
      
      let category = [];
      let series = [{
        name: 'Atendimentos Finalizados',
        data: [],
        color: '#8ff7c6'
      }];

      relatorio.forEach(element => {
        category.push(element.nome_usuario);
        series[0].data.push(parseInt(element.finalizado));
      });

      options.xAxis.categories = category;
      options.series = series;

      chart = new Highcharts.Chart(options);
      
    }
  });

}

function faturmanetoMensal(){

  let chart, options = {
    chart: {
        type: 'column',
        renderTo: 'faturamentos',
    },
    title: {
        text: 'Fatoramento Mensal'
        
    },
    subtitle: {
        text: ''
    },
    credits: {
        enabled: false
    },
    xAxis: {
        categories: [],
        crosshair: true
    },
    series: []
  };

  chart = new Highcharts.Chart(options);


  $.ajax({
    url: "../php/relatorios.php",
    type: "post",
    data: {relatorio: 'FATURAMENTO_MENSAL'},
    dataType: "json",
    success: function (relatorio) {
      console.log(relatorio);
      let category = [];
      let series = [{
        name: 'Mensal',
        data: [],
        color: '#f2969d'
      }];

      relatorio.forEach(element => {
        category.push(element.mes);
        series[0].data.push(parseInt(element.fatoramento_Mensal));
      });

      options.xAxis.categories = category;
      options.series = series;

      chart = new Highcharts.Chart(options);
      
    }
  });

}

