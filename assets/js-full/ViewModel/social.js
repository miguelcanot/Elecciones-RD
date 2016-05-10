function Social() {
    var self = this;
    self.IDsocial = ko.observable();
    self.id = ko.observable();
    self.access_token = ko.observable();
    self.access_token_secret = ko.observable();
    self.IDtipo_cuenta = ko.observable();
    self.estatus = ko.observable();
   
    self.listaSocial = ko.observableArray();
    self.listaTipoCuenta = ko.observableArray();
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

    self.obtenerSocial = function (pagina) {
        pagina = pagina || 0;
        var busqueda = "";
        if (self.busqueda != "") {
            var busqueda = self.busqueda;
        }
        var url = pathApi + "social/apiobtenersocial/";
        disableBottonForm("", "", "lSocial");
        self.listaSocial.removeAll();
        $.post(url, {pagina:pagina, busqueda:busqueda}, function (data) {
          if (data["estatus"]) {
            if (data["resultado"].length > 0) {
              var resultado = data["resultado"];
              /**
               * Social
               */
              $.each(resultado, function (key, item) {
                var estatus = (item.estatus == "A") ? "<a class='label label-success' href='#' title='"+activo+"'><i class='fa fa-check'></i></a>" : ((item.estatus == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : ((item.estatus == "I") ? "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>"));
                estatus = { icono: estatus, valor: item.estatus };
                item.estatus = estatus;
                self.listaSocial.push(item);
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
          enableBottonForm("", "", "lSocial");
        }, "json")
       .fail(function (d) {
          enableBottonForm("", "", "lSocial");
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
      self.obtenerSocial(0);
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
      $('#modalSocial').modal('show');
      $('#nombre').focus();
    }

    self.registrar = function() {
      var url = pathApi + "social/apiregistrar";
      if ($("#frmSocial").valid()) {
        disableBottonForm("frmSocial", "btnGuardar", "lmSocial");
        $.post(url, $("#frmSocial").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalSocial').modal('hide');
            self.limpiar();
            mostrarMensajeS(data["mensaje"]);
            self.obtenerSocial(0);
          } else {
              mostrarMensajeE(data["mensaje"], "divMensajeESocial");
          }
          enableBottonForm("frmSocial", "btnGuardar", "lmSocial");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmSocial", "btnGuardar", "lmSocial");
          mostrarMensajeE(d.responseText, "divMensajeESocial");
       });
      }
    }

    self.btnModificar = function(objeto) {
      self.limpiar();
      self.modificando(true);
      self.IDsocial(objeto.IDsocial);
      self.id(objeto.id);
      self.access_token(objeto.access_token);
      self.access_token_secret(objeto.access_token_secret);
      self.IDtipo_cuenta(objeto.IDtipo_cuenta);
      $("#IDtipo_cuenta").val(objeto.IDtipo_cuenta);
      $('#modalSocial').modal('show');
    }

    self.modificar = function() {
      var url = pathApi + "social/apimodificar";
      if ($("#frmSocial").valid()) {
        disableBottonForm("frmSocial", "btnGuardar", "lmSocial");
        $.post(url, $("#frmSocial").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalSocial').modal('hide');
            mostrarMensajeS(data["mensaje"]);
            self.limpiar();
            self.obtenerSocial(0);
          } else {
            mostrarMensajeE(data["mensaje"], "divMensajeESocial");
          }
          enableBottonForm("frmSocial", "btnGuardar", "lmSocial");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmSocial", "btnGuardar", "lmSocial");
          mostrarMensajeE(d.responseText);
       });
      }
    }

    self.eliminar = function(social) {
      bootbox.confirm(mensajeConfirmacionEliminar, function (result) {
        if (result) {
          var url = pathApi + "social/apieliminar";
          disableBottonForm("", "", "lSocial");
          $.post(url, {ID:social.IDsocial}, function (data) {
            if (data["estatus"]) {
                mostrarMensajeS(data["mensaje"]);
                if (self.listaSocial().length >= 10) {
                  self.obtenerSocial(0);
                } else {
                  self.listaSocial.remove(social);
                }
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm("", "", "lSocial");
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
      self.obtenerSocial(self.paginaActual());
    }

    self.paginaAnterior = function () {
        if (self.paginaActual() != 0) {
            self.paginaActual(self.paginaActual() - 1);
            self.obtenerSocial(self.paginaActual());
        }
        self.paginaFinal(false);
    }

    self.btnCancelar = function() {
      bootbox.confirm(mensajeConfirmacionModificar, function (result) {
        if (result) {
          $('#modalSocial').modal('hide');
          self.limpiar();
        }
      });
    }

    self.limpiar = function() {
      self.IDsocial("");
      self.id("");
      self.access_token("");
      self.access_token_secret("");
      self.IDtipo_cuenta("");
      self.estatus("");
      $("#frmSocial").trigger("reset");
    }

    self.obtenerTipoCuenta = function () {
      var url = pathApi + "tipocuenta/apiobtenertipocuentaactivo";
      self.listaTipoCuenta.removeAll();
        $.getJSON(url)
        .done(function (data) {
            if (data["estatus"]) {
              var resultado = data["resultado"];
                /**
                 * TipoCuenta
                 */
                self.listaTipoCuenta(resultado);
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
        }).fail(function (d) {
            mostrarMensajeE(d.responseText);
        });
    }

    /**
     * Config
     */
    self.getPermisoBoton = function () {
        var url = pathApi + "objeto/obtenerlistapermisoboton";
        disableBottonForm();
        $.post(url, { pantalla: "social" }, function (data) {
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

var social = new Social();