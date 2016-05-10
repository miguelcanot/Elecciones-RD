function Aplicacion() {
    var self = this;
    self.IDapp = ko.observable();
    self.descripcion = ko.observable();
    self.nombre = ko.observable();
    self.fecha = ko.observable();
    self.callback_url = ko.observable();
    self.web = ko.observable();
    self.img = ko.observable();
    self.estatus = ko.observable();
   
    self.listaAplicacion = ko.observableArray();
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

    self.obtenerAplicacion = function (pagina) {
        pagina = pagina || 0;
        var busqueda = "";
        if (self.busqueda != "") {
            var busqueda = self.busqueda;
        }
        var url = pathApi + "aplicacion/apiobteneraplicacion/";
        disableBottonForm("", "", "lAplicacion");
        self.listaAplicacion.removeAll();
        $.post(url, {pagina:pagina, busqueda:busqueda}, function (data) {
          if (data["estatus"]) {
            if (data["resultado"].length > 0) {
              var resultado = data["resultado"];
              /**
               * Aplicacion
               */
              $.each(resultado, function (key, item) {
                var estatus = (item.estatus == "A") ? "<a class='label label-success' href='#' title='"+activo+"'><i class='fa fa-check'></i></a>" : ((item.estatus == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : ((item.estatus == "I") ? "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>"));
                estatus = { icono: estatus, valor: item.estatus };
                item.estatus = estatus;
                self.listaAplicacion.push(item);
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
          enableBottonForm("", "", "lAplicacion");
        }, "json")
       .fail(function (d) {
          enableBottonForm("", "", "lAplicacion");
          mostrarMensajeE(d.responseText);
       });
    }

    self.obtenerAplicacionActivas = function (pagina) {
        pagina = pagina || 0;
        var busqueda = "";
        if (self.busqueda != "") {
            var busqueda = self.busqueda;
        }
        var url = pathApi + "aplicacion/apiobteneraplicacionactiva/";
        disableBottonForm("", "", "lJuegos");
        self.listaAplicacion.removeAll();
        $.post(url, {pagina:pagina, busqueda:busqueda}, function (data) {
          if (data["estatus"]) {
            if (data["resultado"].length > 0) {
              var resultado = data["resultado"];
              /**
               * Aplicacion
               */
              $.each(resultado, function (key, item) {
                var estatus = (item.estatus == "A") ? "<a class='label label-success' href='#' title='"+activo+"'><i class='fa fa-check'></i></a>" : ((item.estatus == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : ((item.estatus == "I") ? "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>"));
                estatus = { icono: estatus, valor: item.estatus };
                item.estatus = estatus;
                self.listaAplicacion.push(item);
              });
              (data["resultado"].length == 10) ? self.paginaFinal(false) : self.paginaFinal(true);

              var $container = $('.masonry');
              $($container).imagesLoaded( function(){
                $($container).masonry({
                  itemSelector: '.post-grid', 
                  columnWidth: '.post-grid'
                });
              });
            } else {
                self.paginaActual(self.paginaActual() - 1);
                self.paginaFinal(true);
                mostrarMensajeE(error100);
            }
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("", "", "lJuegos");

        }, "json")
       .fail(function (d) {
          enableBottonForm("", "", "lJuegos");
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
      self.obtenerAplicacion(0);
    }

    self.guardar = function() {
      if (self.modificando()) {
        self.modificar();
      } else {
        self.registrar();
      }
    }

    self.estatusCambiado = function(objeto) {
      self.estatus({"valor":$("#estatus").val(), "imagen":""});
      self.estatus($("#estatus").val());
    }


    self.btnRegistrar = function() {
      self.modificando(false);
      self.limpiar();
      $('#modalAplicacion').modal('show');
      $('#nombre').focus();
    }

    self.registrar = function() {
      var url = pathApi + "aplicacion/apiregistrar";
      if ($("#frmAplicacion").valid()) {
        disableBottonForm("frmAplicacion", "btnGuardar", "lmAplicacion");
        $.post(url, $("#frmAplicacion").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalAplicacion').modal('hide');
            self.limpiar();
            mostrarMensajeS(data["mensaje"]);
            self.obtenerAplicacion(0);
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("frmAplicacion", "btnGuardar", "lmAplicacion");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmAplicacion", "btnGuardar", "lmAplicacion");
          mostrarMensajeE(d.responseText, "divMensajeEAplicacion");
       });
      }
    }

    self.btnModificar = function(objeto) {
      self.limpiar();
      self.modificando(true);
      self.IDapp(objeto.IDapp);
      self.descripcion(objeto.descripcion);
      self.nombre(objeto.nombre);
      self.callback_url(objeto.callback_url);
      self.web(objeto.web);
      $('#modalAplicacion').modal('show');
    }

    self.modificar = function() {
      var url = pathApi + "aplicacion/apimodificar";
      if ($("#frmAplicacion").valid()) {
        disableBottonForm("frmAplicacion", "btnGuardar", "lmAplicacion");
        var data = $("#frmAplicacion").serializefiles();
        $.ajax({
          type: "POST",
          url: url,
          contentType: false,
          processData: false,
          cache: false,
          data: data, // Adjuntar los campos del formulario enviado.
          success: function (data) {
            data = JSON.parse(data);
            if (data["estatus"]) {
              $('#modalAplicacion').modal('hide');
              mostrarMensajeS(data["mensaje"]);
              self.limpiar();
              self.obtenerAplicacion(0);
            } else {
              mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm("frmAplicacion", "btnGuardar", "lmAplicacion");
          },
          error: function (data, errorThrown) {
            enableBottonForm("frmAplicacion", "btnGuardar", "lmAplicacion");
            mostrarMensajeE(data.responseText);
          }
        });
      }
    }

    self.eliminar = function(aplicacion) {
      bootbox.confirm(mensajeConfirmacionEliminar, function (result) {
        if (result) {
          var url = pathApi + "aplicacion/apieliminar";
          disableBottonForm("", "", "lAplicacion");
          $.post(url, {ID:aplicacion.IDapp}, function (data) {
            if (data["estatus"]) {
                mostrarMensajeS(data["mensaje"]);
                if (self.listaAplicacion().length >= 10) {
                  self.obtenerAplicacion(0);
                } else {
                  self.listaAplicacion.remove(aplicacion);
                }
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm("", "", "lAplicacion");
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
      self.obtenerAplicacion(self.paginaActual());
    }

    self.paginaAnterior = function () {
        if (self.paginaActual() != 0) {
            self.paginaActual(self.paginaActual() - 1);
            self.obtenerAplicacion(self.paginaActual());
        }
        self.paginaFinal(false);
    }

    self.btnCancelar = function() {
      bootbox.confirm(mensajeConfirmacionModificar, function (result) {
        if (result) {
          $('#modalAplicacion').modal('hide');
          self.limpiar();
        }
      });
    }

    self.limpiar = function() {
      self.IDapp("");
      self.descripcion("");
      self.nombre("");
      self.web("");
      self.callback_url("");
      self.fecha("");
      self.estatus("");
      self.img("");
      $("#frmAplicacion").trigger("reset");
    }

    /**
     * Config
     */
    self.getPermisoBoton = function () {
        var url = pathApi + "objeto/obtenerlistapermisoboton";
        disableBottonForm();
        $.post(url, { pantalla: "aplicacion" }, function (data) {
            if (data["estatus"]) {
                var resultado = data["resultado"];
                $.each(resultado, function (key, item) {
                    // Add a list item for the product.
                    if (item.nombre_fisico == "registrar") {
                        self.btnRegistrarV(true);
                    } else if (item.nombre_fisico == "modificar") {
                        self.btnModificarV(true);
                    } else if (item.nombre_fisico == "eliminar") {
                        self.btnEliminarV(true);
                    }
                });
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

    self.verAplicacion = function(objeto) {
      redirect(pathWeb + objeto.callback_url);
    }

}

var aplicacion = new Aplicacion();