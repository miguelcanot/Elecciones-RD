function Caracteristica() {
    var self = this;
    self.IDcaracteristica = ko.observable();
    self.descripcion = ko.observable();
    self.estatus = ko.observable();
   
    self.listaCaracteristica = ko.observableArray();
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

    self.obtenerCaracteristica = function (pagina) {
        pagina = pagina || 0;
        var busqueda = "";
        if (self.busqueda != "") {
            var busqueda = self.busqueda;
        }
        var url = pathApi + "caracteristica/apiobtenercaracteristica/";
        disableBottonForm("", "", "lCaracteristica");
        self.listaCaracteristica.removeAll();
        $.post(url, {pagina:pagina, busqueda:busqueda}, function (data) {
          if (data["estatus"]) {
            if (data["resultado"].length > 0) {
              var resultado = data["resultado"];
              /**
               * Caracteristica
               */
              $.each(resultado, function (key, item) {
                var estatus = (item.estatus == "A") ? "<a class='label label-success' href='#' title='"+activo+"'><i class='fa fa-check'></i></a>" : ((item.estatus == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : ((item.estatus == "I") ? "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>"));
                estatus = { icono: estatus, valor: item.estatus };
                item.estatus = estatus;
                self.listaCaracteristica.push(item);
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
          enableBottonForm("", "", "lCaracteristica");
        }, "json")
       .fail(function (d) {
          enableBottonForm("", "", "lCaracteristica");
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
      self.obtenerCaracteristica(0);
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
      $('#modalCaracteristica').modal('show');
      $('#nombre').focus();
    }

    self.registrar = function() {
      var url = pathApi + "caracteristica/apiregistrar";
      if ($("#frmCaracteristica").valid()) {
        disableBottonForm("frmCaracteristica", "btnGuardar", "lmCaracteristica");
        $.post(url, $("#frmCaracteristica").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalCaracteristica').modal('hide');
            self.limpiar();
            mostrarMensajeS(data["mensaje"]);
            self.obtenerCaracteristica(0);
          } else {
              mostrarMensajeE(data["mensaje"], "divMensajeECaracteristica");
          }
          enableBottonForm("frmCaracteristica", "btnGuardar", "lmCaracteristica");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmCaracteristica", "btnGuardar", "lmCaracteristica");
          mostrarMensajeE(d.responseText, "divMensajeECaracteristica");
       });
      }
    }

    self.btnModificar = function(objeto) {
      self.limpiar();
      self.modificando(true);
      self.IDcaracteristica(objeto.IDcaracteristica);
      self.descripcion(objeto.descripcion);
      $('#modalCaracteristica').modal('show');
    }

    self.modificar = function() {
      var url = pathApi + "caracteristica/apimodificar";
      if ($("#frmCaracteristica").valid()) {
        disableBottonForm("frmCaracteristica", "btnGuardar", "lmCaracteristica");
        $.post(url, $("#frmCaracteristica").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalCaracteristica').modal('hide');
            mostrarMensajeS(data["mensaje"]);
            self.limpiar();
            self.obtenerCaracteristica(0);
          } else {
            mostrarMensajeE(data["mensaje"], "divMensajeECaracteristica");
          }
          enableBottonForm("frmCaracteristica", "btnGuardar", "lmCaracteristica");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmCaracteristica", "btnGuardar", "lmCaracteristica");
          mostrarMensajeE(d.responseText);
       });
      }
    }

    self.eliminar = function(caracteristica) {
      bootbox.confirm(mensajeConfirmacionEliminar, function (result) {
        if (result) {
          var url = pathApi + "caracteristica/apieliminar";
          disableBottonForm("", "", "lCaracteristica");
          $.post(url, {ID:caracteristica.IDcaracteristica}, function (data) {
            if (data["estatus"]) {
                mostrarMensajeS(data["mensaje"]);
                if (self.listaCaracteristica().length >= 10) {
                  self.obtenerCaracteristica(0);
                } else {
                  self.listaCaracteristica.remove(caracteristica);
                }
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm("", "", "lCaracteristica");
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
      self.obtenerCaracteristica(self.paginaActual());
    }

    self.paginaAnterior = function () {
        if (self.paginaActual() != 0) {
            self.paginaActual(self.paginaActual() - 1);
            self.obtenerCaracteristica(self.paginaActual());
        }
        self.paginaFinal(false);
    }

    self.btnCancelar = function() {
      bootbox.confirm(mensajeConfirmacionModificar, function (result) {
        if (result) {
          $('#modalCaracteristica').modal('hide');
          self.limpiar();
        }
      });
    }

    self.limpiar = function() {
      self.IDcaracteristica("");
      self.descripcion("");
      self.estatus("");
      $("#frmCaracteristica").trigger("reset");
    }

    /**
     * Config
     */
    self.getPermisoBoton = function () {
        var url = pathApi + "objeto/obtenerlistapermisoboton";
        disableBottonForm();
        $.post(url, { pantalla: "caracteristica" }, function (data) {
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
}

var caracteristica = new Caracteristica();