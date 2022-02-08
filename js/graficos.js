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
    series: [],
    
  };
  
  chart = new Highcharts.Chart(options);




  $.ajax({
    url: "../php/relatorios.php",
    type: "post",
    data: {relatorio: 'FATURAMENTO_MENSAL'},
    dataType: "json",
    success: function (relatorio) {
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
        text: 'Total'
    },
    credits: {
        enabled: false
    },
    xAxis: {
        categories: [],
        crosshair: true
    },
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
            data:[]
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

      category.forEach(categoryName => {

        const filterSerie = relatorio.find(serie => serie.faturamento_funcionario === categoryName);

        console.log(filterSerie)
        if(filterSerie.lenght > 0){
          let valor = 0;
          filterSerie.forEach(result => {
            valor += parseFloat(result.faturamento_funcionario);
          })
          totalMes.push(valor);
        }else{
          totalMes.push(null);
        }
      })



      console.log(totalMes);
      series.push({
        name:'total',
        type:'spline',
        data: totalMes
      });

      options.xAxis.categories = category;
      options.series = series;

      chart = new Highcharts.Chart(options);
      
    }
  });

}

