function Objeto() {
    var self = this;
    self.IDobjeto = ko.observable();
    self.nombre_logico = ko.observable();
    self.nombre_fisico = ko.observable();
    self.tipo_objeto = ko.observable();
    self.IDobjeto_relacionado = ko.observable();
    self.objetoRelacionado = ko.observable();
    self.estatus = ko.observable();
   
    self.listaObjeto = ko.observableArray();
    self.listaObjetoRelacion = ko.observableArray();
    self.listaTipoObjeto = ko.observableArray([{"id":"P", "nombre":"Pantalla"}, {"id":"B", "nombre":"Boton"}]);
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

    self.obtenerObjeto = function (pagina) {
        pagina = pagina || 0;
        var busqueda = "";
        if (self.busqueda != "") {
            var busqueda = self.busqueda;
        }
        var url = pathApi + "objeto/apiobtenerobjeto/";
        disableBottonForm("frmBuscador", "btnBuscar");
        self.listaObjeto.removeAll();
        $.post(url, {pagina:pagina, busqueda:busqueda}, function (data) {
          if (data["estatus"]) {
            if (data["resultado"].length > 0) {
              var resultado = data["resultado"];
              /**
               * Objeto
               */
              $.each(resultado, function (key, item) {
                var estatus = (item.estatus == "A") ? "<a class='label label-success' href='#' title='"+activo+"'><i class='fa fa-check'></i></a>" : ((item.estatus == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : ((item.estatus == "I") ? "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>"));
                estatus = { icono: estatus, valor: item.estatus };
                var objeto = new Objeto();
                objeto.IDobjeto(item.IDobjeto);
                objeto.nombre_fisico(item.nombre_fisico);
                objeto.nombre_logico(item.nombre_logico);
                objeto.tipo_objeto(item.tipo_objeto);
                objeto.IDobjeto_relacionado(item.IDobjeto_relacionado);
                objeto.objetoRelacionado(item.objetoRelacionado);
                objeto.estatus(estatus);
                self.listaObjeto.push(objeto);
              });
              (data["resultado"].length == 10) ? self.paginaFinal(false) : self.paginaFinal(true);
            } else {
                self.paginaActual(self.paginaActual() - 1);
                self.paginaFinal(true);
                mostrarMensajeE(error100);
            }
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("frmBuscador", "btnBuscar");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmBuscador", "btnBuscar");
          mostrarMensajeE(d.responseText);
       });
    }

    self.buscarKey = function (data, event) {
      if (event.which == 13) {
          self.buscar();
      }
      return true;
    };

    self.buscar = function() {
      self.busqueda = $("#busqueda").val();
      self.obtenerObjeto(0);
    }

    self.guardar = function() {
      if (self.modificando()) {
        self.modificar();
      } else {
        self.registrar();
      }
    }

    self.estatusCambiado = function(objeto) {
      self.estatus({"valor":$("#estatus").val(), "icono":""});
      self.estatus($("#estatus").val());
    }


    self.btnRegistrar = function() {
      self.modificando(false);
      self.limpiar();
      $('#modalObjeto').modal('show');
    }

    self.registrar = function() {
      var url = pathApi + "objeto/apiregistrar";
      if ($("#frmObjeto").valid()) {
        disableBottonForm("frmObjeto", "btnGuardar");
        $.post(url, $("#frmObjeto").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalObjeto').modal('hide');
            self.limpiar();
            mostrarMensajeS(data["mensaje"]);
            self.obtenerObjeto(0);
          } else {
              mostrarMensajeE(data["mensaje"], "divMensajeEObjeto");
          }
          enableBottonForm("frmObjeto", "btnGuardar");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmObjeto", "btnGuardar");
         mostrarMensajeE(data.responseText, "divMensajeEObjeto");
       });
      }
    }

    self.btnModificar = function(objeto) {
      self.limpiar();
      self.modificando(true);
      self.IDobjeto(objeto.IDobjeto());
      self.nombre_fisico(objeto.nombre_fisico());
      self.nombre_logico(objeto.nombre_logico());
      self.tipo_objeto(objeto.tipo_objeto());
      self.IDobjeto_relacionado(objeto.IDobjeto_relacionado());
      $("#tipo_objeto").val(objeto.tipo_objeto());
      $("#IDobjeto_relacionado").val(objeto.IDobjeto_relacionado());
      $('#modalObjeto').modal('show');
    }

    self.modificar = function() {
      var url = pathApi + "objeto/apimodificar";
      if ($("#frmObjeto").valid()) {
        disableBottonForm("frmObjeto", "btnGuardar");
        $.post(url, $("#frmObjeto").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalObjeto').modal('hide');
            mostrarMensajeS(data["mensaje"]);
            self.limpiar();
            self.obtenerObjeto(0);
          } else {
            mostrarMensajeE(data["mensaje"], "divMensajeEObjeto");
          }
          enableBottonForm("frmObjeto", "btnGuardar");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmObjeto", "btnGuardar");
         mostrarMensajeE(data.responseText, "divMensajeEObjeto");
       });
      }
    }

    self.eliminar = function(objeto) {
      bootbox.confirm(mensajeConfirmacionEliminar, function (result) {
        if (result) {
          var url = pathApi + "objeto/apieliminar";
          disableBottonForm();
          $.post(url, {IDobjeto:objeto.IDobjeto}, function (data) {
            if (data["estatus"]) {
                mostrarMensajeS(data["mensaje"]);
                if (self.listaObjeto().length >= 10) {
                  self.obtenerObjeto(0);
                } else {
                  self.listaObjeto.remove(objeto);
                }
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm();
          }, "json")
         .fail(function (d) {
            enableBottonForm();
            mostrarMensajeE(d.responseText);
          });
        }
      });
    }

    self.paginaSiguiente = function () {
      self.paginaActual(self.paginaActual() + 1);
      self.obtenerObjeto(self.paginaActual());
    }

    self.paginaAnterior = function () {
        if (self.paginaActual() != 0) {
            self.paginaActual(self.paginaActual() - 1);
            self.obtenerObjeto(self.paginaActual());
        }
        self.paginaFinal(false);
    }

    self.btnCancelar = function() {
      bootbox.confirm(mensajeConfirmacionModificar, function (result) {
        if (result) {
          $('#modalObjeto').modal('hide');
          self.limpiar();
        }
      });
    }

    self.obtenerContenido = function () {
      self.obtenerObjeto();
      var url = pathApi + "objeto/apiobtenercontenido";
        $.getJSON(url)
        .done(function (data) {
            if (data["estatus"]) {
              var resultado = data["resultado"];
                /**
                 * Objeto
                 */
                self.listaObjetoRelacion.removeAll();
                $.each(resultado["listaObjeto"], function (key, item) {
                  self.listaObjetoRelacion.push(item);
                });
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
        }).fail(function (d) {
            mostrarMensajeE(d.responseText);
        });
    }

    self.agregarCuenta = function() {
      var idTipoCuenta = $("#tipoCuenta option:selected").val();
      if (idTipoCuenta != "") {
          var tipoCuenta = ko.utils.arrayFirst(self.listaTipoCuenta(), function (item) {
              return item.IDtipo_cuenta() == idTipoCuenta;
          });
          tipoCuenta.url("");
          self.listaTipoCuentaAgregada.push(tipoCuenta);
          self.listaTipoCuenta.remove(tipoCuenta);
      }  
    }

    self.eliminarCuenta = function (tipoCuenta) {
        self.listaTipoCuenta.push(tipoCuenta);
        self.listaTipoCuentaAgregada.remove(tipoCuenta);
    }

    self.limpiar = function() {
      self.IDobjeto("");
      self.nombre_fisico("");
      self.nombre_logico("");
      self.estatus("");
      $("#IDobjeto_relacionado").val("").trigger("change");
      $("#frmObjeto").trigger("reset");
    }

    self.getObjetoId = function (id) {
      var url = pathApi + "apiobjeto/getobjetoid/" + id;
      disableBottonForm();
      $.getJSON(url)
        .done(function (data) {
            if (data["estatus"]) {
                var resultado = data["resultado"];
                self.nombreLogico(resultado.NombreLogico);
                self.nombreFisico(resultado.NombreFisico);
                self.tipoObjeto(resultado.TipoObjeto);
                self.objetoRelacionado(resultado.IDObjetoRelacionado);
                self.id(resultado.IDObjeto);
                objeto.llenarListaObjetoRelacion();
                self.tipoObjetoSeleccionado([resultado.TipoObjeto]);
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm();
        }).fail(function (d) {
            enableBottonForm();
            mostrarMensajeE(d.responseText);
        });
    }

}

function TipoCuenta() {
  var self = this;
  self.IDtipo_cuenta = ko.observable();
  self.nombre = ko.observable();
  self.url = ko.observable();
}

var objeto = new Objeto();