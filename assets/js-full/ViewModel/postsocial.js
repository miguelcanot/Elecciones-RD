function PostSocial() {
    var self = this;
    self.IDPostSocial = ko.observable();
    self.descripcion = ko.observable();
    self.abreviatura = ko.observable();
    self.estatus = ko.observable();
   
    self.listaPostSocial = ko.observableArray();
    self.listaTipo = ko.observableArray([{"id":"H", "nombre":"Hashtag"}, {"id":"A", "nombre":"@"}, {"id":"O", "nombre":"Otro"}]);
    self.listaDetalle = ko.observableArray();
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

    self.obtenerPostSocial = function (pagina) {
        pagina = pagina || 0;
        var busqueda = "";
        if (self.busqueda != "") {
            var busqueda = self.busqueda;
        }
        var url = pathApi + "postsocial/apiobtenerpostsocial/";
        disableBottonForm("", "", "lPostSocial");
        self.listaPostSocial.removeAll();
        $.post(url, {pagina:pagina, busqueda:busqueda}, function (data) {
          if (data["estatus"]) {
            if (data["resultado"].length > 0) {
              var resultado = data["resultado"];
              /**
               * PostSocial
               */
              $.each(resultado, function (key, item) {
                var estatus = (item.Estatus == "A") ? "<a class='label label-success' href='#' title='"+activo+"'><i class='fa fa-check'></i></a>" : ((item.Estatus == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : ((item.Estatus == "I") ? "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>"));
                estatus = { icono: estatus, valor: item.Estatus };
                item.Estatus = estatus;
                self.listaPostSocial.push(item);
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
          enableBottonForm("", "", "lPostSocial");
        }, "json")
       .fail(function (d) {
          enableBottonForm("", "", "lPostSocial");
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
      self.obtenerPostSocial(0);
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
      $('#modalPostSocial').modal('show');
      $('#nombre').focus();
    }

    self.registrarConfig = function() {
      var url = pathApi + "postsocial/apiregistrarconfig";
      if ($("#frmConfig").valid()) {
        disableBottonForm("frmPostSocial", "btnGuardar", "lmPostSocial");
        $.post(url, $("#frmConfig").serialize(), function (data) {
          if (data["estatus"]) {
            self.limpiarConfig();
            mostrarMensajeS(data["mensaje"]);
            self.btnConfig();
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("frmConfig", "btnGuardar", "lmPostSocial");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmConfig", "btnGuardar", "lmPostSocial");
          mostrarMensajeE(d.responseText);
       });
      }
    }

    self.aprobar = function(objeto) {
      var url = pathApi + "postsocial/apiaprobar";
        disableBottonForm("", "", "lmPostSocial");
        $.post(url, {ID:objeto.IDPostSocial}, function (data) {
          if (data["estatus"]) {
            mostrarMensajeS(data["mensaje"]);
            self.obtenerPostSocial(self.paginaActual());
          } else {
            mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("", "", "lmPostSocial");
        }, "json")
       .fail(function (d) {
          enableBottonForm("", "", "lmPostSocial");
          mostrarMensajeE(d.responseText);
       });
    }

    self.modificar = function() {
      var url = pathApi + "postsocial/apimodificar";
      if ($("#frmPostSocial").valid()) {
        disableBottonForm("frmPostSocial", "btnGuardar", "lmPostSocial");
        $.post(url, $("#frmPostSocial").serialize(), function (data) {
          if (data["estatus"]) {
            $('#modalPostSocial').modal('hide');
            mostrarMensajeS(data["mensaje"]);
            self.limpiar();
            self.obtenerPostSocial(0);
          } else {
            mostrarMensajeE(data["mensaje"], "divMensajeEPostSocial");
          }
          enableBottonForm("frmPostSocial", "btnGuardar", "lmPostSocial");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmPostSocial", "btnGuardar", "lmPostSocial");
          mostrarMensajeE(d.responseText);
       });
      }
    }

    self.eliminar = function(postsocial) {
      bootbox.confirm(mensajeConfirmacionEliminar, function (result) {
        if (result) {
          var url = pathApi + "postsocial/apieliminar";
          disableBottonForm("", "", "lPostSocial");
          $.post(url, {ID:postSocial.IDPostSocial}, function (data) {
            if (data["estatus"]) {
                mostrarMensajeS(data["mensaje"]);
                if (self.listaPostSocial().length >= 10) {
                  self.obtenerPostSocial(0);
                } else {
                  self.listaPostSocial.remove(postsocial);
                }
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm("", "", "lPostSocial");
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
      self.obtenerPostSocial(self.paginaActual());
    }

    self.paginaAnterior = function () {
        if (self.paginaActual() != 0) {
            self.paginaActual(self.paginaActual() - 1);
            self.obtenerPostSocial(self.paginaActual());
        }
        self.paginaFinal(false);
    }

    self.btnCancelar = function() {
      bootbox.confirm(mensajeConfirmacionModificar, function (result) {
        if (result) {
          $('#modalPostSocial').modal('hide');
          self.limpiar();
        }
      });
    }

    self.limpiarConfig = function() {
      $("#Tipo").val("").trigger("change");
      $("#Descripcion").val("");
      $("#frmPostSocial").trigger("reset");
    }

    /**
     * Config
     */
    self.getPermisoBoton = function () {
        var url = pathApi + "objeto/obtenerlistapermisoboton";
        disableBottonForm();
        $.post(url, { pantalla: "postsocial" }, function (data) {
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
    
     self.verPost = function (objeto) {
       if (objeto.IDTipoCuenta == 2) {
         //$("#ifPost").attr("src", "https://twitter.com/Interior/status/507185938620219395");
         redirectE("https://twitter.com/Interior/status/"+objeto.Id);
       }
      //$( "#modalVerPost").modal('show');
    }
     
    self.verPostP = function (objeto) {
       if (objeto.IDTipoCuenta == 2) {
         //$("#ifPost").attr("src", "https://twitter.com/Interior/status/507185938620219395");
         redirectT("https://twitter.com/Interior/status/"+objeto.Id);
       }
      //$( "#modalVerPost").modal('show');
    }
     
    self.obtenerPublicacion = function () {
        var url = pathApi + "postsocial/apiobtenerpublicacion/";
        disableBottonForm("", "", "lPostSocial");
        self.listaPostSocial.removeAll();
        $.post(url, function (data) {
          if (data["estatus"]) {
             self.listaPostSocial(data["resultado"]);
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("", "", "lPostSocial");
        }, "json")
       .fail(function (d) {
          enableBottonForm("", "", "lPostSocial");
          mostrarMensajeE(d.responseText);
       });
    }
    
     self.btnConfig = function () {
        var url = pathApi + "postsocial/apiobtenerconfig/";
        disableBottonForm("", "", "lPostSocial");
        self.listaDetalle.removeAll();
        $.post(url, function (data) {
          if (data["estatus"]) {
            $.each(data["resultado"], function (key, item) {
                var tipo = (item.Tipo == "H") ? "#" : ((item.Tipo == "A") ? "@" : "");
                tipo = { icono: tipo, valor: item.Tipo };
                item.Tipo = tipo;
                self.listaDetalle.push(item);
              });
            $("#modalConfig").modal("show");
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("", "", "lPostSocial");
        }, "json")
       .fail(function (d) {
          enableBottonForm("", "", "lPostSocial");
          mostrarMensajeE(d.responseText);
       });
    }
     
    self.eliminarConfig = function(objeto) {
      bootbox.confirm(mensajeConfirmacionEliminar, function (result) {
        if (result) {
          var url = pathApi + "postsocial/apieliminarconfig";
          disableBottonForm("", "", "lPostSocial");
          $.post(url, {ID:objeto.IDPostSocialConfig}, function (data) {
            if (data["estatus"]) {
                mostrarMensajeS(data["mensaje"]);
                self.listaDetalle.remove(objeto);
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm("", "", "lPostSocial");
          }, "json")
         .fail(function (d) {
            enableBottonForm();
            mostrarMensajeE(d.responseText);
          });
        }
      });
    }
    
}

var postSocial = new PostSocial();