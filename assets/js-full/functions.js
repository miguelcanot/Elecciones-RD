/* 
Libs file
version 1.0 2015-06-25
autor: Miguel Canot
Copyright(C) 2015 Miguel Canot - Dominican Code All rights reserved
*/

var btn = null;

function disableBottonForm(idForm, idButton, idLoader) {
    idForm = idForm || "frm";
    idButton = idButton || "btnEnviar";
    idLoader = idLoader || "divLoader";
    btn = $("#" + idButton);
    btn.button('loading');
    $("#" + idLoader).removeClass("invisible");
    $('#' + idForm).find('input, textarea, button, select').attr('readonly', 'readonly');
}

function enableBottonForm(idForm, idButton, idLoader) {
    idForm = idForm || "frm";
    idButton = idButton || "btnEnviar";
    idLoader = idLoader || "divLoader";
    btn = $("#" + idButton);
    btn.button('reset');
    $("#" + idLoader).addClass("invisible");
    $('#' + idForm).find('input, textarea, button, select').removeAttr('readonly', 'readonly');
}

function disableFormOnSubmit(id) {
    id = id || "frm";
    $("#" + id).submit(function (event) {
        $('#' + id).find('input, textarea, button, select').attr('disabled', 'disabled');
    });
    
}

function redirect(url) {
    window.location.href = url;
}

function redirectT(url) {
    window.open(url, "_blank");
}

function redirectE(url) {
    window.open(url, "", "width=800, height=500")
}

function disableBottonFormOnSubmit(idForm, idButton) {
    idForm = idForm || "frm";
    idButton = idButton || "btnEnviar";
    $("#" + idForm).submit(function (event) {
        btn = $("#"+idButton);
        btn.button('loading');
        //$('#' + idForm).find('input, textarea, button, select').attr('readonly', 'readonly');
    });
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

function checkCookie() {
    var user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
            setCookie("username", user, 365);
        }
    }
}

function tOcultarAlerta(id, tiempo) {
    var tiempo = tiempo || 3000;
    setTimeout("jQuery('#" + id + "').html('');", 3000);
}

function mostrarMensajeS(mensaje, id, tipo) {
    id = id || "divMensajeS";
    tipo = tipo || "T";
    if (tipo == "T") {
        mostrarToastr(mensaje);
    } else {
        $("#"+id).removeClass("invisible");
        $("#"+id).html(mensaje);
        var tiempo = tiempo || 5000;
        setTimeout("ocultarMensajeS('"+id+"')", tiempo);
    }
}

function ocultarMensajeS(id) {
    id = id || "divMensajeS";
    $('#'+id).html('');
    $('#'+id).addClass('invisible');
}

function mostrarMensajeE(mensaje, id, tipo) {
    
    id = id || "divMensajeE";
    tipo = tipo || "T";
    if (tipo == "T") {
        mostrarToastr(mensaje, "E");
    } else {
       $("#"+id).removeClass("invisible");
        $("#"+id).html(mensaje);
        var tiempo = tiempo || 5000;
        setTimeout("ocultarMensajeE('" + id + "')", tiempo);
    }
}

function ocultarMensajeE(id) {
    id = id || "divMensajeE";
    $('#'+id).html('');
    $('#'+id).addClass('invisible');
}

function backBrowser() {
    window.history.back();
}

function obtenerDiaSemana(numeroDia){
    letraDia = '';
    switch (numeroDia){
        case "0":
            letraDia =  "Domingo";
            break;
        case "1":
            letraDia = "Lunes";
            break;
        case "2":
            letraDia = "Martes";
            break;
        case "3":
            letraDia = "Miércoles";
            break;
        case "4":
            letraDia =  "Jueves";
            break;
        case "5":
            letraDia =  "Viernes";
            break;
        case "6":
            letraDia =  "Sabado";
            break;
    }
            
    return letraDia;
}

var mensajeFechaMayorQue = "The end date must be less than the start date";

function validarFecha(idInputFechaInicio, idInputFechaFin, idLabelError) {
    if (!validarFechaMayorQue($("#" + idInputFechaInicio).val(), $("#" + idInputFechaFin).val())) {
        $("#" + idInputFechaFin).addClass("input-validation-error");
        $("#" + idLabelError).html(mensajeFechaMayorQue);
        $("#" + idLabelError).addClass('field-validation-error');
        $("#" + idLabelError).removeClass('field-validation-valid');
        return false;
    } else {
        $("#" + idInputFechaFin).removeClass("input-validation-error");
        $("#" + idLabelError).removeClass('field-validation-error');
        $("#" + idLabelError).addClass('field-validation-valid');
        return true;
    }
};

function validarFechaMayorQue(fechaInicio, fechaFin) {
    var startDate = new Date(fechaInicio);
    var endDate = new Date(fechaFin);
    if (endDate < startDate) {
        return false;
    }
    return true;
}

var mensajeHoraMayorQue = "The end time must be less than the start time";

function validarHora(idInputInicio, idInputFin, idLabelError) {
    if (!validarHoraMayorQue($("#" + idInputInicio).val(), $("#" + idInputFin).val())) {
        $("#" + idInputFin).addClass("input-validation-error");
        $("#" + idLabelError).html(mensajeHoraMayorQue);
        $("#" + idLabelError).addClass('field-validation-error');
        $("#" + idLabelError).removeClass('field-validation-valid');
        return false;
    } else {
        $("#" + idInputFin).removeClass("input-validation-error");
        $("#" + idLabelError).removeClass('field-validation-error');
        $("#" + idLabelError).addClass('field-validation-valid');
        return true;
    }
};

function validarHoraMayorQue(inicio, fin) {
    if (fin < inicio) {
        return false;
    }
    return true;
}

