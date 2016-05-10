function Usuario() {
    var self = this;
    self.IDusuario = ko.observable();
    self.usuario = ko.observable();
    self.nombre = ko.observable();
    self.apellido = ko.observable();
    self.correo = ko.observable();
    self.comentario = ko.observable();
    self.agente = ko.observable();
    self.imagen = ko.observable();
    self.estatus = ko.observable();
    self.IDrol = ko.observable();
    self.rol = ko.observable();
    self.listaRol = ko.observableArray();
    self.listaUsuario = ko.observableArray();
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

    self.obtenerUsuario = function (pagina) {
        pagina = pagina || 0;
        var busqueda = "";
        if (self.busqueda != "") {
            var busqueda = self.busqueda;
        }
        var url = pathApi + "usuario/apiobtenerusuario/";
        disableBottonForm("frmBuscador", "btnBuscar");
        self.listaUsuario.removeAll();
        $.post(url, {pagina:pagina, busqueda:busqueda}, function (data) {
          if (data["estatus"]) {
            if (data["resultado"].length > 0) {
              var resultado = data["resultado"];
              /**
               * Usuario
               */
              $.each(resultado, function (key, item) {
                var estatus = (item.estatus == "A") ? "<a class='label label-success' href='#' title='"+activo+"'><i class='fa fa-check'></i></a>" : ((item.estatus == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : ((item.estatus == "I") ? "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>"));
                estatus = { icono: estatus, valor: item.estatus };
                var usuario = new Usuario();
                usuario.IDusuario(item.IDusuario);
                usuario.usuario(item.usuario);
                usuario.nombre(item.nombre);
                usuario.apellido(item.apellido);
                usuario.correo(item.correo);
                usuario.comentario(item.comentario);
                usuario.estatus(estatus);
                usuario.IDrol(item.IDrol);
                usuario.rol(item.rol);
                console.log(item.agente)
                var agente = (item.agente == "1") ? "<a class='label label-success' href='#' title='" + si + "'><i class='fa fa-check'></i></a>" : "<a class='label label-danger' href='#' title='" + no + "'><i class='fa fa-times'></i></a>";
                agente = { icono: agente, valor: item.agente };
                usuario.agente(agente);
                self.listaUsuario.push(usuario);
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
      self.obtenerUsuario(0);
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
      $('#modalUsuario').modal('show');
      $('#nombre').focus();
    }

    self.registrar = function() {
      var url = pathApi + "usuario/apiregistrar";
      if ($("#frmUsuario").valid()) {
        disableBottonForm("frmUsuario", "btnGuardar");
        $.post(url, $("#frmUsuario").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalUsuario').modal('hide');
            self.limpiar();
            mostrarMensajeS(data["mensaje"]);
            self.obtenerUsuario(0);
          } else {
              mostrarMensajeE(data["mensaje"], "divMensajeEUsuario");
          }
          enableBottonForm("frmUsuario", "btnGuardar");
        }, "json")
        .fail(function (d) {
          enableBottonForm("frmUsuario", "btnGuardar");
          mostrarMensajeE(d.responseText, "divMensajeEUsuario");
        });
      }
    }

    self.btnModificar = function(objeto) {
      self.limpiar();
      self.modificando(true);
      self.IDusuario(objeto.IDusuario());
      self.nombre(objeto.nombre());
      self.apellido(objeto.apellido());
      self.usuario(objeto.usuario());
      self.correo(objeto.correo());
      self.IDrol(objeto.IDrol());
      self.comentario(objeto.comentario());
      self.agente(objeto.agente());
      console.log(objeto.agente())
      if (objeto.agente().valor == "1") {
            $("#agenteS").attr('checked', 'checked');
            $("#agenteSLabel").addClass('active');
        } else {
            $("#agenteN").attr('checked', 'checked');
            $("#agenteNLabel").addClass('active');
        }
      $("#IDrol").val(objeto.IDrol());
      $('#modalUsuario').modal('show');
    }

    self.modificar = function() {
      var url = pathApi + "usuario/apimodificar";
      if ($("#frmUsuario").valid()) {
        disableBottonForm("frmUsuario", "btnGuardar");
         $.post(url, $("#frmUsuario").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalUsuario').modal('hide');
            mostrarMensajeS(data["mensaje"]);
            self.limpiar();
            self.obtenerUsuario(0);
          } else {
            mostrarMensajeE(data["mensaje"], "divMensajeEUsuario");
          }
          enableBottonForm("frmUsuario", "btnGuardar");
        }, "json")
        .fail(function (d) {
          enableBottonForm("frmUsuario", "btnGuardar");
          mostrarMensajeE(d.responseText, "divMensajeEUsuario");
        });
      }
    }

    self.eliminar = function(usuario) {
      bootbox.confirm(mensajeConfirmacionEliminar, function (result) {
        if (result) {
          var url = pathApi + "usuario/apieliminar";
          disableBottonForm();
          $.post(url, {IDusuario:usuario.IDusuario}, function (data) {
            if (data["estatus"]) {
                mostrarMensajeS(data["mensaje"]);
                if (self.listaUsuario().length >= 10) {
                  self.obtenerUsuario(0);
                } else {
                  self.listaUsuario.remove(usuario);
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
      self.obtenerUsuario(self.paginaActual());
    }

    self.paginaAnterior = function () {
        if (self.paginaActual() != 0) {
            self.paginaActual(self.paginaActual() - 1);
            self.obtenerUsuario(self.paginaActual());
        }
        self.paginaFinal(false);
    }

    self.btnCancelar = function() {
      bootbox.confirm(mensajeConfirmacionModificar, function (result) {
        if (result) {
          $('#modalUsuario').modal('hide');
          self.limpiar();
        }
      });
    }

    self.limpiar = function() {
      self.IDusuario("");
      self.usuario("");
      self.nombre("");
      self.apellido("");
      self.correo("");
      self.comentario("");
      self.imagen("");
      self.estatus("");
      self.agente("");
      $("#agenteS").removeAttr('checked');
      $("#agenteSLabel").removeClass('active');
      $("#agenteN").removeAttr('checked');
      $("#agenteNLabel").removeClass('active');
      $("#frmUsuario").trigger("reset");
    }

    self.obtenerRol = function () {
        var url = pathApi + "rol/apiobtenerrolactivo";
        disableBottonForm();
        $.post(url, function (data) {
            if (data["estatus"]) {
                var resultado = data["resultado"];
                self.listaRol(resultado);
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

var usuario = new Usuario();