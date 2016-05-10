function App() {
    var self = this;
    self.id = ko.observable();
    self.resultadoImei = ko.observable();
    self.listaReporteImei = ko.observableArray();
    self.conResultado = ko.observable();
    self.usuario = ko.observable();
    self.imgPerfil = ko.observable();
    self.socialUrl = ko.observable();
    self.socialTipo = ko.observable();
    self.socialTitulo = ko.observable();
    self.socialDescripcion = ko.observable();
    self.socialImg = ko.observable();
    self.correo = ko.observable();
    self.url = ko.observable();
    self.usuarioLog = ko.observable(false);
    self.divRegistrateVisible = ko.observable(false);
    self.divRecuperarContrasenaVisible = ko.observable(false);
    self.listaMoneda = ko.observableArray();
    self.posScroll = ko.observable(0);
    self.contrasenaCambiada = ko.observable(false);
    self.bOrdenadoPor = ko.observable("PLH");
    self.modoVista = ko.observable("G");
    self.paginaActual = ko.observable(0);
    self.paginaActualTemp = ko.observable(0);
    self.vistaInicio = ko.observable(false);
    //busqueda

    self.nombreApellido = ko.observable();
    self.imgPerfil = ko.observable();
    self.empresa = ko.observable();
    self.logo = ko.observable();
    self.nombreWeb = ko.observable();
    self.rol = ko.observable();

    self.listaTestimonio = ko.observableArray();
    self.listaProvincia = ko.observableArray();
    //Web
    self.webCorreo = ko.observable();
    self.webTelefono = ko.observable();
    self.webDireccion = ko.observable();
    self.webHorario = ko.observable();

    self.menuActivo = ko.observable();
    self.mRolV = ko.observable(false);
    self.mObjetoV = ko.observable(false);
    self.mUsuarioV = ko.observable(false);
    self.mLogV = ko.observable(false);
    self.mCambiarContrasenaV = ko.observable(false);
    self.mConfiguracionV = ko.observable(false);
    self.mSocialV = ko.observable(false);
    self.mDenunciaV = ko.observable(false);
    self.mPostSocialV = ko.observable(false);

    self.mContactoV = ko.observable(false);
 
    
    self.detalleAplicacion = ko.observable();
    

    self.getPermisoMenu = function () {
        var url = pathApi + "objeto/obtenerlistapermisomenu";
        disableBottonForm();
        $.post(url, function (data) {
            if (data["estatus"]) {
                var resultado = data["resultado"];
                
                $.each(resultado, function (key, item) {
                    
                    // Add a list item for the product.
                    if (item.nombre_fisico == "mrol") {
                        self.mRolV(true);
                    } else if (item.nombre_fisico == "mobjeto") {
                        self.mObjetoV(true);
                    } else if (item.nombre_fisico == "musuario") {
                        self.mUsuarioV(true);
                    } else if (item.nombre_fisico == "mlog") {
                        self.mLogV(true);
                    } else if (item.nombre_fisico == "mcambiarcontrasena") {
                        self.mCambiarContrasenaV(true);
                    } else if (item.nombre_fisico == "mconfiguracion") {
                        self.mConfiguracionV(true);
                    } else if (item.nombre_fisico == "mcontacto") {
                        self.mContactoV(true);
                    } else if (item.nombre_fisico == "mrol") {
                        self.mRolV(true);
                    } else if (item.nombre_fisico == "mcambiarcontrasena") {
                        self.mCambiarContrasenaV(true);
                    } else if (item.nombre_fisico == "msocial") {
                        self.mSocialV(true);
                    } else if (item.nombre_fisico == "mdenuncia") {
                        self.mDenunciaV(true);
                    } else if (item.nombre_fisico == "mpostsocial") {
                        self.mPostSocialV(true);
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

    self.mDashboard = function () {
        redirect(pathWeb + "estadistica");
    }

    self.mRol = function () {
        redirect(pathWeb + "rol");
    }

    self.mObjeto = function () {
        redirect(pathWeb + "objeto");
    }

    self.mUsuario = function () {
        redirect(pathWeb + "usuario/administrar");
    }

    self.mLog = function () {
        redirect(pathWeb + "log");
    }

    self.mCambiarContrasena = function () {
        redirect(pathWeb + "usuario/cambiarcontrasena");
    }

    self.mCandidato = function () {
        redirect(pathWeb + "candidato");
    }

    self.mPuesto = function () {
        redirect(pathWeb + "puesto");
    }

    self.mConfiguracion = function () {
        redirect(pathWeb + "configuracion");
    }

    self.mSocial = function () {
        redirect(pathWeb + "social");
    }

    self.mMarca = function () {
        redirect(pathWeb + "marca");
    }

    self.mContacto = function () {
        redirect(pathWeb + "contacto");
    }

    self.mResultadoPrueba  = function () {
        redirect(pathWeb + "candidatopuesto");
    }

    self.mReporte = function () {
        redirect(pathWeb + "reporte");
    }

    self.mColor = function () {
        redirect(pathWeb + "color");
    }

    self.mTipoPrueba = function () {
        redirect(pathWeb + "tipoprueba");
    }

    self.mPaciente = function () {
        redirect(pathWeb + "paciente");
    }

    self.mDenuncia = function () {
        redirect(pathWeb + "denuncia/administrar");
    }

    self.mCaracteristica = function () {
        redirect(pathWeb + "caracteristica");
    }

    self.mMoneda = function () {
        redirect(pathWeb + "moneda");
    }

    self.mPostSocial = function () {
        redirect(pathWeb + "postsocial/administrar");
    }

    
    self.mAsiSeVota = function () {
      if (!self.vistaInicio()) {
       redirect(pathWeb + "#asiSeVota"); 
      }
    }
    
    self.mComoVotar = function () {
      if (!self.vistaInicio()) {
       redirect(pathWeb + "#comoVotar"); 
      }
    }
    
    self.mPadron = function () {
      if (!self.vistaInicio()) {
       redirect(pathWeb + "#padron"); 
      }
    }
     
    self.btnPadron = function () {
      $("#ifPadron").attr("src", "http://contacto.jce.gob.do/jceweb/consultapadron/Inicio.aspx");
      $( "#modalPadron").modal('show');
    }
    
    self.mCandidaturas = function () {
        redirect(pathWeb + "candidatura");
    }
    
    self.mRecintos = function () {
        redirect(pathWeb + "recinto");
    }
    
    self.mDenuncias = function () {
        redirect(pathWeb + "denuncia");
    }
    
    self.mEstadisticas = function () {
        redirect(pathWeb + "estadisticas");
    }

    self.mInformate = function () {
        redirect(pathWeb + "informate");
    }

    self.propiedadPaginaSiguiente = function() {
      self.paginaActualTemp(self.paginaActual());
      self.paginaActual(self.paginaActual() + 1);
      self.obtenerPropiedades();
    }

    self.propiedadPaginaAnterior = function() {
      self.paginaActualTemp(self.paginaActual());
      self.paginaActual(self.paginaActual() - 1);
      self.obtenerPropiedades();
    }

    self.cambiarModoVista = function(modo) {
      self.modoVista(modo);
      $.each(self.listaPropiedad(), function (key, item) {
        var imgPin = (item.tipo == "C") ? "pin-house.png" : ((item.tipo == "A") ? "pin-apartment.png" : ((item.tipo == "O") ? "pin-commercial.png" : "pin-land.png"));
        imgPin = imgDefault+imgPin;
        var modoDiv = (modo == "G") ? "grid-map-" : "list-map-";
        mapInit(item.lat,item.lng, modoDiv+item.IDpropiedad, imgPin, false);
      });
      if (self.modoVista() == "G") {
        app.appGridOffer("grid-offer");
      } else {
        app.appListOffer("list-offer");
      }
    }


     self.obtenerPerfil = function () {
        var url = pathApi + "usuario/apiobtenerperfil/";
          $.getJSON(url)
          .done(function (data) {
              if (data["estatus"]) {
                var resultado = data["resultado"];
                  /**
                   * Perfil
                   */
                  self.nombreApellido(resultado.nombre + " " + resultado.apellido);
                  self.usuario(resultado.usuario);
                  self.imgPerfil(resultado.imagenPerfil);
                  self.rol(resultado.nombreRol);
                  self.logo(resultado.logoEmpresa);
              } else {
                  mostrarMensajeE(data["mensaje"]);
              }
          }).fail(function (d) {
              mostrarMensajeE(d.responseText);
          });
        
    }

    self.btnPanel = function() {
      redirect(pathWeb + "panel");
    }

    self.btnPerfil = function() {
      redirect(pathWeb + "perfil");
    }

    self.btnSesion = function() {
      redirect(pathWeb + "admin");
    }

    self.btnInicio = function() {
      redirect(pathWeb);
    }

    self.btnPropiedades = function() {
      redirect(pathWeb + "propiedad");
    }

    self.btnAgentes = function() {
      redirect(pathWeb + "agentes");
    }

    self.btnContactenos = function() {
      redirect(pathWeb + "contactenos");
    }

    self.btnCambiarContrasena = function() {
      redirect(pathWeb + "cambiarcontrasena");
    }
    
    self.cerrarSesion = function() {
      self.usuarioLog(false);
      redirect(pathWeb + "usuario/cerrarsesion");
    }
    
    self.mostrarRegistrate = function() {
        $( "#login-modal" ).modal('hide');
        $( "#register-modal" ).modal();
        $('body').css('padding-right','0px');
        //self.divRegistrateVisible(true);
        //self.divRecuperarContrasenaVisible(false);
    }

    self.mostrarIniciarSecion = function() {
      $( "#forgot-modal" ).modal('hide');
      $( "#register-modal" ).modal('hide');
      $( "#login-modal" ).modal();
      $('body').css('padding-right','0px');
      //app.divRegistrateVisible(false);
      //app.divRecuperarContrasenaVisible(false);
    }

    self.mostrarRecuperarContrasena = function() {
        $( "#login-modal" ).modal('hide');
        $( "#forgot-modal" ).modal();
        $('body').css('padding-right','0px');
      //self.divRegistrateVisible(false);
      //self.divRecuperarContrasenaVisible(true);
    }

    self.btnRegistrate = function() {
      $('#modalSesion').modal('show');
    }
    
    self.iniciarSesion = function() {
      var url = pathApi + "usuario/apiiniciarsesion";
      var usuario = $("#txtUsuario").val();
      var contrasena = $("#txtContrasena").val();
      if ($("#frmSesion").valid()) {
        disableBottonForm("frmSesion", "btnIniciarSesion");
        $.post(url, {usuario:usuario, contrasena:contrasena}, function(data) {
          if (data["estatus"]) {
            redirect(pathWeb + "admin");
          } else {
            enableBottonForm("frmSesion", "btnIniciarSesion");
            mostrarMensajeE(data["mensaje"], "divMensajeESesion", "M");
          }
        }, "json")
        .fail(function (d) {
             enableBottonForm("frmSesion", "btnIniciarSesion");
             mostrarMensajeE(d.responseText, "divMensajeESesion", "M");
         });     
      }
    }

    self.btnSesionTwitter = function() {
      redirect(pathWeb + "usuario/sesiontwitter");
    }

    self.btnSesionFacebook = function() {
      redirect(pathWeb + "usuario/sesionfacebook");
    }

/*
    self.recuperarContrasena = function() {
      var direccion = '<?php echo HOST."usuario/recordarContrasena/";?>';
      var nombreUsuario = $("#txtUsuarioRecuperar").val();
      //$('#divMensaje').html('<img src="<?php echo IMAGE."loader.gif";?>">');
      $("#btnRecuperarContrasena").attr("disabled", "disabled");
      $('#mod-espera').modal('show');
      $.post(direccion, {usuario:nombreUsuario}, function(data) {
        if (data["estado"]) {
          mostrarMensaje(data["mensaje"], "I");
        } else {
          mostrarMensaje(data["mensaje"], "E");
          $("#btnRecuperarContrasena").removeAttr("disabled");
        }
        $('#mod-espera').modal('hide');
      }, "json");     
    }
*/
    self.registrarUsuario = function() {
      var url = pathApi + "usuario/apicrearusuario";
      if ($("#frmRegistrate").valid()) {
        disableBottonForm("frmRegistrate", "btnRegistrate");
        $.post(url, $("#frmRegistrate").serialize(), function (data) {
          data["estatus"];
          if (data["estatus"]) {
            redirect(pathWeb + "perfil");
            $('#modalSesion').modal('hide');
            $('#modal-info').modal('show');
            $("#frmRegistrate").trigger("reset");
          } else {
            mostrarMensajeE(data["mensaje"], "divMensajeESesion");
          }
          enableBottonForm("frmRegistrate", "btnRegistrate");
        }, "json")
       .fail(function (d) {
          enableBottonForm();
          mostrarMensajeE(d.responseText, "divMensajeESesion");
       });
      }
    }

  self.enviarCorreoConfirmacion = function() {
    var url = pathApi + "usuario/apinotificarcorreo";
    disableBottonForm("", "btnNotificarCorreo");
    $.post(url, function (data) {
      if (data["estatus"]) {
        mostrarMensajeS(data["mensaje"]);
      } else {
        mostrarMensajeE(data["mensaje"]);
      }
      enableBottonForm("", "btnNotificarCorreo");
    }, "json")
   .fail(function (d) {
      enableBottonForm();
      mostrarMensajeE(d.responseText);
   });
  }

  self.cambiarContrasenaRecuperada = function () {
    var url = pathApi + "usuario/apicambiarcontrasenarecuperada/";
    if ($("#frm").valid()) {
      disableBottonForm();
      $.post(url, $("#frm").serialize(), function(data) {
        if (data["estatus"]) {
          mostrarMensajeS(data["mensaje"], "divMensajeS", "S");
          self.contrasenaCambiada(true);
        } else {
          enableBottonForm("frm", "btnEnviar");
          mostrarMensajeE(data["mensaje"], "divMensajeE", "E");
        }
      }, "json")
      .fail(function (d) {
           enableBottonForm("frm", "btnEnviar");
           mostrarMensajeE(d.responseText, "divMensajeE", "E");
       });  
    }
  }

  self.cambiarContrasenaRecuperadaF = function () {
    var url = pathApi + "usuario/apicambiarcontrasenarecuperada/";
    if ($("#frm").valid()) {
      disableBottonForm();
      $.post(url, $("#frm").serialize(), function(data) {
        if (data["estatus"]) {
          mostrarMensajeS(data["mensaje"]);
          self.contrasenaCambiada(true);
        } else {
          enableBottonForm("frm", "btnEnviar");
          mostrarMensajeE(data["mensaje"]);
        }
      }, "json")
      .fail(function (d) {
           enableBottonForm("frm", "btnEnviar");
           mostrarMensajeE(d.responseText);
       });  
    }
  }

  self.recuperarContrasena = function () {
    if ($("#frmPass").valid()) {
      disableBottonForm("frmPass", "btnEnviarRecuperar");
      var url = pathApi + "usuario/apirecordarcontrasena/"
      var usuario = $("#txtUsuarioRecuperar").val();
      $.post(url, {  "tipo":"F", usuario: usuario}, function (data) {
          if (data["estatus"]) {
              mostrarMensajeS(data["mensaje"]);
          } else {
              mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("frmPass", "btnEnviarRecuperar");
      }, "json")
      .fail(function () {
          mostrarMensajeE(error00);
          enableBottonForm("frmPass", "btnEnviarRecuperar");
      });
    }
  }

  self.btnDetallePropiedad = function(objeto) {
    redirect(pathWeb + "propiedad/d/"+objeto.url);
  }

  self.enviarContacto = function() {
    if ($("#frmContacto").valid()) {
      var url = pathApi + "contacto/apienviarmensaje";
      if ($("#frmContacto").valid()) {
        disableBottonForm("frmContacto", "btnEnviarContacto", "lContacto");
        $.post(url, $("#frmContacto").serialize(), function (data) {
          data["estatus"];
          if (data["estatus"]) {
            $("#frmContacto").trigger("reset");
            mostrarMensajeS(data["mensaje"]);
          } else {
            mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("frmContacto", "btnEnviarContacto", "lContacto");
        }, "json")
       .fail(function (d) {
          enableBottonForm("frmContacto", "btnEnviarContacto", "lContacto");
          mostrarMensajeE(d.responseText);
       });
      }
    }
  }

  self.btnRegistrarPropiedad = function() {
    redirect(pathWeb + "propiedad/registrar");
  }

  self.btnDetalleAgente = function(objeto) {
    redirect(pathWeb + "agente/" + objeto.url);
  }
   
  self.btnFacebook = function() {
      redirectT("https://www.facebook.com/dominicancode");
  }

  self.btnTwitter = function() {
      redirectT("http://twitter.com/dominicancode");
  }

  self.btnGPlus = function() {
      redirectT("http://plus.google.com/dominicancode");
  }

  self.btnInstagram = function() {
      redirectT("http://instagram.com/dominicancode");
  }

  /**
   * Aplicación
   */

  self.registrarLike = function() {
      var url = pathApi + "aplicacion/apiregistrarlike";
      $.post(url, {ID:self.detalleAplicacion().id}, function (data) {
        if (data["estatus"]) {
          var resultado = data["resultado"];
          self.detalleAplicacion().like = parseInt(self.detalleAplicacion().like + 1);
          mostrarMensajeS(data["mensaje"]);
        } else {
          mostrarMensajeE(data["mensaje"]);
        }
      }, "json")
     .fail(function (d) {
        mostrarMensajeE(d.responseText);
     });
  }


  self.compartirAplicacion = function() {
    $('#mCompartir').modal('show');
  }

  
  //https://www.facebook.com/v2.6/dialog/share?app_id=----&display=popup&e2e=%7B%7D&hashtag=------&href=-------&locale=en_US&mobile_iframe=false&next=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D42%23cb%3Dfbea5eec957b18%26domain%3D-------%26origin%3Dhttp%253A%252F%252F-----%252Ff1425864dbb90bc%26relation%3Dopener%26frame%3Df113f2a5417e048%26result%3D%2522xxRESULTTOKENxx%2522&quote=------&sdk=joey&version=v2.6
  self.btnCompartirAppFb = function() {
    redirectE("https://www.facebook.com/sharer/sharer.php?u="+pathWeb + " " + self.socialTitulo() + " #EleccionesRD");
    //redirectE("https://www.facebook.com/v2.6/dialog/share?app_id=106713742764647&display=popup&hashtag=%23EleccionesRD&href=http://dominicancode.com" + "&quote=" + self.socialTitulo());
  }

  
  //https://twitter.com/intent/tweet?text=----&button_hashtag=-----&url=http://-----/&via=----
  self.btnCompartirAppTwitter = function() {
    redirectE("https://twitter.com/?status="+pathWeb + " " + self.socialTitulo() + " #EleccionesRD");
  }

  self.btnCompartirAppGPlus = function() {
    redirectE("https://plus.google.com/share?url="+pathWeb + " " + self.socialTitulo() + " #EleccionesRD");
  }

  

  self.btnCompartirFb = function() {
    redirectE("https://www.facebook.com/sharer/sharer.php?u="+pathWeb+"propiedad/d/"+self.id());
  }

  self.btnCompartirTwitter = function() {
    redirectE("https://twitter.com/?status="+self.socialDescripcion()+"  "+pathWeb+"equipo/detalle/"+self.id());
  }

  self.btnCompartirGPlus = function() {
    redirectE("https://plus.google.com/share?url="+pathWeb+"equipo/detalle/"+self.id());
  }

  self.btnCompartirCorreo = function() {
    redirectE("https://www.facebook.com/sharer/sharer.php?u="+pathWeb+"equipo/detalle/"+self.id());
  }

  self.obtenerProvincia = function () {
      //var idPais = $("#IDpais").val();
      self.listaProvincia.removeAll();
      var url = pathApi + "localidad/obtenerprovinciapais/";
        $.getJSON(url)
        .done(function (data) {
            if (data["estatus"]) {
              var resultado = data["resultado"];
              /**
               * Provincias
               */
              self.listaProvincia(resultado);
            } else {
                mostrarMensajeE(data["mensaje"], "divMensajeEEquipo");
            }
        }).fail(function (d) {
            enableBottonForm();
            mostrarMensajeE(d.responseText, "divMensajeEEquipo");
        });
    }

  self.suscribir = function() {
      var url = pathApi + "informacion/apisuscribir";
      var nombre = "";
      var correo = $("#txtCorreoSuscriptor").val();
      if ($("#frmSuscripcion").valid()) {
        disableBottonForm("frmSuscripcion", "btnEnviarSuscripcion");
        $.post(url, {nombre:nombre, correo:correo}, function(data) {
          if (data["estatus"]) {
            mostrarMensajeS(data["mensaje"]);
            $("#frmSuscripcion").trigger("reset");
          } else {
            mostrarMensajeE(data["mensaje"]);
          }
          enableBottonForm("frmSuscripcion", "btnEnviarSuscripcion");
        }, "json")
        .fail(function (d) {
             enableBottonForm("frmSuscripcion", "btnEnviarSuscripcion");
             mostrarMensajeE(d.responseText);
         });     
      }
    }


  self.appGridOffer = function(id) {
    setTimeout(function(){ 
      $('.'+id+'-col').each( function () {
        var gh = 0; 
        gh += $(this).find('.'+id+'-photo').outerHeight();
        gh += $(this).find('.'+id+'-text').outerHeight();
        gh += $(this).find('.price-grid-cont').outerHeight();
        gh += $(this).find('.'+id+'-params').outerHeight();
        $(this).find('.'+id).stop(true, true).animate( { height: gh }, 0);
        $(this).find('.'+id+'-back').stop(true, true).animate( { height: gh }, 0);
      });
    }, 600);
  }

  self.appListOffer = function(id) {
    setTimeout(function(){ 
      $('.'+id+'-left').each( function () {
        var gh = 0; 
        gh += $(this).find('.'+id+'-photo').outerHeight();
        gh += $(this).find('.'+id+'-params').outerHeight();
        $(this).stop(true, true).animate( { height: gh - 30 }, 0);
        $(this).find('.'+id+'-back').stop(true, true).animate( { height: gh + 20 }, 0);
      }); 
    }, 600);
  }

  self.appSlider = function(id, step, metodo) {
    metodo = metodo || null;
    step = step || 1;
    $("."+id).each( function( index ) {
      var sliderId = $( this ).attr('id');
      var max = parseFloat($( this ).attr("data-max"));
      $( this ).slider({
         range: true,
         step: step,
         min:  parseFloat($( this ).attr("data-min")),
         max: max,
         values: [ parseFloat($( this ).attr("data-min")), parseFloat($( this ).attr("data-max")) ],
         slide: function( event, ui ) {
          $( "#" + sliderId + "-value" ).val( ui.values[ 0 ] + " - " + ((ui.values[1] == max) ? ui.values[1] + "+" : ui.values[1]) );
         },
         stop: function (event, ui) {
              eval(metodo);
          }
      });
      $( "#" + sliderId + "-value" ).val( $( this ).slider( "values", 0 ) + " - " + $( this ).slider( "values", 1 ) );
    });
  }

  self.appOwlCarousel = function(id, idNext, idPrev, item, itemsDesktop, itemsDesktopSmall) {
    item = item || 3;
    itemsDesktop = itemsDesktop || 3;
    itemsDesktopSmall = itemsDesktopSmall || 2;
    if( $("#"+id).length ) {
      $("#"+id).owlCarousel({
        items : item,
        itemsDesktop : [1182,itemsDesktop],
        itemsDesktopSmall : [974,itemsDesktopSmall],
        itemsTablet: [750,2],
        itemsTabletSmall: false,
        itemsMobile : [479,1],
        mouseDrag: true, 
        pagination: false
      });
      
      var gridOffersOwl  = $("#"+id).data('owlCarousel');
      $("#"+idNext).click( function ( event ) {
        event.preventDefault();
        gridOffersOwl.next();
      }); 
      $("#"+idPrev).click( function ( event ) {
        event.preventDefault();
        gridOffersOwl.prev();
      });
    }
  }

  self.mapa = function(idMapa, idBuscador, lat, lng) {
    if($("#"+idBuscador).length) {
      $("#"+idBuscador).geocomplete({
        map: "#"+idMapa,
        details: "form ",
        location: new google.maps.LatLng(lat, lng),
        mapOptions: {
          zoom: 14,
          scrollwheel: true,
          mapTypeId: "roadmap",
          disableDefaultUI: false,
          mapTypeControl: true,
          mapTypeControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
          },
          zoomControl: true,
          zoomControlOptions: {
            position: google.maps.ControlPosition.RIGHT_TOP
          },
          scaleControl: true,
          streetViewControl: true,
          streetViewControlOptions: {
            position: google.maps.ControlPosition.RIGHT_TOP
          },
          styles: mapStyle         
        },
        markerOptions: {
          draggable: true,
          icon: imgDefault+'pin-empty.png'
        }
      });
        
        $("#"+idBuscador).bind("geocode:dragged", function(event, latLng){
          $("input[name=lat]").val(latLng.lat());
          $("input[name=lng]").val(latLng.lng());
        });
      }
  }


  self.swiperGallery = function() {
    if( ("#swiper-gallery").length ) {
      var sliderHeight;
      if( w_height > 650 || w_width < 481 ) {
        sliderHeight =  w_height - $('header').innerHeight() - $('.thumbs-slider').outerHeight();
      } else {
        sliderHeight = 500;
      }
      $("#swiper-gallery").css('height', sliderHeight + 'px');
      $("#swiper-gallery .slide-desc-col").css('height', sliderHeight + 'px');
    }
    
    if( $("#swiper-gallery").length ) {
      //initialize swiper when document ready  
      gallerySwiper = new Swiper ('#swiper-gallery', {
        // Optional parameters
        nextButton: '.slide-next',
        prevButton: '.slide-prev',
        loop: true,
        grabCursor: true,
        preloadImages: false,
        lazyLoading: true,
        lazyLoadingInPrevNext: true,
        loopAdditionalSlides: 0,
        autoplay: 5000,
        speed: 700
      });
      
      var slidesSum = $("#swiper-gallery .swiper-slide").length;
      $(".gallery-slide-desc-1").addClass("gallery-slide-desc-" + (slidesSum - 1));
      $(".gallery-slide-desc-" + (slidesSum - 2)).addClass("gallery-slide-desc-0");

      gallerySwiper.on('onTransitionEnd', function () {
        $(".gallery-slide-desc-" + gallerySwiper.previousIndex).removeClass("fadeInUp");
        $(".gallery-slide-desc-" + gallerySwiper.previousIndex).addClass("fadeOutUp");
        $(".gallery-slide-desc-" + gallerySwiper.activeIndex).removeClass("fadeOutUp");
        $(".gallery-slide-desc-" + gallerySwiper.activeIndex).addClass("fadeInUp");
      });   
      
      gallerySwiper.on('onSlideChangeStart', function () {
        if( $("#swiper-thumbs").length ) {
          if(gallerySwiper.activeIndex == (slidesSum - 1) ) {
            thumbsSwiper.slideTo(0);
          } else {  
            thumbsSwiper.slideTo(gallerySwiper.activeIndex-2);
          }
        }
        $( "#slide-more-cont a" ).css('z-index', 10);
        $( "#slide-more-cont a.num-" + gallerySwiper.activeIndex ).css('z-index', 20);
        
      });
      
      $("#swiper-gallery .swiper-slide").each( function(index) {
        var imageHref = $(this).children('.slide-bg').first().attr('data-background');
        var imageDescr = $(this).children('.slide-bg').first().attr('data-sub-html');
        if (typeof imageDescr === "undefined") {
          imageDescr = "";
        }
        var num = index;

        if( ! $(this).hasClass('swiper-slide-duplicate') ) {
          $( "#slide-more-cont" ).append( '<a href="' + imageHref + '" class="navigation-box navigation-box-more slide-more num-' + num + '" ' + ((typeof imageDescr !== "undefined")? ' data-sub-html="' + imageDescr : '') + '"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont fa-lg">&#xe813;</i></div></a>' );
        }
      });
      $( "#slide-more-cont a.num-1" ).css('z-index', 20);
    }
  
  
    if( $("#swiper-thumbs").length ) {
      var slideIndex;
      //initialize swiper when document ready  
      var thumbsSwiper = new Swiper ('#swiper-thumbs', {
        // Optional parameters
        nextButton: '.thumb-next',
        prevButton: '.thumb-prev',
        spaceBetween: 15,
        centeredSlides: false,
        slidesPerView: 'auto',
        touchRatio: 0.2,
        slideToClickedSlide: false
      });
      
      $("#swiper-thumbs .swiper-slide").click(function() {
        gallerySwiper.slideTo(thumbsSwiper.clickedIndex+1);
      });
    }

    $(window).trigger( "resize" );
  }

  self.shareW = function(shareURL){
      var left = window.screen.width / 2 - (660 / 2);
      var top = window.screen.height / 2 - (460 / 2);
      //url = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent( shareURL );
      var url = shareURL;

      window.open(url, "Share", "status=1,height=" + 460 + ",width=" + 600 + ",top=" + top + ",left=" + left + ",resizable=0");

      return false;
    }
  
   self.mostrarComoVotarBoleta = function(boleta) {
        $( "#modalComoVotar-"+boleta ).modal('show');
    }
   
   

}


var app = new App();