function toShortDateString(fecha) {
    if (fecha == null) {
        return fecha;
    } else {
        var fechaTemp = fecha.split("T");
        return (fechaTemp.length > 0) ? fechaTemp[0] : fechaTemp;
    }

    var date = new Date(fecha);
    var dia = date.getDate() + 1;
    dia = (dia.toString().length == 1) ? "0" + dia : dia;
    var mes = date.getMonth() + 1;
    mes = (mes.toString().length == 1) ? "0" + mes : mes;
    return (date.getFullYear() + "/" + mes + "/" + dia);
}

function toLongDateString(fecha) {
    var fechaTemp = fecha.replace("T", " ");
    return fechaTemp;

    var date = new Date(fecha);
    var dia = date.getDate();
    dia = (dia.toString().length == 1) ? "0" + dia : dia;
    var mes = date.getMonth() + 1;
    mes = (mes.toString().length == 1) ? "0" + mes : mes;
    return (date.getFullYear() + "/" + mes + "/" + dia);
    console.log(date);
    var hora = date.getHours();
    hora = (hora.toString().length == 1) ? "0" + hora : hora;
    var minuto = date.getMinutes();
    minuto = (minuto.toString().length == 1) ? "0" + minuto : minuto;
    var segundo = date.getSeconds();
    segundo = (segundo.toString().length == 1) ? "0" + segundo : segundo;
    return (date.getFullYear() + "/" + mes + "/" + dia + " " + hora + ":" + minuto + ":" + segundo);
}

function scrollTo(id) {
    $('html,body').animate({scrollTop: $("#"+id).offset().top}, 'slow');
}

var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};

function botonImagen(idFile, idBoton, idRuta, tipo) {
    tipo = tipo || "S";
    $("#" + idFile).change(function (a) {
        if (tipo == "I") {
            console.log("asd")
            $("#" + idRuta).val($("#" + idFile).val());
        } else {
            console.log("jojo")
            $("#" + idRuta).html($("#" + idFile).val());
        }
    });
    $("#" + idBoton).bind('click', function () {
        document.getElementById(idFile).click();
    });
}

function mostrarToastr(mensaje, tipo) {
    mensaje = mensaje || "";
    tipo = tipo || "S";
    if (mensaje != "") {
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": true,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        if (tipo == "S") {
            toastr.success(mensaje)
        } else if (tipo == "E") {
            toastr.error(mensaje)
        } else if (tipo == "W") {
            toastr.warning(mensaje)
        } else {
            toastr.info(mensaje)
        }
    }
}

(function($) {
  $.fn.serializefiles = function() {
      var obj = $(this);
      /* ADD FILE TO PARAM AJAX */
      var formData = new FormData();
      $.each($(obj).find("input[type='file']"), function(i, tag) {
          $.each($(tag)[0].files, function(i, file) {
              formData.append(tag.name, file);
          });
      });
      var params = $(obj).serializeArray();
      $.each(params, function (i, val) {
          formData.append(val.name, val.value);
      });
      return formData;
  };
})(jQuery);


var w_height = jQuery(window).height();
var w_width = jQuery(window).width();
var estateMap = false;
var panorama = false;
var staticDescHeight = 0;
var mapStyle = [{"featureType":"landscape","stylers":[{	"hue":"#FFBB00"	},{	"saturation":43.400000000000006},{"lightness":37.599999999999994},{	"gamma":1}]},{"featureType":"road.highway",	"stylers":[	{"hue":"#FFC200"},{	"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},	{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},	{"featureType":"road.local",	"stylers":[	{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},	{"featureType":"water","stylers":[	{"hue":"#0078FF"	},	{"saturation":-13.200000000000003},	{"lightness":2.4000000000000057},{"gamma":1}]},	{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}];

function mapInit(lat,lng,id, pinicon, ui, offset) {
	if( ui == false ) {
		ui= true;
	} else {
		ui = false;
	}
	if( w_width > 991 ) {
		offset = typeof offset !== 'undefined' ? 0.0075 : 0;
	} else {
		offset = 0;
	}
	var mapOptions = {
		zoom: 15,
		disableDefaultUI: ui,
		mapTypeControlOptions: {
		position: google.maps.ControlPosition.LEFT_TOP
	},
	zoomControlOptions: {
		position: google.maps.ControlPosition.RIGHT_TOP
	},
	streetViewControlOptions: {
		position: google.maps.ControlPosition.RIGHT_TOP
	},
	center: new google.maps.LatLng(lat - offset, lng),
		styles: mapStyle
	};

	var mapElement = document.getElementById(id);
	var map = new google.maps.Map(mapElement, mapOptions);

	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(lat, lng),
		map: map,
		title: '',
		icon: pinicon
	});
	if( id == "estate-map" ) {
		estateMap = map;
	}
}

function mapInitMultiple(id, locations) {
	var mapOptions = {
		zoom: 15,
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
		scrollwheel: false,
		center: new google.maps.LatLng(locations[0][0], locations[0][1]),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		styles: mapStyle
	};
	var mapElement = document.getElementById(id);

	var map = new google.maps.Map(mapElement, mapOptions);
	var LatLngList = [];
	var i = 0;
	var mapMarkers = [];
	for (i = 0; i < locations.length; i++) {
		var pos = new google.maps.LatLng(locations[i][0], locations[i][1]);
		var marker = new google.maps.Marker({
			position: pos,
			map: map,
			title: '',
			icon: locations[i][2]
		});
				
		mapMarkers[i] = marker;
				
		var infoBoxContent = document.createElement("div");
		infoBoxContent.className = "infobox-wrapper";
		infoBoxContent.innerHTML = "<a class='infobox-main' href='#'><div class='infobox-text'>" + locations[i][5] + "</div></a>";
        //infoBoxContent.innerHTML = "Tesing";
		mapMarkers[i].infobox = new InfoBox({
			content: infoBoxContent,
			disableAutoPan: false,
			pixelOffset: new google.maps.Size(30, -150),
			zIndex: null,
			 boxStyle: {	
					},
			closeBoxMargin: "0px",
			closeBoxURL: imgDefault+"infobox-close.png",
			infoBoxClearance: new google.maps.Size(1, 1)
		});
		google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
						var j = 0;
                        for (j = 0; j < mapMarkers.length; j++) {
                            mapMarkers[j].infobox.close();
                        }
                        mapMarkers[i].infobox.open(map, this);
                    }
                })(marker, i));
		LatLngList[i] = pos;
	}
			
	var bounds = new google.maps.LatLngBounds();
	for (var i = 0, LtLgLen = LatLngList.length; i < LtLgLen; i++) {
		bounds.extend(LatLngList[i]);
	}
	map.fitBounds(bounds);
				
	var markerClusterStyle = [{
		url: imgDefault+'pin-empty.png',
		height: 80,
		width: 48,
		textSize: 16,
		textColor: '#3798dd'
	}];
	var markerCluster = new MarkerClusterer(map, mapMarkers, {styles:markerClusterStyle});
}



