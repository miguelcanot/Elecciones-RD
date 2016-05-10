function Denuncia() {
    var self = this;
    self.listaDenuncia = ko.observableArray();
    self.listaTipoDenuncia = ko.observableArray();
    self.listaDetalle = ko.observableArray();
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

    
    self.obtenerEstadisticaMunicipio = function () {
        var url = pathApi + "denuncia/apiobtenerestadisticamunicipio/";
        $.post(url, function (data) {
          if (data["estatus"]) {
            var resultado = data["resultado"];
            var config = {
                type: 'line',
                data: {
                    labels: resultado.etiqueta,
                    datasets: [{
                        label: "Denuncias",
                        data: resultado.valor,
                        fill: false,
                        borderDash: [5, 5],
                    }]
                },
                options: {
                    responsive: true,
                    title:{
                        display:false,
                        text:''
                    },
                    tooltips: {
                        mode: 'label',
                        callbacks: {
                        }
                    },
                    hover: {
                        mode: 'dataset'
                    }
                }
            };
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, config);
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
        }, "json")
       .fail(function (d) {
          mostrarMensajeE(d.responseText);
       });
    }    
    
    self.obtenerEstadisticaRecinto = function () {
        var url = pathApi + "denuncia/apiobtenerestadisticarecinto/";
        $.post(url, function (data) {
          if (data["estatus"]) {
            var resultado = data["resultado"];
            var config = {
                type: 'line',
                data: {
                    labels: resultado.etiqueta,
                    datasets: [{
                        label: "Denuncias",
                        data: resultado.valor,
                        fill: false,
                        borderDash: [5, 5],
                    }]
                },
                options: {
                    responsive: true,
                    title:{
                        display:false,
                        text:''
                    },
                    tooltips: {
                        mode: 'label',
                        callbacks: {
                        }
                    },
                    hover: {
                        mode: 'dataset'
                    }
                }
            };
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, config);
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
        }, "json")
       .fail(function (d) {
          mostrarMensajeE(d.responseText);
       });
    }    
    
    self.obtenerTipoDenuncia = function () {
        var url = pathApi + "denuncia/apiobtenertipodenunciaactivo/";
        self.listaTipoDenuncia.removeAll();
        $.post(url, function (data) {
          if (data["estatus"]) {
              self.listaTipoDenuncia(data["resultado"]);
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
        }, "json")
       .fail(function (d) {
          mostrarMensajeE(d.responseText);
       });
    }
    
    self.registrar = function() {
      var url = pathApi + "denuncia/apiregistrar";
      if ($("#frmDenuncia").valid()) {
        disableBottonForm("frmDenuncia", "btnGuardar", "lDenuncia");
        $.post(url, $("#frmDenuncia").serialize(), function (data) {
          if (data["estatus"]) {
            self.limpiar();
            mostrarMensajeS(data["mensaje"]);
            redirect(pathWeb + "denuncia#");
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("frmDenuncia", "btnGuardar", "lDenuncia");
        }, "json")
        .fail(function (d) {
          enableBottonForm("frmDenuncia", "btnGuardar", "lDenuncia");
          mostrarMensajeE(d.responseText);
        });
      }
    }
    
    self.limpiar = function() {    
      $("#IDRecinto").val("").trigger("change");
      $("#IDMunicipio").val("").trigger("change");
      recinto.listaRecinto.removeAll();
      $("#frmDenuncia").trigger("reset");
    }
    
     self.obtenerDenuncia = function (pagina) {
        pagina = pagina || 0;
        var busqueda = "";
        if (self.busqueda != "") {
            var busqueda = self.busqueda;
        }
        var url = pathApi + "denuncia/apiobtenerdenuncia/";
        disableBottonForm("frmBuscador", "btnBuscar", "lDenuncia");
        self.listaDenuncia.removeAll();
        $.post(url, {pagina:pagina, busqueda:busqueda}, function (data) {
          if (data["estatus"]) {
            if (data["resultado"].length > 0) {
              var resultado = data["resultado"];
              /**
               * Denuncia
               */
              $.each(resultado, function (key, item) {
                var estatus = (item.Estatus == "A") ? "<a class='label label-success' href='#' title='"+activo+"'><i class='fa fa-check'></i></a>" : ((item.Estatus == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : ((item.Estatus == "I") ? "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>"));
                estatus = { icono: estatus, valor: item.Estatus };
                item.Estatus = estatus;
                self.listaDenuncia.push(item);
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
          enableBottonForm("frmBuscador", "btnBuscar", "lDenuncia");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmBuscador", "btnBuscar", "lDenuncia");
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
      self.obtenerDenuncia(0);
    }

    self.paginaSiguiente = function () {
      self.paginaActual(self.paginaActual() + 1);
      self.obtenerColor(self.paginaActual());
    }

    self.paginaAnterior = function () {
        if (self.paginaActual() != 0) {
            self.paginaActual(self.paginaActual() - 1);
            self.obtenerColor(self.paginaActual());
        }
        self.paginaFinal(false);
    }

    /**
     * Config
     */
    self.getPermisoBoton = function () {
        var url = pathApi + "objeto/obtenerlistapermisoboton";
        disableBottonForm();
        $.post(url, { pantalla: "denuncia" }, function (data) {
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
    
    self.eliminar = function(objeto) {
      bootbox.confirm(mensajeConfirmacionEliminar, function (result) {
        if (result) {
          var url = pathApi + "denuncia/apieliminar";
          disableBottonForm("", "", "lDenuncia");
          $.post(url, {ID:objeto.IDDenuncia}, function (data) {
            if (data["estatus"]) {
                mostrarMensajeS(data["mensaje"]);
                if (self.listaDenuncia().length >= 10) {
                  self.obtenerDenuncia(self.paginaActual());
                } else {
                  self.listaDenuncia.remove(color);
                }
            } else {
                mostrarMensajeE(data["mensaje"]);
            }
            enableBottonForm("", "", "lDenuncia");
          }, "json")
         .fail(function (d) {
            enableBottonForm("", "", "lDenuncia");
            mostrarMensajeE(d.responseText);
          });
        }
      });
    }
    
    self.aprobar = function(objeto) {
      var url = pathApi + "denuncia/apiaprobar";
      disableBottonForm("", "", "lDenuncia");
      $.post(url, {ID:objeto.IDDenuncia}, function (data) {
        if (data["estatus"]) {
            mostrarMensajeS(data["mensaje"]);
            self.obtenerDenuncia(self.paginaActual());
        } else {
            mostrarMensajeE(data["mensaje"]);
        }
        enableBottonForm("", "", "lDenuncia");
      }, "json")
     .fail(function (d) {
        enableBottonForm("", "", "lDenuncia");
        mostrarMensajeE(d.responseText);
      });
    }
    
    self.detalle = function(objeto) {
        var url = pathApi + "denuncia/apiobtenerdetalle";
        disableBottonForm("", "", "lDenuncia");
        self.listaDetalle.removeAll();
      $.post(url, {ID:objeto.IDDenuncia}, function (data) {
        if (data["estatus"]) {
            self.listaDetalle(data["resultado"]);
            $("#modalDetalle").modal("show");
        } else {
            mostrarMensajeE(data["mensaje"]);
        }
        enableBottonForm("", "", "lDenuncia");
      }, "json")
     .fail(function (d) {
        enableBottonForm("", "", "lDenuncia");
        mostrarMensajeE(d.responseText);
      });
    }

    
}

var denuncia = new Denuncia();