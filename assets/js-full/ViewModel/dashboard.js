function Dashboard() {
    var self = this;
    self.denunciaPendiente = ko.observable(0);
    self.denunciaAprobado = ko.observable(0);
    self.publicacionAprobado = ko.observable(0);
    self.publicacionPendiente = ko.observable(0);
   
    self.listaColor = ko.observableArray();
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

    self.listaGrafico = ko.observableArray();

     self.estadistica = function() {
      var url = pathApi + "estadistica/apiobtenerestadistica";
      $.post(url, function (data) {
        if (data["estatus"]) {
          var denuncia = data["denuncia"]; 
          self.denunciaPendiente(denuncia.P);
          self.denunciaAprobado(denuncia.A);
          var publicacion = data["publicacion"]; 
          self.publicacionPendiente(publicacion.P);
          self.publicacionAprobado(publicacion.A);
        } else {
          mostrarMensajeE(data["mensaje"]);
        }
      }, "json")
     .fail(function (d) {
        enableBottonForm();
        mostrarMensajeE(d.responseText);
     });
    }

    self.obtenerGConsulta = function() {
      var url = pathApi + "equipo/apigconsulta";
    
      disableBottonForm("frmColor", "btnGuardar");
      $.post(url, function (data) {
        if (data["estatus"]) {
          var resultado = data["resultado"]; 

          var grafico = new GraficoLinea();
          grafico.id("divGConsulta");
          grafico.titulo("Consultas");
          var serie = { name: "---", data: new Array() };
          $.each(resultado, function (key, item) {
            var categoria = item.nombre;
            grafico.categoria.push(categoria);
            serie.data.push(parseInt(item.cantidad));
          });
          grafico.serie.push(serie);
          //Mostrar Resultados
          self.listaGrafico.push(grafico);
          grafico.graficar();
        } else {
          mostrarMensajeE(data["mensaje"]);
        }
        enableBottonForm();
      }, "json")
     .fail(function (d) {
        enableBottonForm("frmColor", "btnGuardar");
        mostrarMensajeE(d.responseText, "divMensajeEColor");
     });
    }


    self.obtenerGREquipo = function() {
      var url = pathApi + "equipo/apigrequipo";
    
      disableBottonForm("frmColor", "btnGuardar");
      $.post(url, function (data) {
        var resultado = data["resultado"]; 

        var grafico = new GraficoLinea();
        grafico.id("divGREquipo");
        grafico.titulo("Consultas");
        var serie = { name: "---", data: new Array() };
        $.each(resultado, function (key, item) {
          var categoria = item.nombre;
          grafico.categoria.push(categoria);
          serie.data.push(parseInt(item.cantidad));
        });
        grafico.serie.push(serie);
        //Mostrar Resultados
        self.listaGrafico.push(grafico);
        grafico.graficar();

        enableBottonForm();
      }, "json")
     .fail(function (d) {
        enableBottonForm("frmColor", "btnGuardar");
        mostrarMensajeE(d.responseText, "divMensajeEColor");
     });
    }



    function GraficoLinea() {
      var self = this;
      self.id = ko.observable();
      self.titulo = ko.observable();
      self.puntuacion = ko.observable(0);
      self.promedio = ko.observable(0);
      self.categoria = ko.observableArray();
      self.serie = ko.observableArray();
      self.graficar = function () {
          var a = new Highcharts.Chart({
              chart: {
                renderTo: self.id(),
                type: 'line'
            },
            title: {
                text: self.titulo()
            },
            xAxis: {
                categories: self.categoria()
            },
            yAxis: {
                title: {
                    text: 'Cantidad'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: self.serie() 
          });
      }
      console.log(self.serie())
      self.name = ko.observable();
      self.colorByPoint = ko.observable(true);
      self.data = ko.observableArray();
  }

}

var dashboard = new Dashboard();