/* CLUSER MANAGER */
(function(){var d=null;function e(a){return function(b){this[a]=b}}function h(a){return function(){return this[a]}}var j;
function k(a,b,c){this.extend(k,google.maps.OverlayView);this.c=a;this.a=[];this.f=[];this.ca=[53,56,66,78,90];this.j=[];this.A=!1;c=c||{};this.g=c.gridSize||60;this.l=c.minimumClusterSize||2;this.J=c.maxZoom||d;this.j=c.styles||[];this.X=c.imagePath||this.Q;this.W=c.imageExtension||this.P;this.O=!0;if(c.zoomOnClick!=void 0)this.O=c.zoomOnClick;this.r=!1;if(c.averageCenter!=void 0)this.r=c.averageCenter;l(this);this.setMap(a);this.K=this.c.getZoom();var f=this;google.maps.event.addListener(this.c,
"zoom_changed",function(){var a=f.c.getZoom();if(f.K!=a)f.K=a,f.m()});google.maps.event.addListener(this.c,"idle",function(){f.i()});b&&b.length&&this.C(b,!1)}j=k.prototype;j.Q="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m";j.P="png";j.extend=function(a,b){return function(a){for(var b in a.prototype)this.prototype[b]=a.prototype[b];return this}.apply(a,[b])};j.onAdd=function(){if(!this.A)this.A=!0,n(this)};j.draw=function(){};
function l(a){if(!a.j.length)for(var b=0,c;c=a.ca[b];b++)a.j.push({url:a.X+(b+1)+"."+a.W,height:c,width:c})}j.S=function(){for(var a=this.o(),b=new google.maps.LatLngBounds,c=0,f;f=a[c];c++)b.extend(f.getPosition());this.c.fitBounds(b)};j.z=h("j");j.o=h("a");j.V=function(){return this.a.length};j.ba=e("J");j.I=h("J");j.G=function(a,b){for(var c=0,f=a.length,g=f;g!==0;)g=parseInt(g/10,10),c++;c=Math.min(c,b);return{text:f,index:c}};j.$=e("G");j.H=h("G");
j.C=function(a,b){for(var c=0,f;f=a[c];c++)q(this,f);b||this.i()};function q(a,b){b.s=!1;b.draggable&&google.maps.event.addListener(b,"dragend",function(){b.s=!1;a.L()});a.a.push(b)}j.q=function(a,b){q(this,a);b||this.i()};function r(a,b){var c=-1;if(a.a.indexOf)c=a.a.indexOf(b);else for(var f=0,g;g=a.a[f];f++)if(g==b){c=f;break}if(c==-1)return!1;b.setMap(d);a.a.splice(c,1);return!0}j.Y=function(a,b){var c=r(this,a);return!b&&c?(this.m(),this.i(),!0):!1};
j.Z=function(a,b){for(var c=!1,f=0,g;g=a[f];f++)g=r(this,g),c=c||g;if(!b&&c)return this.m(),this.i(),!0};j.U=function(){return this.f.length};j.getMap=h("c");j.setMap=e("c");j.w=h("g");j.aa=e("g");
j.v=function(a){var b=this.getProjection(),c=new google.maps.LatLng(a.getNorthEast().lat(),a.getNorthEast().lng()),f=new google.maps.LatLng(a.getSouthWest().lat(),a.getSouthWest().lng()),c=b.fromLatLngToDivPixel(c);c.x+=this.g;c.y-=this.g;f=b.fromLatLngToDivPixel(f);f.x-=this.g;f.y+=this.g;c=b.fromDivPixelToLatLng(c);b=b.fromDivPixelToLatLng(f);a.extend(c);a.extend(b);return a};j.R=function(){this.m(!0);this.a=[]};
j.m=function(a){for(var b=0,c;c=this.f[b];b++)c.remove();for(b=0;c=this.a[b];b++)c.s=!1,a&&c.setMap(d);this.f=[]};j.L=function(){var a=this.f.slice();this.f.length=0;this.m();this.i();window.setTimeout(function(){for(var b=0,c;c=a[b];b++)c.remove()},0)};j.i=function(){n(this)};
function n(a){if(a.A)for(var b=a.v(new google.maps.LatLngBounds(a.c.getBounds().getSouthWest(),a.c.getBounds().getNorthEast())),c=0,f;f=a.a[c];c++)if(!f.s&&b.contains(f.getPosition())){for(var g=a,u=4E4,o=d,v=0,m=void 0;m=g.f[v];v++){var i=m.getCenter();if(i){var p=f.getPosition();if(!i||!p)i=0;else var w=(p.lat()-i.lat())*Math.PI/180,x=(p.lng()-i.lng())*Math.PI/180,i=Math.sin(w/2)*Math.sin(w/2)+Math.cos(i.lat()*Math.PI/180)*Math.cos(p.lat()*Math.PI/180)*Math.sin(x/2)*Math.sin(x/2),i=6371*2*Math.atan2(Math.sqrt(i),
Math.sqrt(1-i));i<u&&(u=i,o=m)}}o&&o.F.contains(f.getPosition())?o.q(f):(m=new s(g),m.q(f),g.f.push(m))}}function s(a){this.k=a;this.c=a.getMap();this.g=a.w();this.l=a.l;this.r=a.r;this.d=d;this.a=[];this.F=d;this.n=new t(this,a.z(),a.w())}j=s.prototype;
j.q=function(a){var b;a:if(this.a.indexOf)b=this.a.indexOf(a)!=-1;else{b=0;for(var c;c=this.a[b];b++)if(c==a){b=!0;break a}b=!1}if(b)return!1;if(this.d){if(this.r)c=this.a.length+1,b=(this.d.lat()*(c-1)+a.getPosition().lat())/c,c=(this.d.lng()*(c-1)+a.getPosition().lng())/c,this.d=new google.maps.LatLng(b,c),y(this)}else this.d=a.getPosition(),y(this);a.s=!0;this.a.push(a);b=this.a.length;b<this.l&&a.getMap()!=this.c&&a.setMap(this.c);if(b==this.l)for(c=0;c<b;c++)this.a[c].setMap(d);b>=this.l&&a.setMap(d);
a=this.c.getZoom();if((b=this.k.I())&&a>b)for(a=0;b=this.a[a];a++)b.setMap(this.c);else if(this.a.length<this.l)z(this.n);else{b=this.k.H()(this.a,this.k.z().length);this.n.setCenter(this.d);a=this.n;a.B=b;a.ga=b.text;a.ea=b.index;if(a.b)a.b.innerHTML=b.text;b=Math.max(0,a.B.index-1);b=Math.min(a.j.length-1,b);b=a.j[b];a.da=b.url;a.h=b.height;a.p=b.width;a.M=b.textColor;a.e=b.anchor;a.N=b.textSize;a.D=b.backgroundPosition;this.n.show()}return!0};
j.getBounds=function(){for(var a=new google.maps.LatLngBounds(this.d,this.d),b=this.o(),c=0,f;f=b[c];c++)a.extend(f.getPosition());return a};j.remove=function(){this.n.remove();this.a.length=0;delete this.a};j.T=function(){return this.a.length};j.o=h("a");j.getCenter=h("d");function y(a){a.F=a.k.v(new google.maps.LatLngBounds(a.d,a.d))}j.getMap=h("c");
function t(a,b,c){a.k.extend(t,google.maps.OverlayView);this.j=b;this.fa=c||0;this.u=a;this.d=d;this.c=a.getMap();this.B=this.b=d;this.t=!1;this.setMap(this.c)}j=t.prototype;
j.onAdd=function(){this.b=document.createElement("DIV");if(this.t)this.b.style.cssText=A(this,B(this,this.d)),this.b.innerHTML=this.B.text;this.getPanes().overlayMouseTarget.appendChild(this.b);var a=this;google.maps.event.addDomListener(this.b,"click",function(){var b=a.u.k;google.maps.event.trigger(b,"clusterclick",a.u);b.O&&a.c.fitBounds(a.u.getBounds())})};function B(a,b){var c=a.getProjection().fromLatLngToDivPixel(b);c.x-=parseInt(a.p/2,10);c.y-=parseInt(a.h/2,10);return c}
j.draw=function(){if(this.t){var a=B(this,this.d);this.b.style.top=a.y+"px";this.b.style.left=a.x+"px"}};function z(a){if(a.b)a.b.style.display="none";a.t=!1}j.show=function(){if(this.b)this.b.style.cssText=A(this,B(this,this.d)),this.b.style.display="";this.t=!0};j.remove=function(){this.setMap(d)};j.onRemove=function(){if(this.b&&this.b.parentNode)z(this),this.b.parentNode.removeChild(this.b),this.b=d};j.setCenter=e("d");
function A(a,b){var c=[];c.push("background-image:url("+a.da+");");c.push("background-position:"+(a.D?a.D:"0 0")+";");typeof a.e==="object"?(typeof a.e[0]==="number"&&a.e[0]>0&&a.e[0]<a.h?c.push("height:"+(a.h-a.e[0])+"px; padding-top:"+a.e[0]+"px;"):c.push("height:"+a.h+"px; line-height:"+a.h+"px;"),typeof a.e[1]==="number"&&a.e[1]>0&&a.e[1]<a.p?c.push("width:"+(a.p-a.e[1])+"px; padding-left:"+a.e[1]+"px;"):c.push("width:"+a.p+"px; text-align:center;")):c.push("height:"+a.h+"px; line-height:"+a.h+
"px; width:"+a.p+"px; text-align:center;");c.push("cursor:pointer; top:"+b.y+"px; left:"+b.x+"px; color:"+(a.M?a.M:"black")+"; position:absolute; font-size:"+(a.N?a.N:11)+"px; font-family:Arial,sans-serif; font-weight:bold");return c.join("")}window.MarkerClusterer=k;k.prototype.addMarker=k.prototype.q;k.prototype.addMarkers=k.prototype.C;k.prototype.clearMarkers=k.prototype.R;k.prototype.fitMapToMarkers=k.prototype.S;k.prototype.getCalculator=k.prototype.H;k.prototype.getGridSize=k.prototype.w;
k.prototype.getExtendedBounds=k.prototype.v;k.prototype.getMap=k.prototype.getMap;k.prototype.getMarkers=k.prototype.o;k.prototype.getMaxZoom=k.prototype.I;k.prototype.getStyles=k.prototype.z;k.prototype.getTotalClusters=k.prototype.U;k.prototype.getTotalMarkers=k.prototype.V;k.prototype.redraw=k.prototype.i;k.prototype.removeMarker=k.prototype.Y;k.prototype.removeMarkers=k.prototype.Z;k.prototype.resetViewport=k.prototype.m;k.prototype.repaint=k.prototype.L;k.prototype.setCalculator=k.prototype.$;
k.prototype.setGridSize=k.prototype.aa;k.prototype.setMaxZoom=k.prototype.ba;k.prototype.onAdd=k.prototype.onAdd;k.prototype.draw=k.prototype.draw;s.prototype.getCenter=s.prototype.getCenter;s.prototype.getSize=s.prototype.T;s.prototype.getMarkers=s.prototype.o;t.prototype.onAdd=t.prototype.onAdd;t.prototype.draw=t.prototype.draw;t.prototype.onRemove=t.prototype.onRemove;
})();

