function Recinto() {
    var self = this;
    self.listaRecinto = ko.observableArray();
    self.listaMunicipio = ko.observableArray();
    self.paginaActual = ko.observable(0);
    self.paginaFinal = ko.observable(true);
    self.busqueda = "";
    self.buscador = ko.observable();
    self.modificando = ko.observable(false);

    self.obtenerMunicipio = function () {
        var url = pathApi + "municipio/apiobtenermunicipioactivo/";
        self.listaMunicipio.removeAll();
        $.post(url, function (data) {
          if (data["estatus"]) {
              self.listaMunicipio(data["resultado"]);
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
        }, "json")
       .fail(function (d) {
          mostrarMensajeE(d.responseText);
       });
    }
    
    self.obtenerRecinto = function (objeto, input) {
        var idMunicipio = input.currentTarget.value;
        if (idMunicipio != "") {
            var url = pathApi + "recinto/apirecintomunicipio/";
            disableBottonForm("", "", "lRecinto");
            self.listaRecinto.removeAll();
            $.post(url, {ID:idMunicipio}, function (data) {
              if (data["estatus"]) {
                  /**
                   * Recintos
                   */
                  var resultado = data["resultado"];
                  self.listaRecinto(resultado);
                  var imgUbicacion = "pin-map.png";
                  var locations = [];
                  $.each(resultado, function (key, item) {
                       // mapInit(item.Lat, item.Lng,"estate-map", imgDefault+imgUbicacion, false);
                      //console.log(item.Nombre + ": " +item.Lat + " ___ " +item.Lng)
                      var itemLocation = [item.Lat, item.Lng, imgDefault+imgUbicacion, "#", "", item.Nombre, 0];
                      locations.push(itemLocation);
                  });
                  
                  mapInitMultiple("estate-map",locations);
              } else {
                  mostrarMensajeE(data["mensaje"]);
              }
              enableBottonForm("", "", "lRecinto");
            }, "json")
           .fail(function (d) {
              enableBottonForm("", "", "lRecinto");
              mostrarMensajeE(d.responseText);
           });   
        }
    }
}

var recinto = new Recinto();