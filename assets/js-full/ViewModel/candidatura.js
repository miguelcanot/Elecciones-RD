function Candidatura() {
    var self = this;
    self.listaCandidatura = ko.observableArray();
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

     self.buscarCandidato = function () {
       var busqueda = $("#txtBusqueda").val();
        var url = pathApi + "candidatura/apiobtenercandidatura/";
        disableBottonForm("", "", "lCandidatura");
        self.listaCandidatura.removeAll();
        $('.tableDT').DataTable().clear().destroy();
        $.post(url, {pagina:0, busqueda:busqueda}, function (data) {
          if (data["estatus"]) {
            if (data["resultado"].length > 0) {
              /**
               * Candidatura
               */
              var resultado = data["resultado"];
              self.listaCandidatura(resultado);
               $(".tableDT").DataTable({
                  responsive: true, "bDestroy": true
              });
             
            } else {
               
                mostrarMensajeE(error102);
            }
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("", "", "lCandidatura");
        }, "json")
       .fail(function (d) {
          enableBottonForm("", "", "lCandidatura");
          mostrarMensajeE(d.responseText);
       });
    }
}

var candidatura = new Candidatura();