/**
 * jQuery Geocoding and Places Autocomplete Plugin - V 1.6.5
 *
 * @author Martin Kleppe <kleppe@ubilabs.net>, 2014
 * @author Ubilabs http://ubilabs.net, 2014
 * @license MIT License <http://www.opensource.org/licenses/mit-license.php>
 */// # $.geocomplete()
// ## jQuery Geocoding and Places Autocomplete Plugin
//
// * https://github.com/ubilabs/geocomplete/
// * by Martin Kleppe <kleppe@ubilabs.net>
(function(e,t,n,r){function u(t,n){this.options=e.extend(!0,{},i,n),this.input=t,this.$input=e(t),this._defaults=i,this._name="geocomplete",this.init()}var i={bounds:!0,country:null,map:!1,details:!1,detailsAttribute:"name",detailsScope:null,autoselect:!0,location:!1,mapOptions:{zoom:14,scrollwheel:!1,mapTypeId:"roadmap"},markerOptions:{draggable:!1},maxZoom:16,types:["geocode"],blur:!1,geocodeAfterResult:!1,restoreValueAfterBlur:!1},s="street_address route intersection political country administrative_area_level_1 administrative_area_level_2 administrative_area_level_3 colloquial_area locality sublocality neighborhood premise subpremise postal_code natural_feature airport park point_of_interest post_box street_number floor room lat lng viewport location formatted_address location_type bounds".split(" "),o="id place_id url website vicinity reference name rating international_phone_number icon formatted_phone_number".split(" ");e.extend(u.prototype,{init:function(){this.initMap(),this.initMarker(),this.initGeocoder(),this.initDetails(),this.initLocation()},initMap:function(){if(!this.options.map)return;if(typeof this.options.map.setCenter=="function"){this.map=this.options.map;return}this.map=new google.maps.Map(e(this.options.map)[0],this.options.mapOptions),google.maps.event.addListener(this.map,"click",e.proxy(this.mapClicked,this)),google.maps.event.addListener(this.map,"dragend",e.proxy(this.mapDragged,this)),google.maps.event.addListener(this.map,"idle",e.proxy(this.mapIdle,this)),google.maps.event.addListener(this.map,"zoom_changed",e.proxy(this.mapZoomed,this))},initMarker:function(){if(!this.map)return;var t=e.extend(this.options.markerOptions,{map:this.map});if(t.disabled)return;this.marker=new google.maps.Marker(t),google.maps.event.addListener(this.marker,"dragend",e.proxy(this.markerDragged,this))},initGeocoder:function(){var t=!1,n={types:this.options.types,bounds:this.options.bounds===!0?null:this.options.bounds,componentRestrictions:this.options.componentRestrictions};this.options.country&&(n.componentRestrictions={country:this.options.country}),this.autocomplete=new google.maps.places.Autocomplete(this.input,n),this.geocoder=new google.maps.Geocoder,this.map&&this.options.bounds===!0&&this.autocomplete.bindTo("bounds",this.map),google.maps.event.addListener(this.autocomplete,"place_changed",e.proxy(this.placeChanged,this)),this.$input.on("keypress."+this._name,function(e){if(e.keyCode===13)return!1}),this.options.geocodeAfterResult===!0&&this.$input.bind("keypress."+this._name,e.proxy(function(){event.keyCode!=9&&this.selected===!0&&(this.selected=!1)},this)),this.$input.bind("geocode."+this._name,e.proxy(function(){this.find()},this)),this.$input.bind("geocode:result."+this._name,e.proxy(function(){this.lastInputVal=this.$input.val()},this)),this.options.blur===!0&&this.$input.on("blur."+this._name,e.proxy(function(){if(this.options.geocodeAfterResult===!0&&this.selected===!0)return;this.options.restoreValueAfterBlur===!0&&this.selected===!0?setTimeout(e.proxy(this.restoreLastValue,this),0):this.find()},this))},initDetails:function(){function i(e){r[e]=t.find("["+n+"="+e+"]")}if(!this.options.details)return;if(this.options.detailsScope)var t=e(this.input).parents(this.options.detailsScope).find(this.options.details);else var t=e(this.options.details);var n=this.options.detailsAttribute,r={};e.each(s,function(e,t){i(t),i(t+"_short")}),e.each(o,function(e,t){i(t)}),this.$details=t,this.details=r},initLocation:function(){var e=this.options.location,t;if(!e)return;if(typeof e=="string"){this.find(e);return}e instanceof Array&&(t=new google.maps.LatLng(e[0],e[1])),e instanceof google.maps.LatLng&&(t=e),t&&(this.map&&this.map.setCenter(t),this.marker&&this.marker.setPosition(t))},destroy:function(){this.map&&(google.maps.event.clearInstanceListeners(this.map),google.maps.event.clearInstanceListeners(this.marker)),this.autocomplete.unbindAll(),google.maps.event.clearInstanceListeners(this.autocomplete),google.maps.event.clearInstanceListeners(this.input),this.$input.removeData(),this.$input.off(this._name),this.$input.unbind("."+this._name)},find:function(e){this.geocode({address:e||this.$input.val()})},geocode:function(t){if(!t.address)return;this.options.bounds&&!t.bounds&&(this.options.bounds===!0?t.bounds=this.map&&this.map.getBounds():t.bounds=this.options.bounds),this.options.country&&(t.region=this.options.country),this.geocoder.geocode(t,e.proxy(this.handleGeocode,this))},selectFirstResult:function(){var t="";e(".pac-item-selected")[0]&&(t="-selected");var n=e(".pac-container:last .pac-item"+t+":first span:nth-child(2)").text(),r=e(".pac-container:last .pac-item"+t+":first span:nth-child(3)").text(),i=n;return r&&(i+=" - "+r),this.$input.val(i),i},restoreLastValue:function(){this.lastInputVal&&this.$input.val(this.lastInputVal)},handleGeocode:function(e,t){if(t===google.maps.GeocoderStatus.OK){var n=e[0];this.$input.val(n.formatted_address),this.update(n),e.length>1&&this.trigger("geocode:multiple",e)}else this.trigger("geocode:error",t)},trigger:function(e,t){this.$input.trigger(e,[t])},center:function(e){e.viewport?(this.map.fitBounds(e.viewport),this.map.getZoom()>this.options.maxZoom&&this.map.setZoom(this.options.maxZoom)):(this.map.setZoom(this.options.maxZoom),this.map.setCenter(e.location)),this.marker&&(this.marker.setPosition(e.location),this.marker.setAnimation(this.options.markerOptions.animation))},update:function(e){this.map&&this.center(e.geometry),this.$details&&this.fillDetails(e),this.trigger("geocode:result",e)},fillDetails:function(t){var n={},r=t.geometry,i=r.viewport,s=r.bounds;e.each(t.address_components,function(t,r){var i=r.types[0];e.each(r.types,function(e,t){n[t]=r.long_name,n[t+"_short"]=r.short_name})}),e.each(o,function(e,r){n[r]=t[r]}),e.extend(n,{formatted_address:t.formatted_address,location_type:r.location_type||"PLACES",viewport:i,bounds:s,location:r.location,lat:r.location.lat(),lng:r.location.lng()}),e.each(this.details,e.proxy(function(e,t){var r=n[e];this.setDetail(t,r)},this)),this.data=n},setDetail:function(e,t){t===r?t="":typeof t.toUrlValue=="function"&&(t=t.toUrlValue()),e.is(":input")?e.val(t):e.text(t)},markerDragged:function(e){this.trigger("geocode:dragged",e.latLng)},mapClicked:function(e){this.trigger("geocode:click",e.latLng)},mapDragged:function(e){this.trigger("geocode:mapdragged",this.map.getCenter())},mapIdle:function(e){this.trigger("geocode:idle",this.map.getCenter())},mapZoomed:function(e){this.trigger("geocode:zoom",this.map.getZoom())},resetMarker:function(){this.marker.setPosition(this.data.location),this.setDetail(this.details.lat,this.data.location.lat()),this.setDetail(this.details.lng,this.data.location.lng())},placeChanged:function(){var e=this.autocomplete.getPlace();this.selected=!0;if(!e.geometry){if(this.options.autoselect){var t=this.selectFirstResult();this.find(t)}}else this.update(e)}}),e.fn.geocomplete=function(t){var n="plugin_geocomplete";if(typeof t=="string"){var r=e(this).data(n)||e(this).geocomplete().data(n),i=r[t];return typeof i=="function"?(i.apply(r,Array.prototype.slice.call(arguments,1)),e(this)):(arguments.length==2&&(i=arguments[1]),i)}return this.each(function(){var r=e.data(this,n);r||(r=new u(this,t),e.data(this,n,r))})}})(jQuery,window,document);


