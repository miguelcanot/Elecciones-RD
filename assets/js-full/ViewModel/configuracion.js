function Configuracion() {
    var self = this;
    self.IDconfiguracion = ko.observable();
    self.empresa = ko.observable();
    self.email = ko.observable();
    self.eslogan = ko.observable();
    self.fax = ko.observable();
    self.telefono = ko.observable();
    self.email_envio = ko.observable();
    self.clave = ko.observable();
    self.host = ko.observable();
    self.direccion = ko.observable();
    self.puerto = ko.observable();
    self.imagen = ko.observable(); 

    self.guardar = function() {
      var url = pathApi + "configuracion/apiactualizarconfiguracion";
      if ($("#frmConfiguracion").valid()) {
        disableBottonForm("frmConfiguracion", "btnGuardar");
        $.post(url, $("#frmConfiguracion").serialize(), function (data) {
          if (data["estatus"]) {
              mostrarMensajeS(data["mensaje"]);
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("frmConfiguracion", "btnGuardar");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmConfiguracion", "btnGuardar");
          mostrarMensajeE(d.responseText);
       });
      }
    }

    self.btnCancelar = function() {
      redirect("panel");
    }

    self.obtenerConfiguracion = function () {
      var url = pathApi + "configuracion/apiobtenerconfiguracion/";
      disableBottonForm("frmConfiguracion", "btnGuardar");
        $.getJSON(url)
        .done(function (data) {
            if (data["estatus"]) {
              var resultado = data["resultado"];
              self.empresa(resultado.empresa);
              self.eslogan(resultado.eslogan);
              self.fax(resultado.fax);
              self.email(resultado.email);
              self.telefono(resultado.telefono);
              self.email_envio(resultado.email_envio);
              self.clave(resultado.clave);
              self.host(resultado.host);
              self.direccion(resultado.direccion);
              self.puerto(resultado.puerto);             
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm("frmConfiguracion", "btnGuardar");
        }).fail(function (d) {
            enableBottonForm("frmConfiguracion", "btnGuardar");
            mostrarMensajeE(d.responseText);
        });
    }

    self.enviarCorreo = function() {
      var url = pathApi + "configuracion/apicorreoprueba";
      disableBottonForm("frmConfiguracion", "btnGuardar");
      $.post(url, function(data) {
        if (data["estatus"]) {
          mostrarMensajeS(data["mensaje"]);
        } else {
          mostrarMensajeE(data["mensaje"]);
        }
        enableBottonForm("frmConfiguracion", "btnGuardar");
      }, "json").fail(function (d) {
        enableBottonForm("frmConfiguracion", "btnGuardar");
         mostrarMensajeE(d.responseText);
      });
    }

}

var configuracion = new Configuracion();