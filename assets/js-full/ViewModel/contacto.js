function Contacto() {
    var self = this;
    self.IDmensaje_contacto = ko.observable();
    self.nombre = ko.observable();
    self.correo = ko.observable();
    self.telefono = ko.observable();
    self.fecha = ko.observable();
    self.mensaje = ko.observable();
    self.estatus = ko.observable();
   
    self.listaContacto = ko.observableArray();
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

    self.obtenerContacto = function (pagina) {
        pagina = pagina || 0;
        var busqueda = "";
        if (self.busqueda != "") {
            var busqueda = self.busqueda;
        }
        var url = pathApi + "contacto/apiobtenercontacto/";   
        disableBottonForm("frmBuscador", "btnBuscar");
        self.listaContacto.removeAll();
        $.post(url, {pagina:pagina, busqueda:busqueda}, function (data) {
          if (data["estatus"]) {
            if (data["resultado"].length > 0) {
              var resultado = data["resultado"];
              /**
               * Contacto
               */
              $.each(resultado, function (key, item) {
                var estatus = (item.estatus == "A") ? "<a class='label label-success' href='#' title='"+activo+"'><i class='fa fa-check'></i></a>" : ((item.estatus == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : ((item.estatus == "I") ? "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>"));
                estatus = { icono: estatus, valor: item.estatus };
                var contacto = new Contacto();
                contacto.IDmensaje_contacto(item.IDmensaje_contacto);
                contacto.estatus(estatus);
                contacto.nombre(item.nombre);
                contacto.correo(item.correo);
                contacto.telefono(item.telefono);
                contacto.fecha(item.fecha);
                contacto.mensaje(item.mensaje);
                self.listaContacto.push(contacto);
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
      self.obtenerContacto(0);
    }

    self.estatusCambiado = function(objeto) {
      self.estatus({"valor":$("#estatus").val(), "imagen":""});
      self.estatus($("#estatus").val());
    }

    self.btnModificar = function(objeto) {
      self.limpiar();
      self.modificando(true);
      self.IDmensaje_contacto(objeto.IDmensaje_contacto());
      self.mensaje(objeto.mensaje());
      $('#modalContacto').modal('show');
    }

    self.eliminar = function(contacto) {
      bootbox.confirm(mensajeConfirmacionEliminar, function (result) {
        if (result) {
          var url = pathApi + "contacto/apieliminar";
          disableBottonForm();
          $.post(url, {IDmensaje_contacto:contacto.IDmensaje_contacto}, function (data) {
            if (data["estatus"]) {
                mostrarMensajeS(data["mensaje"]);
                if (self.listaContacto().length >= 10) {
                  self.obtenerContacto(0);
                } else {
                  self.listaContacto.remove(contacto);
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
      self.obtenerContacto(self.paginaActual());
    }

    self.paginaAnterior = function () {
        if (self.paginaActual() != 0) {
            self.paginaActual(self.paginaActual() - 1);
            self.obtenerContacto(self.paginaActual());
        }
        self.paginaFinal(false);
    }

    self.btnCancelar = function() {
      bootbox.confirm(mensajeConfirmacionModificar, function (result) {
        if (result) {
          $('#modalContacto').modal('hide');
          self.limpiar();
        }
      });
    }

    self.limpiar = function() {
      self.IDmensaje_contacto("");
      self.mensaje("");
      self.estatus("");
      $("#frmContacto").trigger("reset");
    }

    /**
     * Config
     */
    self.getPermisoBoton = function () {
        var url = pathApi + "objeto/obtenerlistapermisoboton";
        disableBottonForm();
        $.post(url, { pantalla: "contacto" }, function (data) {
            if (data["estatus"]) {
                var resultado = data["resultado"];
                $.each(resultado, function (key, item) {
                    // Add a list item for the product.
                    if (item.NombreFisico == "registrar") {
                        self.btnRegistrarV(true);
                    } else if (item.NombreFisico == "modificar") {
                        self.btnModificarV(true);
                    } else if (item.NombreFisico == "eliminar") {
                        self.btnEliminarV(true);
                    } else if (item.NombreFisico == "permiso") {
                        self.btnPermisoV(true);
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

var contacto = new Contacto();