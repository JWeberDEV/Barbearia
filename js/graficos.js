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

function faturmanetoProfissioanis(){
    

  let chart, options = {
    chart: {
        type: 'column',
        renderTo: 'faturamento-profi',
    },
    title: {
        text: 'Faturamento'
    },
    subtitle: {
        text: 'Mensal'
    },
    credits: {
        enabled: false
    },
    xAxis: { 
      categories: [], 
      crosshair: true, 
    }, 
    tooltip: {
      shared: true
    },
    yAxis: [ 
      { 
        visible: false, 
      }, 
      { 
        title: { 
          text: 'Faturamento', 
        }, 
      }, 
    ],
    series: [],
    
  };
  
  chart = new Highcharts.Chart(options);




  $.ajax({
    url: "../php/relatorios.php",
    type: "post",
    data: {relatorio: 'FATURAMENTO_PROFI'},
    dataType: "json",
    success: function (relatorio) {
      let category = [];
      let series = [];

      // primeiro foreach, monta as series trazendo os nomes e preenchendo o name dentro de cada serie
      relatorio.forEach(element => {
        if (!category.includes(element.mensal)) { //se category estiver vazio incliu um novo mes 
          category.push(element.mensal); // envia o mes
          
        }
        //tenta en
        const findSerie = series.find(serie => serie.name === element.nome_usuario);

        if(!findSerie){
          series.push({
            name: element.nome_usuario,
            data:[],
            yAxis: 1
          });
        }
      });

      series.forEach((serieName, index) => {

        category.forEach(categoryName => {

          const filterSerie = relatorio.find(serie => serie.mensal === categoryName && serie.nome_usuario === serieName.name);

          if(filterSerie){
            series[index].data.push(parseFloat(filterSerie.faturamento_funcionario));
          }else{
            series[index].data.push(null);
          }
        })
      })


      let totalMes = [];
      let mediaMensal = [];

      category.forEach(categoryName => {

        const filterSerie = relatorio.filter(serie => serie.mensal === categoryName);
        if(filterSerie.length > 0){
          let valor = 0;
          filterSerie.forEach(result => {
            valor += parseFloat(result.faturamento_funcionario);
            
          })
          totalMes.push(valor);
          const media = valor / filterSerie.length;
          mediaMensal.push(media);
        }else{
          totalMes.push(null);
          mediaMensal.push(null);
        }
      })
      
      series.push({
        name:'total',
        type:'spline',
        data: totalMes,
        yAxis: 0
      });

      
      series.push({
        name:'media',
        type:'spline',
        data: mediaMensal,
        yAxis: 0,
        color: '#e24ff2'
      });

      options.xAxis.categories = category;
      options.series = series;

      chart = new Highcharts.Chart(options);
      
    }
  });

}