/**
 * @name InfoBox
 * @version 1.1.13 [March 19, 2014]
 * @author Gary Little (inspired by proof-of-concept code from Pamela Fox of Google)
 * @copyright Copyright 2010 Gary Little [gary at luxcentral.com]
 * @fileoverview InfoBox extends the Google Maps JavaScript API V3 <tt>OverlayView</tt> class.
 *  <p>
 *  An InfoBox behaves like a <tt>google.maps.InfoWindow</tt>, but it supports several
 *  additional properties for advanced styling. An InfoBox can also be used as a map label.
 *  <p>
 *  An InfoBox also fires the same events as a <tt>google.maps.InfoWindow</tt>.
 */

/*!
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *       http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
 
 function InfoBox(t){t=t||{},google.maps.OverlayView.apply(this,arguments),this.content_=t.content||"",this.disableAutoPan_=t.disableAutoPan||!1,this.maxWidth_=t.maxWidth||0,this.pixelOffset_=t.pixelOffset||new google.maps.Size(0,0),this.position_=t.position||new google.maps.LatLng(0,0),this.zIndex_=t.zIndex||null,this.boxClass_=t.boxClass||"infoBox",this.boxStyle_=t.boxStyle||{},this.closeBoxMargin_=t.closeBoxMargin||"2px",this.closeBoxURL_=t.closeBoxURL||"http://www.google.com/intl/en_us/mapfiles/close.gif",""===t.closeBoxURL&&(this.closeBoxURL_=""),this.infoBoxClearance_=t.infoBoxClearance||new google.maps.Size(1,1),"undefined"==typeof t.visible&&("undefined"==typeof t.isHidden?t.visible=!0:t.visible=!t.isHidden),this.isHidden_=!t.visible,this.alignBottom_=t.alignBottom||!1,this.pane_=t.pane||"floatPane",this.enableEventPropagation_=t.enableEventPropagation||!1,this.div_=null,this.closeListener_=null,this.moveListener_=null,this.contextListener_=null,this.eventListeners_=null,this.fixedWidthSet_=null}InfoBox.prototype=new google.maps.OverlayView,InfoBox.prototype.createInfoBoxDiv_=function(){var t,e,i,o=this,s=function(t){t.cancelBubble=!0,t.stopPropagation&&t.stopPropagation()},n=function(t){t.returnValue=!1,t.preventDefault&&t.preventDefault(),o.enableEventPropagation_||s(t)};if(!this.div_){if(this.div_=document.createElement("div"),this.setBoxStyle_(),"undefined"==typeof this.content_.nodeType?this.div_.innerHTML=this.getCloseBoxImg_()+this.content_:(this.div_.innerHTML=this.getCloseBoxImg_(),this.div_.appendChild(this.content_)),this.getPanes()[this.pane_].appendChild(this.div_),this.addClickHandler_(),this.div_.style.width?this.fixedWidthSet_=!0:0!==this.maxWidth_&&this.div_.offsetWidth>this.maxWidth_?(this.div_.style.width=this.maxWidth_,this.div_.style.overflow="auto",this.fixedWidthSet_=!0):(i=this.getBoxWidths_(),this.div_.style.width=this.div_.offsetWidth-i.left-i.right+"px",this.fixedWidthSet_=!1),this.panBox_(this.disableAutoPan_),!this.enableEventPropagation_){for(this.eventListeners_=[],e=["mousedown","mouseover","mouseout","mouseup","click","dblclick","touchstart","touchend","touchmove"],t=0;t<e.length;t++)this.eventListeners_.push(google.maps.event.addDomListener(this.div_,e[t],s));this.eventListeners_.push(google.maps.event.addDomListener(this.div_,"mouseover",function(t){this.style.cursor="default"}))}this.contextListener_=google.maps.event.addDomListener(this.div_,"contextmenu",n),google.maps.event.trigger(this,"domready")}},InfoBox.prototype.getCloseBoxImg_=function(){var t="";return""!==this.closeBoxURL_&&(t="<img",t+=" src='"+this.closeBoxURL_+"'",t+=" align=right",t+=" style='",t+=" position: relative;",t+=" cursor: pointer;",t+=" margin: "+this.closeBoxMargin_+";",t+="'>"),t},InfoBox.prototype.addClickHandler_=function(){var t;""!==this.closeBoxURL_?(t=this.div_.firstChild,this.closeListener_=google.maps.event.addDomListener(t,"click",this.getCloseClickHandler_())):this.closeListener_=null},InfoBox.prototype.getCloseClickHandler_=function(){var t=this;return function(e){e.cancelBubble=!0,e.stopPropagation&&e.stopPropagation(),google.maps.event.trigger(t,"closeclick"),t.close()}},InfoBox.prototype.panBox_=function(t){var e,i,o=0,s=0;if(!t&&(e=this.getMap(),e instanceof google.maps.Map)){e.getBounds().contains(this.position_)||e.setCenter(this.position_),i=e.getBounds();var n=e.getDiv(),h=n.offsetWidth,d=n.offsetHeight,l=this.pixelOffset_.width,r=this.pixelOffset_.height,a=this.div_.offsetWidth,p=this.div_.offsetHeight,_=this.infoBoxClearance_.width,f=this.infoBoxClearance_.height,v=this.getProjection().fromLatLngToContainerPixel(this.position_);if(v.x<-l+_?o=v.x+l-_:v.x+a+l+_>h&&(o=v.x+a+l+_-h),this.alignBottom_?v.y<-r+f+p?s=v.y+r-f-p:v.y+r+f>d&&(s=v.y+r+f-d):v.y<-r+f?s=v.y+r-f:v.y+p+r+f>d&&(s=v.y+p+r+f-d),0!==o||0!==s){{e.getCenter()}e.panBy(o,s)}}},InfoBox.prototype.setBoxStyle_=function(){var t,e;if(this.div_){this.div_.className=this.boxClass_,this.div_.style.cssText="",e=this.boxStyle_;for(t in e)e.hasOwnProperty(t)&&(this.div_.style[t]=e[t]);this.div_.style.WebkitTransform="translateZ(0)","undefined"!=typeof this.div_.style.opacity&&""!==this.div_.style.opacity&&(this.div_.style.MsFilter='"progid:DXImageTransform.Microsoft.Alpha(Opacity='+100*this.div_.style.opacity+')"',this.div_.style.filter="alpha(opacity="+100*this.div_.style.opacity+")"),this.div_.style.position="absolute",this.div_.style.visibility="hidden",null!==this.zIndex_&&(this.div_.style.zIndex=this.zIndex_)}},InfoBox.prototype.getBoxWidths_=function(){var t,e={top:0,bottom:0,left:0,right:0},i=this.div_;return document.defaultView&&document.defaultView.getComputedStyle?(t=i.ownerDocument.defaultView.getComputedStyle(i,""),t&&(e.top=parseInt(t.borderTopWidth,10)||0,e.bottom=parseInt(t.borderBottomWidth,10)||0,e.left=parseInt(t.borderLeftWidth,10)||0,e.right=parseInt(t.borderRightWidth,10)||0)):document.documentElement.currentStyle&&i.currentStyle&&(e.top=parseInt(i.currentStyle.borderTopWidth,10)||0,e.bottom=parseInt(i.currentStyle.borderBottomWidth,10)||0,e.left=parseInt(i.currentStyle.borderLeftWidth,10)||0,e.right=parseInt(i.currentStyle.borderRightWidth,10)||0),e},InfoBox.prototype.onRemove=function(){this.div_&&(this.div_.parentNode.removeChild(this.div_),this.div_=null)},InfoBox.prototype.draw=function(){this.createInfoBoxDiv_();var t=this.getProjection().fromLatLngToDivPixel(this.position_);this.div_.style.left=t.x+this.pixelOffset_.width+"px",this.alignBottom_?this.div_.style.bottom=-(t.y+this.pixelOffset_.height)+"px":this.div_.style.top=t.y+this.pixelOffset_.height+"px",this.isHidden_?this.div_.style.visibility="hidden":this.div_.style.visibility="visible"},InfoBox.prototype.setOptions=function(t){"undefined"!=typeof t.boxClass&&(this.boxClass_=t.boxClass,this.setBoxStyle_()),"undefined"!=typeof t.boxStyle&&(this.boxStyle_=t.boxStyle,this.setBoxStyle_()),"undefined"!=typeof t.content&&this.setContent(t.content),"undefined"!=typeof t.disableAutoPan&&(this.disableAutoPan_=t.disableAutoPan),"undefined"!=typeof t.maxWidth&&(this.maxWidth_=t.maxWidth),"undefined"!=typeof t.pixelOffset&&(this.pixelOffset_=t.pixelOffset),"undefined"!=typeof t.alignBottom&&(this.alignBottom_=t.alignBottom),"undefined"!=typeof t.position&&this.setPosition(t.position),"undefined"!=typeof t.zIndex&&this.setZIndex(t.zIndex),"undefined"!=typeof t.closeBoxMargin&&(this.closeBoxMargin_=t.closeBoxMargin),"undefined"!=typeof t.closeBoxURL&&(this.closeBoxURL_=t.closeBoxURL),"undefined"!=typeof t.infoBoxClearance&&(this.infoBoxClearance_=t.infoBoxClearance),"undefined"!=typeof t.isHidden&&(this.isHidden_=t.isHidden),"undefined"!=typeof t.visible&&(this.isHidden_=!t.visible),"undefined"!=typeof t.enableEventPropagation&&(this.enableEventPropagation_=t.enableEventPropagation),this.div_&&this.draw()},InfoBox.prototype.setContent=function(t){this.content_=t,this.div_&&(this.closeListener_&&(google.maps.event.removeListener(this.closeListener_),this.closeListener_=null),this.fixedWidthSet_||(this.div_.style.width=""),"undefined"==typeof t.nodeType?this.div_.innerHTML=this.getCloseBoxImg_()+t:(this.div_.innerHTML=this.getCloseBoxImg_(),this.div_.appendChild(t)),this.fixedWidthSet_||(this.div_.style.width=this.div_.offsetWidth+"px","undefined"==typeof t.nodeType?this.div_.innerHTML=this.getCloseBoxImg_()+t:(this.div_.innerHTML=this.getCloseBoxImg_(),this.div_.appendChild(t))),this.addClickHandler_()),google.maps.event.trigger(this,"content_changed")},InfoBox.prototype.setPosition=function(t){this.position_=t,this.div_&&this.draw(),google.maps.event.trigger(this,"position_changed")},InfoBox.prototype.setZIndex=function(t){this.zIndex_=t,this.div_&&(this.div_.style.zIndex=t),google.maps.event.trigger(this,"zindex_changed")},InfoBox.prototype.setVisible=function(t){this.isHidden_=!t,this.div_&&(this.div_.style.visibility=this.isHidden_?"hidden":"visible")},InfoBox.prototype.getContent=function(){return this.content_},InfoBox.prototype.getPosition=function(){return this.position_},InfoBox.prototype.getZIndex=function(){return this.zIndex_},InfoBox.prototype.getVisible=function(){var t;return t="undefined"==typeof this.getMap()||null===this.getMap()?!1:!this.isHidden_},InfoBox.prototype.show=function(){this.isHidden_=!1,this.div_&&(this.div_.style.visibility="visible")},InfoBox.prototype.hide=function(){this.isHidden_=!0,this.div_&&(this.div_.style.visibility="hidden")},InfoBox.prototype.open=function(t,e){var i=this;e&&(this.position_=e.getPosition(),this.moveListener_=google.maps.event.addListener(e,"position_changed",function(){i.setPosition(this.getPosition())})),this.setMap(t),this.div_&&this.panBox_()},InfoBox.prototype.close=function(){var t;if(this.closeListener_&&(google.maps.event.removeListener(this.closeListener_),this.closeListener_=null),this.eventListeners_){for(t=0;t<this.eventListeners_.length;t++)google.maps.event.removeListener(this.eventListeners_[t]);this.eventListeners_=null}this.moveListener_&&(google.maps.event.removeListener(this.moveListener_),this.moveListener_=null),this.contextListener_&&(google.maps.event.removeListener(this.contextListener_),this.contextListener_=null),this.setMap(null)};