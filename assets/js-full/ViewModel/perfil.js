function Perfil() {
    var self = this;
    self.IDperfil = ko.observable();
    self.usuario = ko.observable();
    self.correo = ko.observable();
    self.nombre = ko.observable();
    self.apellido = ko.observable();
    self.telefono = ko.observable();
    self.celular = ko.observable();
    self.url = ko.observable();
    self.fechaNacimiento = ko.observable();
    self.sexo = ko.observable();
    self.bio = ko.observable();
    self.direccion = ko.observable();
    self.estadoCivil = ko.observable();
    self.imagen = ko.observable();
    self.imagenActual = ko.observable();
    self.compartirNombre = ko.observable();
    self.compartirCorreo = ko.observable();
    self.compartirCelular = ko.observable();
    self.listaTipoCuenta = ko.observableArray();
    self.listaEspecialidad = ko.observableArray();
    self.listaEspecialidadUsuario = ko.observableArray();
    //self.perfilModificar = ko.observable(new Perfil());
    self.modificando = ko.observable(false);

    self.listaTipoDocumento = ko.observableArray([{"id":"D", "nombre":"Diploma"}, {"id":"C", "nombre":"Certificado"}, {"id":"CO", "nombre":"Constancia"}, {"id":"T", "nombre":"Título"}, {"id":"O", "nombre":"Otro"}]);
    self.listaEstudio = ko.observableArray();
    self.IDestudio = ko.observable(); 
    self.institucion = ko.observable(); 
    self.fecha_inicio = ko.observable(); 
    self.fecha_fin = ko.observable(); 
    self.grado = ko.observable(); 
    self.tipo_documento = ko.observable(); 
    self.compartir = ko.observable(); 

    self.listaExperiencia = ko.observableArray();
    self.IDexperiencia = ko.observable(); 
    self.lugar = ko.observable(); 
    self.fecha_inicio = ko.observable(); 
    self.fecha_fin = ko.observable(); 
    self.area = ko.observable(); 
    self.puesto = ko.observable(); 
    self.duracion = ko.observable(); 

    self.guardar = function() {
      var url = pathApi + "usuario/apiactualizarperfil";
      if ($("#frmPerfil").valid()) {
        disableBottonForm("frmPerfil", "btnGuardar", "lPerfil");
        $.post(url, $("#frmPerfil").serialize(), function (data) {
          if (data["estatus"]) {
              mostrarMensajeS(data["mensaje"]);
              var files = $("#imagen").get(0).files;
              var data = new FormData();
              if (files.length > 0) {
                  data.append("file", files[0]);
                  $.ajax({
                    type: "POST",
                    url: url,
                    contentType: false,
                    processData: false,
                    data: data, // Adjuntar los campos del formulario enviado.
                    success: function (data) {
                      data = JSON.parse(data);
                      if (data["estatus"]) {
                        mostrarMensajeS(data["mensaje"]);
                      } else {
                        mostrarMensajeE(data["mensaje"]);
                      }
                      enableBottonForm("frmPerfil", "btnGuardar", "lPerfil");
                    },
                    error: function (data, errorThrown) {
                        mostrarMensajeE(data.responseText);
                        enableBottonForm("frmPerfil", "btnGuardar", "lPerfil");
                    }
                });
              } else {
                enableBottonForm("frmPerfil", "btnGuardar", "lPerfil");
              }
          } else {
              mostrarMensajeE(data["mensaje"]);
              enableBottonForm("frmPerfil", "btnGuardar", "lPerfil");
          }
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmPerfil", "btnGuardar", "lPerfil");
          mostrarMensajeE(d.responseText);
       });
      }
    }

    self.btnCancelar = function() {
      redirect("panel");
    }

    self.obtenerContenido = function () {
      disableBottonForm("", "", "lPerfil");
      var url = pathApi + "usuario/apiobtenerconenidoperfil/";
        $.getJSON(url)
        .done(function (data) {
            if (data["estatus"]) {
              var resultado = data["resultado"];
              var usuarioDetalle = resultado["usuarioDetalle"];
              self.usuario(usuarioDetalle.usuario);
              self.nombre(usuarioDetalle.nombre);
              self.apellido(usuarioDetalle.apellido);
              self.correo(usuarioDetalle.correo);
              self.telefono(usuarioDetalle.telefono);
              self.celular(usuarioDetalle.celular);
              self.fechaNacimiento(usuarioDetalle.fecha_nacimiento);
              self.sexo(usuarioDetalle.sexo);
              self.imagenActual(usuarioDetalle.imagenAgente);
              self.direccion(usuarioDetalle.direccion);
              self.estadoCivil(usuarioDetalle.estado_civil);
              self.compartirCelular(usuarioDetalle.compartir_celular);
              self.compartirNombre(usuarioDetalle.compartir_nombre);
              self.compartirCorreo(usuarioDetalle.compartir_correo);
              self.bio(usuarioDetalle.bio);
              self.url(usuarioDetalle.url);
              if (usuarioDetalle.compartir_celular == "1") {
                $("#compartirCelularS").attr('checked', 'checked');
                $("#compartirCelularSLabel").addClass('active');  
              } else {
                $("#compartirCelularN").attr('checked', 'checked');
                $("#compartirCelularNLabel").addClass('active');  
              }
              if (usuarioDetalle.compartir_nombre == "1") {
                $("#compartirNombreS").attr('checked', 'checked');
                $("#compartirNombreSLabel").addClass('active');  
              } else {
                $("#compartirNombreN").attr('checked', 'checked');
                $("#compartirNombreNLabel").addClass('active');  
              }
              if (usuarioDetalle.compartir_correo == "1") {
                $("#compartirCorreoS").attr('checked', 'checked');
                $("#compartirCorreoSLabel").addClass('active');  
              } else {
                $("#compartirCorreoN").attr('checked', 'checked');
                $("#compartirCorreoNLabel").addClass('active');  
              }
              $('#sexo').val(self.sexo()).trigger("change");
              $('#estadoCivil').val(self.estadoCivil()).trigger("change");
              
              self.listaTipoCuenta(resultado["listaTipoCuenta"]);

              $.each(usuarioDetalle.listaSocial, function (key, item) {
                $("#tipoCuenta-"+item.IDtipo_cuenta).val(item.url);
              });
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm("", "", "lPerfil");
        }).fail(function (d) {
            enableBottonForm("", "", "lPerfil");
            mostrarMensajeE(d.responseText);
        });
    }

     self.cambiarCotrasena = function() {
      var url = pathApi + "usuario/apicambiarcontrasena";
      if ($("#frmCambiarContrasena").valid()) {
        disableBottonForm("frmCambiarContrasena", "btnGuardar");
        $.post(url, $("#frmCambiarContrasena").serialize(), function (data) {
          if (data["estatus"]) {
              mostrarMensajeS(data["mensaje"]);
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("frmCambiarContrasena", "btnGuardar");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmCambiarContrasena", "btnGuardar");
          mostrarMensajeE(d.responseText);
       });


      }
    }

    /**
     * Social
     */
    self.obtenerRedesSociales = function () {
      var url = pathApi + "tipocuenta/apiobtenertipocuentaactivo";
      self.listaTipoCuenta.removeAll();
        $.getJSON(url)
        .done(function (data) {
            if (data["estatus"]) {
              var resultado = data["resultado"];
                /**
                 * TipoCuenta
                 */
                $.each(resultado, function (key, item) {
                  self.listaTipoCuenta.push(item);
                });
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
        }).fail(function (d) {
            mostrarMensajeE(d.responseText);
        });
    }
}

var perfil = new Perfil();