function Rol() {
    var self = this;
    self.IDrol = ko.observable();
    self.nombre = ko.observable();
    self.descripcion = ko.observable();
    self.estatus = ko.observable();
   
    self.listaRol = ko.observableArray();
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

    self.listaObjeto = ko.observableArray();
    self.listaRolObjeto = ko.observableArray();

    self.obtenerRol = function (pagina) {
        pagina = pagina || 0;
        var busqueda = "";
        if (self.busqueda != "") {
            var busqueda = self.busqueda;
        }
        var url = pathApi + "rol/apiobtenerrol/";
        disableBottonForm("frmBuscador", "btnBuscar");
        self.listaRol.removeAll();
        $.post(url, {pagina:pagina, busqueda:busqueda}, function (data) {
          if (data["estatus"]) {
            if (data["resultado"].length > 0) {
              var resultado = data["resultado"];
              /**
               * Rol
               */
              $.each(resultado, function (key, item) {
                var estatus = (item.estatus == "A") ? "<a class='label label-success' href='#' title='"+activo+"'><i class='fa fa-check'></i></a>" : ((item.estatus == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : ((item.estatus == "I") ? "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>"));
                estatus = { icono: estatus, valor: item.estatus };
                var rol = new Rol();
                rol.IDrol(item.IDrol);
                rol.estatus(estatus);
                rol.nombre(item.nombre);
                rol.descripcion(item.descripcion);
                self.listaRol.push(rol);
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
      self.obtenerRol(0);
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
      $('#modalRol').modal('show');
      $('#nombre').focus();
    }

    self.registrar = function() {
      var url = pathApi + "rol/apiregistrar";
      if ($("#frmRol").valid()) {
        disableBottonForm("frmRol", "btnGuardar");
        $.post(url, $("#frmRol").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalRol').modal('hide');
            self.limpiar();
            mostrarMensajeS(data["mensaje"]);
            self.obtenerRol(0);
          } else {
              mostrarMensajeE(data["mensaje"], "divMensajeERol");
          }
          enableBottonForm("frmRol", "btnGuardar");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmRol", "btnGuardar");
          mostrarMensajeE(d.responseText, "divMensajeERol");
       });
      }
    }

    self.btnModificar = function(objeto) {
      self.limpiar();
      self.modificando(true);
      self.IDrol(objeto.IDrol());
      self.nombre(objeto.nombre());
      self.descripcion(objeto.descripcion());
      $('#modalRol').modal('show');
    }

    self.modificar = function() {
      var url = pathApi + "rol/apimodificar";
      if ($("#frmRol").valid()) {
        disableBottonForm("frmRol", "btnGuardar");
        $.post(url, $("#frmRol").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalRol').modal('hide');
            mostrarMensajeS(data["mensaje"]);
            self.limpiar();
            self.obtenerRol(0);
          } else {
            mostrarMensajeE(data["mensaje"], "divMensajeERol");
          }
          enableBottonForm("frmRol", "btnGuardar");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmRol", "btnGuardar");
          mostrarMensajeE(d.responseText);
       });
      }
    }

    self.eliminar = function(rol) {
      bootbox.confirm(mensajeConfirmacionEliminar, function (result) {
        if (result) {
          var url = pathApi + "rol/apieliminar";
          disableBottonForm();
          $.post(url, {IDrol:rol.IDrol}, function (data) {
            if (data["estatus"]) {
                mostrarMensajeS(data["mensaje"]);
                if (self.listaRol().length >= 10) {
                  self.obtenerRol(0);
                } else {
                  self.listaRol.remove(rol);
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
      self.obtenerRol(self.paginaActual());
    }

    self.paginaAnterior = function () {
        if (self.paginaActual() != 0) {
            self.paginaActual(self.paginaActual() - 1);
            self.obtenerRol(self.paginaActual());
        }
        self.paginaFinal(false);
    }

    self.btnCancelar = function() {
      bootbox.confirm(mensajeConfirmacionModificar, function (result) {
        if (result) {
          $('#modalRol').modal('hide');
          self.limpiar();
        }
      });
    }

    self.limpiar = function() {
      self.IDrol("");
      self.nombre("");
      self.descripcion("");
      self.estatus("");
      $("#frmRol").trigger("reset");
    }

    /**
     * Permiso
     */
    self.btnPermiso = function(objeto) {
      self.IDrol(objeto.IDrol());
      self.obtenerObjetoSinAsignar(objeto.IDrol());
    }

    self.obtenerObjetoSinAsignar = function (id) {
        var id = id || 0;
        var url = pathApi + "objeto/apiobtenerobjetosinasignar/";
        disableBottonForm();
        $.post(url, {ID:id}, function (data) {
          if (data["estatus"]) {
            var resultado = data["resultado"];
            self.listaObjeto(resultado);
            self.obtenerObjetoAsignado(id);
          } else {
              mostrarMensajeE(data["mensaje"]);
              enableBottonForm();
          }
        }, "json")
        .fail(function (d) {
            enableBottonForm();
            mostrarMensajeE(d.responseText);
        });
    }

    self.obtenerObjetoAsignado = function (id) {
        var id = id || 0;
        var url = pathApi + "objeto/apiobtenerobjetoasignado/";
        //disableBottonForm();
        $.post(url, {ID:id}, function (data) {
            if (data["estatus"]) {
              var resultado = data["resultado"];
              self.listaRolObjeto(resultado);
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm();
            $('#modalPermiso').modal('show');
            $('#filtro').focus();
        }, "json")
        .fail(function (d) {
            enableBottonForm();
            mostrarMensajeE(d.responseText);
        });
    }

    self.agregarObjeto = function (objeto) {
        var url = pathApi + "objeto/apiregistrarpermiso/";
        disableBottonForm("frmPermiso");
        $.post(url, {IDrol:self.IDrol(), IDobjeto:objeto.IDobjeto}, function (data) {
            if (data["estatus"]) {
                self.listaRolObjeto.push(objeto);
                self.listaObjeto.remove(objeto);
                mostrarMensajeS(data["mensaje"], "divMensajeSPermiso");
            } else {
                mostrarMensajeE(data["mensaje"], "divMensajeEPermiso");
            }
            enableBottonForm("frmPermiso");
        }, "json")
        .fail(function (d) {
            enableBottonForm();
            mostrarMensajeE(d.responseText, "divMensajeEPermiso");
        });
    }

    self.quitarObjeto = function (objeto) {
        var url = pathApi + "objeto/apieliminarpermiso/";
        disableBottonForm("frmPermiso");
        $.post(url, {IDrol:self.IDrol(), IDobjeto:objeto.IDobjeto}, function (data) {
            if (data["estatus"]) {
                self.listaObjeto.push(objeto);
                self.listaRolObjeto.remove(objeto);
                mostrarMensajeS(data["mensaje"], "divMensajeSPermiso");
            } else {
                mostrarMensajeE(data["mensaje"], "divMensajeEPermiso");
            }
            enableBottonForm("frmPermiso");
        }, "json")
        .fail(function (d) {
            enableBottonForm();
            mostrarMensajeE(d.responseText, "divMensajeEPermiso");
        });
    }


    /**
     * Config
     */
    self.getPermisoBoton = function () {
        var url = pathApi + "objeto/obtenerlistapermisoboton";
        disableBottonForm();
        $.post(url, { pantalla: "rol" }, function (data) {
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

var rol = new Rol();