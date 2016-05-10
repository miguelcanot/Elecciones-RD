	<style>
		
	</style>
	<script>
//	window.onbeforeunload = function () {
		//alert("se va");
		//return "Ha ejecutado una accion que produce el cierre de esta pagina, esta de acuerdo? \n Si no entiende lo que dice este mensaje, por favor presione CANCELAR";
	//}
	
	/* Global var for counter */
	var giCount = 0;

	
	
	function refrescar(){
		location.reload(true);
	}	
	
	$(document).ready(function() {
		var tips = $( "#validateTips" );
		$('#users-contain').html( '<table cellpadding="0" cellspacing="0" border="0" class="display ui-widget ui-widget-content" id="users"></table>' );
		$('#users').dataTable( {
			"aaData": [
				/* Reduced data set */
				
			],
			"aoColumns": [
				{ "sTitle": "<?php echo Texto::idioma("ID", IDIOMA);?>" },
				{ "sTitle": "<?php echo Texto::idioma("Nombre", IDIOMA);?>" },
				{ "sTitle": "<?php echo Texto::idioma("Cedula", IDIOMA);?>" },
				{ "sTitle": "<?php echo Texto::idioma("Limite_Credito", IDIOMA);?>" },
				{ "sTitle": "<?php echo Texto::idioma("Telefono", IDIOMA);?> 1", "sClass": "center" },
				{ "sTitle": "<?php echo Texto::idioma("Celular", IDIOMA);?> 1", "sClass": "center" },
				{ "sTitle": "<?php echo Texto::idioma("Correo", IDIOMA);?>", "sClass": "center" },
				{ "sTitle": "<?php echo Texto::idioma("", IDIOMA);?>", "sClass": "center" },
				{ "sTitle": "<?php echo Texto::idioma("", IDIOMA);?>", "sClass": "center" }
			]
		} );	
	} );
	
	var modificacion = false;
	
	function print_r (array, return_val) {
	    var output = '',
	        pad_char = ' ',
	        pad_val = 4,
	        d = this.window.document,
	        getFuncName = function (fn) {
	            var name = (/\W*function\s+([\w\$]+)\s*\(/).exec(fn);
	            if (!name) {
	                return '(Anonymous)';
	            }
	            return name[1];
	        },
	        repeat_char = function (len, pad_char) {
	            var str = '';
	            for (var i = 0; i < len; i++) {
	                str += pad_char;
	            }
	            return str;
	        },
	        formatArray = function (obj, cur_depth, pad_val, pad_char) {
	            if (cur_depth > 0) {
	                cur_depth++;
	            }
	 
	            var base_pad = repeat_char(pad_val * cur_depth, pad_char);
	            var thick_pad = repeat_char(pad_val * (cur_depth + 1), pad_char);
	            var str = '';
	 
	            if (typeof obj === 'object' && obj !== null && obj.constructor && getFuncName(obj.constructor) !== 'PHPJS_Resource') {
	                str += 'Array\n' + base_pad + '(\n';
	                for (var key in obj) {
	                    if (Object.prototype.toString.call(obj[key]) === '[object Array]') {
	                        str += thick_pad + '[' + key + '] => ' + formatArray(obj[key], cur_depth + 1, pad_val, pad_char);
	                    }
	                    else {
	                        str += thick_pad + '[' + key + '] => ' + obj[key] + '\n';
	                    }
	                }
	                str += base_pad + ')\n';
	            }
	            else if (obj === null || obj === undefined) {
	                str = '';
	            }
	            else { // for our "resource" class
	                str = obj.toString();
	            }
	 
	            return str;
	        };
	 
	    output = formatArray(array, 0, pad_val, pad_char); 
	    if (return_val !== true) {
	        if (d.body) {
	            this.echo(output);
	        }
	        else {
	            try {
	                d = XULDocument; // We're in XUL, so appending as plain text won't work; trigger an error out of XUL
	                this.echo('<pre xmlns="http://www.w3.org/1999/xhtml" style="white-space:pre;">' + output + '</pre>');
	            } catch (e) {
	                this.echo(output); // Outputting as plain text may work in some plain XML
	            }
	        }
	        return true;
	    }
	    return output;
	}

	function updateTips( t ) {
		tips.text( t ).addClass( "ui-state-highlight" );
		setTimeout(function() {
			tips.removeClass( "ui-state-highlight", 5500 );
		}, 500 );
	}

	function checkLength( o, n, min, max ) {
		if ( o.val().length > max || o.val().length < min ) {
			o.addClass( "ui-state-error" );
			updateTips( "Length of " + n + " must be between " +
				min + " and " + max + "." );
			return false;
		} else {
			return true;
		}
	}

	function checkRegexp( o, regexp, n ) {
		if ( !( regexp.test( o.val() ) ) ) {
			o.addClass( "ui-state-error" );
			updateTips( n );
			return false;
		} else {
			return true;
		}
	}


	
	$(function(){
		$(".calendario").datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, changeMonth: true,yearRange: '1930:1995'  });
		
		//Mask
		//$('#txtLimiteCredito').mask("9999999");
		$('#txtCedula').mask("999-9999999-9");
		$('#txtTelefono1').mask("999-999-9999");
		$('#txtTelefono2').mask("999-999-9999");
		$('#txtCelular1').mask("999-999-9999");
		$('#txtCelular2').mask("999-999-9999"); 


		$('#txtCedulaGarante').mask("999-9999999-9");
		$('#txtTelefono1Garante').mask("999-999-9999");
		$('#txtTelefono2Garante').mask("999-999-9999");
		$('#txtCelular1Garante').mask("999-999-9999");
		$('#txtCelular2Garante').mask("999-999-9999");


		$('#txtTelefonoRP').mask("999-999-9999");
		$('#txtCelularRP').mask("999-999-9999");
		$('#txtTelefonoRF').mask("999-999-9999");
		$('#txtCelularRF').mask("999-999-9999");
		// Tabs
		$('#tabs').tabs();

		//General Dialog
		$( "#infoGeneral" ).dialog({
			autoOpen: false,
			resizable: false,
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		
		
		// Dialog
		$('#infoEliminar').dialog({
			autoOpen: false,
			modal: true,
			width: 600,
			buttons: {
				"Ok": function() {
					eliminarCliente($("#txtIdSecundario").val(), $("#txtIdFila").val(), true);
					$(this).dialog("close");
				},
				"Cancel": function() {
					$(this).dialog("close");
					$("#txtIdSecundario").val("");
				}
			}
		});

		$( "#infoAlEliminar" ).dialog({
			autoOpen: false,
			resizable: false,
			modal: true,
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
	function informacion(objeto) {
		alert(print_r(objeto), true);
	}

	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		var nombre = $( "#txtNombre" ),
			apellido = $( "#txtApellido" ),
			cedula = $( "#txtCedula" ),
			apodo = $( "#txtApodo" ),
			correo = $( "#txtCorreo" ),
			usuario = "",//$( "#txtUsuario" ),
			clave = "",//$( "#txtClave" ),
			limiteCredito = $( "#txtLimiteCredito" ),
			sexo = $( "#drpdSexo" ),
			calle = $( "#txtCalle" ),
			numero = $( "#txtNumero" ),
			barrio = $( "#txtBarrio" ),
			provincia = $( "#drpdProvincia" ),
			direccionVivienda = $( "#txtDireccionVivienda" ),
			direccionNegocio = $( "#txtDireccionNegocio" ),
			ubicacion = $( "#txtUbicacion" ),
			telefono1 = $( "#txtTelefono1" ),
			telefono2 = $( "#txtTelefono2" ),
			celular1 = $( "#txtCelular1" ),
			celular2 = $( "#txtCelular2" ),
			estadoCivil = $( "#drpdEstadoCivil" ),
			nacionalidad = $( "#drpdNacionalidad" ),
			ocupacion = $( "#txtOcupacion" ),
			fechaNacimiento = $( "#txtFechaNacimiento" ),
			banco = $( "#drpdBanco" ),
			tipoCuenta = $( "#drpdTipoCuenta" ),
			numeroCuenta = $( "#txtNumeroCuenta" ),
			nombreGarante = $( "#txtNombreGarante" ),
			apellidoGarante = $( "#txtApellidoGarante" ),
			cedulaGarante = $( "#txtCedulaGarante" ),
			apodoGarante = $( "#txtApodoGarante" ),
			correoGarante = $( "#txtCorreoGarante" ),
			sexoGarante = $( "#drpdSexoGarante" ),
			calleGarante = $( "#txtCalleGarante" ),
			numeroGarante = $( "#txtNumeroGarante" ),
			barrioGarante = $( "#txtBarrioGarante" ),
			provinciaGarante = $( "#drpdProvinciaGarante" ),
			direccionViviendaGarante = $( "#txtDireccionViviendaGarante" ),
			direccionNegocioGarante = $( "#txtDireccionNegocioGarante" ),
			ubicacionGarante = $( "#txtUbicacionGarante" ),
			telefono1Garante = $( "#txtTelefono1Garante" ),
			telefono2Garante = $( "#txtTelefono2Garante" ),
			celular1Garante = $( "#txtCelular1Garante" ),
			celular2Garante = $( "#txtCelular2Garante" ),
			estadoCivilGarante = $( "#drpdEstadoCivilGarante" ),
			nacionalidadGarante = $( "#drpdNacionalidadGarante" ),
			ocupacionGarante = $( "#txtOcupacionGarante" ),
			fechaNacimientoGarante = $( "#txtFechaNacimientoGarante" ),
			parentesco = $( "#drpdParentescoGarante" ),
			ingreso = $( "#txtIngreso" ),
			tipoEmpleoDL = $( "#drpdTipoEmpleoDL" ),
			empleoDL = $( "#txtEmpleoDL" ),
			cargoDL = $( "#txtCargoDL" ),
			direccionTrabajoDL = $( "#txtDireccionTrabajoDL" ),
			ingresoMesDL = $( "#txtIngresoMesDL" ),
			tiempoTrabajoDL = $( "#drpdTiempoTrabajoDL" ),
			otroIngresoDL = $( "#txtOtroIngresoDL" ),
			nombreRF = $( "#txtNombreRF" ),
			telefonoRF = $( "#txtTelefonoRF" ),
			celularRF = $( "#txtCelularRF" ),
			direccionRF = $( "#txtDireccionRF" ),
			parentescoRF = $( "#txtParentescoRF" ),
			nombreRP = $( "#txtNombreRP" ),
			telefonoRP = $( "#txtTelefonoRP" ),
			celularRP = $( "#txtCelularRP" ),
			direccionRP = $( "#txtDireccionRP" ),
			tipoRelacionRP = $( "#drpdTipoRelacionRP" ),							
			allFields = $( [] ).add( nombre ).add( apellido ).add( cedula ).add( apodo ).add( correo ).add( usuario ).add( clave ).add( limiteCredito ).add( sexo )
			.add( calle ).add( numero ).add( barrio ).add( provincia ).add( direccionVivienda ).add( direccionNegocio ).add( ubicacion ).add( telefono1 ).add( telefono2 )
			.add( celular1 ).add( celular2 ).add( estadoCivil ).add( nacionalidad ).add( ocupacion ).add( fechaNacimiento ).add( banco ).add( tipoCuenta ).add( numeroCuenta )
			.add( nombreGarante ).add( apellidoGarante ).add( cedulaGarante ).add( apodoGarante ).add( correoGarante ).add( sexoGarante )
			.add( calleGarante ).add( numeroGarante ).add( barrioGarante ).add( provinciaGarante ).add( direccionViviendaGarante ).add( direccionNegocioGarante ).add( ubicacionGarante ).add( telefono1Garante ).add( telefono2Garante )
			.add( celular1Garante ).add( celular2Garante ).add( estadoCivilGarante ).add( nacionalidadGarante ).add( ocupacionGarante ).add( fechaNacimientoGarante ).add( parentesco ).add( ingreso )
			.add(tipoEmpleoDL).add(empleoDL).add(cargoDL).add(direccionTrabajoDL).add(ingresoMesDL).add(tiempoTrabajoDL).add(otroIngresoDL)
			.add(nombreRF).add(telefonoRF).add(celularRF).add(direccionRF).add(parentescoRF)
			.add(nombreRP).add(telefonoRP).add(celularRP).add(direccionRP).add(tipoRelacionRP);
			

		
		
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 730,
			width: 840,
			modal: true,
			buttons: {
				"<?php echo Texto::idioma('Guardar', IDIOMA);?>": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
					bValid = bValid && checkLength( nombre, "<?php echo Texto::idioma('Nombre', IDIOMA);?>", 3, 40 );
					bValid = bValid && checkLength( apellido, "<?php echo Texto::idioma('Apellido', IDIOMA);?>", 3, 40 );
					bValid = bValid && checkLength( cedula, "<?php echo Texto::idioma('Cedula', IDIOMA);?>", 11, 13 );
					bValid = bValid && checkLength( apodo, "<?php echo Texto::idioma('Apodo', IDIOMA);?>", 0, 20 );
					bValid = bValid && checkLength( correo, "<?php echo Texto::idioma('Correo', IDIOMA);?>", 0, 50 );
					//bValid = bValid && checkLength( usuario, "<?php echo Texto::idioma('Usuario', IDIOMA);?>", 3, 16 );
					//bValid = bValid && checkLength( clave, "<?php echo Texto::idioma('Clave', IDIOMA);?>", 3, 16 );
					//bValid = bValid && checkLength( limiteCredito, "<?php echo Texto::idioma('Limite_Credito', IDIOMA);?>", 1, 9 );
					bValid = bValid && checkLength( calle, "<?php echo Texto::idioma('Calle', IDIOMA);?>", 0, 90 );
					bValid = bValid && checkLength( numero, "<?php echo Texto::idioma('Numero', IDIOMA);?>", 0, 5 );
					bValid = bValid && checkLength( barrio, "<?php echo Texto::idioma('Barrio', IDIOMA);?>", 0, 90 );
					bValid = bValid && checkLength( direccionVivienda, "<?php echo Texto::idioma('Direccion_Vivienda', IDIOMA);?>", 0, 90 );
					bValid = bValid && checkLength( direccionNegocio, "<?php echo Texto::idioma('Direccion_Negocio', IDIOMA);?>", 0, 90 );
					bValid = bValid && checkLength( ubicacion, "<?php echo Texto::idioma('Ubicacixn', IDIOMA);?>", 0, 90 );
					bValid = bValid && checkLength( telefono1, "<?php echo Texto::idioma('Telefono', IDIOMA);?> 1", 0, 12 );
					bValid = bValid && checkLength( telefono2, "<?php echo Texto::idioma('Telefono', IDIOMA);?> 2", 0, 12 );
					bValid = bValid && checkLength( celular1, "<?php echo Texto::idioma('Celular', IDIOMA);?> 1", 0, 12 );
					bValid = bValid && checkLength( celular2, "<?php echo Texto::idioma('Celular', IDIOMA);?> 2", 0, 12 );
					bValid = bValid && checkLength( ocupacion, "<?php echo Texto::idioma('Ocupacion', IDIOMA);?>", 0, 20 );
					bValid = bValid && checkLength( fechaNacimiento, "<?php echo Texto::idioma('Fecha_Nacimiento', IDIOMA);?>", 0, 10 );

					

					bValid = bValid && checkRegexp( nombre, /^[a-z]([0-9a-z_])+$/i, "Nombre may consist of a-z, 0-9, underscores, begin with a letter." );
					bValid = bValid && checkRegexp( apellido, /^[a-z]([0-9a-z_])+$/i, "Apellido may consist of a-z, 0-9, underscores, begin with a letter." );
					bValid = bValid && checkRegexp( cedula, /^[0-9-]+$/i, "Cedula may consist of a-z, 0-9, underscores, begin with a letter." );
					//bValid = bValid && checkRegexp( apodo, /^[a-z]([0-9a-z_])+$/i, "Apodo may consist of a-z, 0-9, underscores, begin with a letter." );
					bValid = bValid && checkRegexp( correo, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. nombre@dominio.com" );
					//bValid = bValid && checkRegexp( usuario, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
					//bValid = bValid && checkRegexp( clave, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
					//bValid = bValid && checkRegexp( limiteCredito, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
					//bValid = bValid && checkRegexp( calle, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
					//bValid = bValid && checkRegexp( numero, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
					//bValid = bValid && checkRegexp( barrio, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
					//bValid = bValid && checkRegexp( direccionVivienda, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
					//bValid = bValid && checkRegexp( direccionNegocio, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
					//bValid = bValid && checkRegexp( ubicacion, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
					//bValid = bValid && checkRegexp( telefono1, /^([0-9-])+$/, "Password field only allow : a-z 0-9" );
					//bValid = bValid && checkRegexp( telefono2, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
					//bValid = bValid && checkRegexp( limiteCredito, /^[0-9]+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
					// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
					
					//bValid = bValid && checkRegexp( clave, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );

					if ( bValid ) {
						if (modificacion) {
							//var cliente = {"id":$( "#txtIdCliente" ).val(),"nombre":nombre.val(), "apellido":apellido.val(), "cedula":cedula.val(), "apodo":apodo.val(), "correo":correo.val(), "usuario":usuario.val(), "clave":clave.val(), "limiteCredito":limiteCredito.val(), "sexo":sexo.val(), "calle":calle.val(), "numero":numero.val(), "barrio":barrio.val(), "provincia":provincia.val(), "direccionVivienda":direccionVivienda.val(), "direccionNegocio":direccionNegocio.val(), "ubicacion":ubicacion.val(), "telefono1":telefono1.val(), "telefono2":telefono2.val(), "celular1":celular1.val(), "celular2":celular2.val(), "estadoCivil":estadoCivil.val(), "nacionalidad":nacionalidad.val(), "ocupacion":ocupacion.val()};
							var cliente = {"id":$( "#txtIdCliente" ).val(),"nombre":nombre.val(), "apellido":apellido.val(), "cedula":cedula.val(), "apodo":apodo.val(), "correo":correo.val(), "usuario":usuario, "clave":clave, "limiteCredito":limiteCredito.val(), "sexo":sexo.val(), "calle":calle.val(), "numero":numero.val(), "barrio":barrio.val(), "provincia":provincia.val(), "direccionVivienda":direccionVivienda.val(), "direccionNegocio":direccionNegocio.val(), "ubicacion":ubicacion.val(), "telefono1":telefono1.val(), "telefono2":telefono2.val(), "celular1":celular1.val(), "celular2":celular2.val(), "estadoCivil":estadoCivil.val(), "nacionalidad":nacionalidad.val(), "ocupacion":ocupacion.val(), "fechaNacimiento":fechaNacimiento.val(), "banco":banco.val(), "tipoCuenta":tipoCuenta.val(), "numeroCuenta":numeroCuenta.val(), "tipoEmpleoDL":tipoEmpleoDL.val(), "empleoDL":empleoDL.val(), "cargoDL":cargoDL.val(), "direccionTrabajoDL":direccionTrabajoDL.val(), "ingresoMesDL":ingresoMesDL.val(), "tiempoTrabajoDL":tiempoTrabajoDL.val(), "otroIngresoDL":otroIngresoDL.val(), "nombreRF":nombreRF.val(), "telefonoRF":telefonoRF.val(), "celularRF":celularRF.val(), "direccionRF":direccionRF.val(), "parentescoRF":parentescoRF.val(), "nombreRP":nombreRP.val(), "telefonoRP":telefonoRP.val(), "celularRP":celularRP.val(), "direccionRP":direccionRP.val(), "tipoRelacionRP":tipoRelacionRP.val()};
							guardarCambioCliente(cliente, $("#txtIdFila").val());
							//$( this ).dialog( "close" );
							//refrescar();
						} else {
							var cliente = {"nombre":nombre.val(), "apellido":apellido.val(), "cedula":cedula.val(), "apodo":apodo.val(), "correo":correo.val(), "usuario":usuario, "clave":clave, "limiteCredito":limiteCredito.val(), "sexo":sexo.val(), "calle":calle.val(), "numero":numero.val(), "barrio":barrio.val(), "provincia":provincia.val(), "direccionVivienda":direccionVivienda.val(), "direccionNegocio":direccionNegocio.val(), "ubicacion":ubicacion.val(), "telefono1":telefono1.val(), "telefono2":telefono2.val(), "celular1":celular1.val(), "celular2":celular2.val(), "estadoCivil":estadoCivil.val(), "nacionalidad":nacionalidad.val(), "ocupacion":ocupacion.val(), "fechaNacimiento":fechaNacimiento.val(), "banco":banco.val(), "tipoCuenta":tipoCuenta.val(), "numeroCuenta":numeroCuenta.val(), "tipoEmpleoDL":tipoEmpleoDL.val(), "empleoDL":empleoDL.val(), "cargoDL":cargoDL.val(), "direccionTrabajoDL":direccionTrabajoDL.val(), "ingresoMesDL":ingresoMesDL.val(), "tiempoTrabajoDL":tiempoTrabajoDL.val(), "otroIngresoDL":otroIngresoDL.val(), "nombreRF":nombreRF.val(), "telefonoRF":telefonoRF.val(), "celularRF":celularRF.val(), "direccionRF":direccionRF.val(), "parentescoRF":parentescoRF.val(), "nombreRP":nombreRP.val(), "telefonoRP":telefonoRP.val(), "celularRP":celularRP.val(), "direccionRP":direccionRP.val(), "tipoRelacionRP":tipoRelacionRP.val()};
							var garante = {"nombre":nombreGarante.val(), "apellido":apellidoGarante.val(), "cedula":cedulaGarante.val(), "apodo":apodoGarante.val(), "correo":correoGarante.val(), "sexo":sexoGarante.val(), "calle":calleGarante.val(), "numero":numeroGarante.val(), "barrio":barrioGarante.val(), "provincia":provinciaGarante.val(), "direccionVivienda":direccionViviendaGarante.val(), "direccionNegocio":direccionNegocioGarante.val(), "ubicacion":ubicacionGarante.val(), "telefono1":telefono1Garante.val(), "telefono2":telefono2Garante.val(), "celular1":celular1Garante.val(), "celular2":celular2Garante.val(), "estadoCivil":estadoCivilGarante.val(), "nacionalidad":nacionalidadGarante.val(), "ocupacion":ocupacionGarante.val(), "fechaNacimiento":fechaNacimientoGarante.val(), "parentesco":parentesco.val(), "ingreso":ingreso.val()};
							crearCliente(cliente, garante);
							$( this ).dialog( "close" );
							refrescar(); 
						}
						
					}
				},
				<?php echo Texto::idioma('Cancelar', IDIOMA);?>: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});

		$( "#create-user" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
				modificacion = false;
				$( "#txtIdCliente" ).val("");
			});

		$( "#refrescar" )
		.button()
		.click(function() {
			refrescar();
			modificacion = false;
			$( "#txtIdCliente" ).val("");
		});

		obtenerCliente();
	});

	
	function refrescar2() {
		$('#users-contain').html( '<table cellpadding="0" cellspacing="0" border="0" class="display ui-widget ui-widget-content" id="users"></table>' );
		$('#users').dataTable( {
			"aaData": [
				/* Reduced data set */
				
			],
			"aoColumns": [
				{ "sTitle": "<?php echo Texto::idioma("ID", IDIOMA);?>" },
				{ "sTitle": "<?php echo Texto::idioma("Nombre", IDIOMA);?>" },
				{ "sTitle": "<?php echo Texto::idioma("Cedula", IDIOMA);?>" },
				{ "sTitle": "<?php echo Texto::idioma("Limite_Credito", IDIOMA);?>" },
				{ "sTitle": "<?php echo Texto::idioma("Telefono", IDIOMA);?> 1", "sClass": "center" },
				{ "sTitle": "<?php echo Texto::idioma("Celular", IDIOMA);?> 1", "sClass": "center" },
				{ "sTitle": "<?php echo Texto::idioma("Correo", IDIOMA);?>", "sClass": "center" },
				{ "sTitle": "<?php echo Texto::idioma("", IDIOMA);?>", "sClass": "center" },
				{ "sTitle": "<?php echo Texto::idioma("", IDIOMA);?>", "sClass": "center" }
			]
		} );	
		obtenerCliente();
	}

	function obtenerCliente() {
		giCount = 0;
		direccion = '<?php echo HOST."usuario/obtenerClienteIdUsuario/";?>';	
		$.getJSON(direccion, function(data) {
			$.each(data, function(position, value) {
				agregarCliente({"id":value["id"],"nombre":value['nombre'], "apellido":value['apellido'], "cedula":value['cedula'], "limiteCredito":value['limiteCredito'], "telefono1":value['telefono1'], "celular1":value['celular1'], "correo":value['correo']});
			});
		});
	}

	function crearCliente(cliente, garante) {
		var direccion = '<?php echo HOST."usuario/crearCliente/";?>';
		var listadoRegistro = new Array();
		var id = 0;
		listadoRegistro.push(cliente);
		listadoRegistro.push(garante);
		$.post(direccion, {listado:listadoRegistro}, function(data) {
			$('#pInformacion').html('<?php echo Texto::idioma("Cliente_Creado", IDIOMA);?>');
			$('#infoGeneral').dialog('open');
			agregarCliente({"id":data,"nombre":cliente['nombre'], "apellido":cliente['apellido'], "cedula":cliente['cedula'], "limiteCredito":cliente['limiteCredito'], "telefono1":cliente['telefono1'], "celular1":cliente['celular1'], "correo":cliente['correo'], "fechaNacimiento":cliente['fechaNacimiento']});
		}, "json");	
	}

	function guardarCambioCliente(cliente, idFila) {
		var direccion = '<?php echo HOST."usuario/modificarCliente/";?>';
		var listadoRegistro = new Array();
		var id = 0;
		$("#txtIdFila").val(idFila);
		listadoRegistro.push(cliente);
		$.post(direccion, {listado:listadoRegistro}, function(data) {
			$('#pInformacion').html('<?php echo Texto::idioma("Cliente_Modificado", IDIOMA);?>');
			var oTable = $('#users').dataTable( );
			oTable.fnUpdate( cliente["nombre"] + " " + cliente["apellido"], idFila, 1);
			oTable.fnUpdate( cliente["cedula"], idFila, 2);
			oTable.fnUpdate( cliente["limiteCredito"], idFila, 3);
			oTable.fnUpdate( cliente["telefono1"], idFila, 4);
			oTable.fnUpdate( cliente["celular1"], idFila, 5);
			oTable.fnUpdate( cliente["correo"], idFila, 6);
			$('#infoGeneral').dialog('open');
		}, "json");	
	}

	function modificarCliente(idCliente, idFila) {
		$("#txtIdFila").val(idFila);
		direccion = '<?php echo HOST."usuario/obtenerClienteIdCliente/";?>';	
		$.getJSON(direccion+idCliente, function(dataUser) {
			modificacion = true;
			var data = dataUser[0];
			var dataDL = dataUser[1];
			var dataRP = dataUser[2];
			var dataRF = dataUser[3];
			$( "#txtIdCliente" ).val(data['id']);
			$( "#txtNombre" ).val(data['nombre']);
			$( "#txtApellido" ).val(data['apellido']);
			$( "#txtCedula" ).val(data['cedula']);
			$( "#txtApodo" ).val(data['apodo']);
			$( "#txtCorreo" ).val(data['correo']);
			$( "#txtUsuario" ).val(data['usuario']);
			$( "#txtClave" ).val(data['clave']);
			$( "#txtLimiteCredito" ).val(data['limiteCredito']);
			$( "#drpdSexo" ).attr("value",data['sexo']);
			$( "#txtCalle" ).val(data['calle']);
			$( "#txtNumero" ).val(data['numero']);
			$( "#txtBarrio" ).val(data['barrio']);
			$( "#drpdProvincia" ).attr("value", data['provincia']);
			$( "#txtDireccionVivienda" ).val(data['direccionVivienda']);
			$( "#txtDireccionNegocio" ).val(data['direccionNegocio']);
			$( "#txtUbicacion" ).val(data['ubicacion']);
			$( "#txtTelefono1" ).val(data['telefono1']);
			$( "#txtTelefono2" ).val(data['telefono2']);
			$( "#txtCelular1" ).val(data['celular1']);
			$( "#txtCelular2" ).val(data['celular2']);
			$( "#drpdEstadoCivil" ).attr("value", data['estadoCivil']);
			$( "#drpdNacionalidad" ).attr("value", data['nacionalidad']);
			$( "#txtOcupacion" ).val(data['ocupacion']);
			$( "#txtFechaNacimiento" ).val(data['fechaNacimiento']);
			$( "#txtNumeroCuenta" ).val(data['numeroCuenta']);
			$( "#drpdBanco" ).attr("value", data['banco']);
			$( "#drpdTipoCuenta" ).attr("value", data['tipoCuenta']);


			$( "#txtEmpleoDL" ).val(dataDL['empleo']);
			$( "#txtCargoDL" ).val(dataDL['cargo']);
			$( "#txtDireccionTrabajoDL" ).val(dataDL['direccionTrabajo']);
			$( "#txtIngresoMesDL" ).val(dataDL['ingresoMes']);
			$( "#txtOtroIngresoDL" ).val(dataDL['otroIngreso']);
			$( "#drpdTipoEmpleoDL" ).attr("value", dataDL['tipoEmpleo']);
			$( "#drpdTiempoTrabajoDL" ).attr("value", dataDL['tiempoTrabajo']);

			$( "#txtNombreRP" ).val(dataRP['nombre']);
			$( "#txtTelefonoRP" ).val(dataRP['telefono']);
			$( "#txtCelularRP" ).val(dataRP['celular']);
			$( "#txtDireccionRP" ).val(dataRP['direccion']);
			$( "#drpdTipoRelacionRP" ).attr("value", dataRP['tipoRelacion']);

			$( "#txtNombreRF" ).val(dataRF['nombre']);
			$( "#txtTelefonoRF" ).val(dataRF['telefono']);
			$( "#txtCelularRF" ).val(dataRF['celular']);
			$( "#txtDireccionRF" ).val(dataRF['direccion']);
			$( "#txtParentescoRF" ).val(dataRF['parentesco']);

			
			$( "#dialog-form" ).dialog( "open" );
		});
		
	}

	function eliminarCliente(idCliente, idFila, validador) {
		$("#txtIdSecundario").val(idCliente);
		$("#txtIdFila").val(idFila);
		$('#infoEliminar').dialog('open');
		if (validador) {
			var direccion = '<?php echo HOST."usuario/eliminarcliente/";?>';
			var registro = new Array();
			var cliente = {"idCliente":idCliente};
			registro.push(cliente);
			$.post(direccion, {listado:registro}, function(data) {
				if (data) {
					$('#pInformacion').html('<?php echo Texto::idioma("Cliente_Eliminado", IDIOMA);?>');
					$('#infoGeneral').dialog('open');
					var oTable = $('#users').dataTable( );
					oTable.fnDeleteRow(idFila);
					//obtenerCliente();
					//$('#trCliente'+idCliente).remove();
				} else {
					alert("Error");
				}
			}, "json");	
		}
		
		//var a = 
		
		//return false;
	}
	

	function agregarCliente(cliente) {
		var modificar = "<a href='javascript:modificarCliente("+cliente['id']+", "+giCount+");'><img title='<?php echo Texto::idioma("Modificar", IDIOMA);?>' src='<?php echo IMAGE."modificar.png";?>'></a>";
		var eliminar = "<a href='javascript:eliminarCliente("+cliente['id']+", "+giCount+", false);'><img title='<?php echo Texto::idioma("Eliminar", IDIOMA);?>' src='<?php echo IMAGE."eliminar.png";?>'></a>";
		$('#users').dataTable().fnAddData( [
											cliente['id'],
		                        			cliente['nombre'] + " " + cliente['apellido'],
		                        			cliente['cedula'],
		                        			cliente['limiteCredito'],
		                        			cliente['telefono1'],
		                        			cliente['celular1'],
		                        			cliente['correo'],
		            						modificar,
		            						eliminar
		                        			] );
		giCount++;
	}
	</script>

<div id="welcom_pan">
	<h2><?php echo Texto::idioma("Administrar_Cliente", IDIOMA);?></h2> 
</div>
<div id="divFuncion">
	<img id="create-user" title="<?php echo Texto::idioma("Crear_Cliente", IDIOMA);?>" src="<?php echo IMAGE."agregar.png";?>"> 
	<img id="refrescar" title="<?php echo Texto::idioma("Refrescar", IDIOMA);?>" src="<?php echo IMAGE."refrescar.png";?>">
</div>
<div class="demo">

<div id="dialog-form" title="<?php echo Texto::idioma("Cliente", IDIOMA);?>">
	<p id="validateTips">All form fields are required.</p>
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1"><?php echo Texto::idioma("Datos_Personales");?></a></li>
			<li><a href="#tabs-2"><?php echo Texto::idioma("Contacto");?></a></li>
			<li><a href="#tabs-3"><?php echo Texto::idioma("Datos_Banco");?></a></li>
			<li><a href="#tabs-4"><?php echo Texto::idioma("Garante");?></a></li>
			<li><a href="#tabs-5"><?php echo Texto::idioma("Contacto_Garante");?></a></li>
			<li><a href="#tabs-6"><?php echo Texto::idioma("Datos_Laborales");?></a></li>
			<li><a href="#tabs-7"><?php echo Texto::idioma("Referencia_Familiar");?></a></li>
			<li><a href="#tabs-8"><?php echo Texto::idioma("Referencia_Personal");?></a></li>
		</ul>
		<form>
		<div id="tabs-1">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
		      <tr>
		        <td>
		        	<label for="txtNombre"><?php echo Texto::idioma("Nombre", IDIOMA);?></label>
					<input type="text" name="txtNombre" id="txtNombre" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Nombre", IDIOMA);?>" maxlength="40" minlength="3"/>
		        </td>
		        <td>
		        	<label for="txtApellido"><?php echo Texto::idioma("Apellido", IDIOMA);?></label>
					<input type="text" name="txtApellido" id="txtApellido" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Apellido", IDIOMA);?>" maxlength="40" minlength="3"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtCedula"><?php echo Texto::idioma("Cedula", IDIOMA);?></label>
					<input type="text" name="txtCedula" id="txtCedula" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Cedula", IDIOMA);?>" maxlength="13" minlength="11"/>
		        </td>
		        <td>
		        	<label for="txtApodo"><?php echo Texto::idioma("Apodo", IDIOMA);?></label>
					<input type="text" name="txtApodo" id="txtApodo" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Apodo", IDIOMA);?>" maxlength="20" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtCorreo"><?php echo Texto::idioma("Correo", IDIOMA);?></label>
					<input type="text" name="txtCorreo" id="txtCorreo" value="" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Correo", IDIOMA);?>" maxlength="50" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtOcupacion"><?php echo Texto::idioma("Ocupacion", IDIOMA);?></label>
					<input type="text" name="txtOcupacion" id="txtOcupacion" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Ocupacion", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtLimiteCredito"><?php echo Texto::idioma("Limite_Credito", IDIOMA);?></label>
					<input type="number" name="txtLimiteCredito" id="txtLimiteCredito" class="text ui-widget-content ui-corner-all" value="0.00" placeholder="<?php echo Texto::idioma("Limite_Credito", IDIOMA);?>" maxlength="9" minlength="1"/>
		        </td>
		        <td>
		        	<label for="txtFechaNacimiento"><?php echo Texto::idioma("Fecha_Nacimiento", IDIOMA);?></label>
					<input type="text" readonly="readonly" name="txtFechaNacimiento" id="txtFechaNacimiento" class="calendario text ui-widget-content ui-corner-all" value="" placeholder="<?php echo Texto::idioma("Fecha_Nacimiento", IDIOMA);?>" maxlength="10" minlength="0"/>
		        </td>
		        </tr>
		         <tr>
		         <td>
		     		<label for="drpdSexo"><?php echo Texto::idioma("Sexo", IDIOMA);?></label>
		            <select name="drpdSexo" id="drpdSexo" class="text ui-widget-content ui-corner-all" >
		                <option value="F"><?php echo Texto::idioma("Femenino", IDIOMA);?></option>
		                <option value="M"><?php echo Texto::idioma("Masculino", IDIOMA);?></option>
		            </select>
		        </td>
		         <td>
		        	<label for="drpdProvincia"><?php echo Texto::idioma("Provincia", IDIOMA);?></label>
		            <select name="drpdProvincia" id="drpdProvincia" class=" ui-widget-content ui-corner-all" >
		                <option value="1"><?php echo Texto::idioma("Distrito Nacional", IDIOMA);?></option>
		                <option value="2"><?php echo Texto::idioma("Peravia", IDIOMA);?></option>
		            </select>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="drpdEstadoCivil"><?php echo Texto::idioma("Estado_Civil", IDIOMA);?></label>
		            <select name="drpdEstadoCivil" id="drpdEstadoCivil" class="text ui-widget-content ui-corner-all" >
		                <option value="S"><?php echo Texto::idioma("Soltero", IDIOMA);?></option>
		                <option value="C"><?php echo Texto::idioma("Casado", IDIOMA);?></option>
		            </select>
		        </td>
		        <td>
		        	<label for="drpdNacionalidad"><?php echo Texto::idioma("Nacionalidad", IDIOMA);?></label>
		            <select name="drpdNacionalidad" id="drpdNacionalidad" class=" ui-widget-content ui-corner-all" >
		                <option value="1"><?php echo Texto::idioma("Dominicana", IDIOMA);?></option>
		                <option value="2"><?php echo Texto::idioma("Americana", IDIOMA);?></option>
		            </select>
		        </td>
		      </tr>
		      <tr>
		        <td>
					<input type="hidden" name="txtIdCliente" id="txtIdCliente" class="text ui-widget-content ui-corner-all" value="0"/>
		        </td>
		        </tr>
		      
		    </table>
		</div>
		<div id="tabs-2">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
		        <td>
		        	<label for="txtCalle"><?php echo Texto::idioma("Calle", IDIOMA);?></label>
					<input type="text" name="txtCalle" id="txtCalle" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Calle", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtNumero"><?php echo Texto::idioma("Numero", IDIOMA);?></label>
					<input type="number" name="txtNumero" id="txtNumero" class="text ui-widget-content ui-corner-all" value="0" placeholder="<?php echo Texto::idioma("Numero", IDIOMA);?>" maxlength="5" minlength="0" max="99999" min="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtBarrio"><?php echo Texto::idioma("Barrio", IDIOMA);?></label>
					<input type="text" name="txtBarrio" id="txtBarrio" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Barrio", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtDireccionVivienda"><?php echo Texto::idioma("Direccion_Vivienda", IDIOMA);?></label>
					<input type="text" name="txtDireccionVivienda" id="txtDireccionVivienda" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Direccion_Vivienda", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtDireccionNegocio"><?php echo Texto::idioma("Direccion_Negocio", IDIOMA);?></label>
					<input type="text" name="txtDireccionNegocio" id="txtDireccionNegocio" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Direccion_Negocio", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtUbicacion"><?php echo Texto::idioma("Ubicacion", IDIOMA);?></label>
					<input type="text" name="txtUbicacion" id="txtUbicacion" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Ubicacion", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtTelefono1"><?php echo Texto::idioma("Telefono", IDIOMA);?> 1</label>
					<input type="text" name="txtTelefono1" id="txtTelefono1" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Telefono", IDIOMA);?>" maxlength="12" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtTelefono2"><?php echo Texto::idioma("Telxfono", IDIOMA);?> 2</label>
					<input type="text" name="txtTelefono2" id="txtTelefono2" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Telefono", IDIOMA);?>" maxlength="12" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtCelular1"><?php echo Texto::idioma("Celular", IDIOMA);?> 1</label>
					<input type="text" name="txtCelular1" id="txtCelular1" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Celular", IDIOMA);?>" maxlength="12" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtCelular2"><?php echo Texto::idioma("Celular", IDIOMA);?> 2</label>
					<input type="text" name="txtCelular2" id="txtCelular2" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Celular", IDIOMA);?>" maxlength="12" minlength="0"/>
		        </td>
		      </tr>
			</table>
		</div>
		<div id="tabs-3">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tablaDetalle">
				<tr>
				<th>
				<label for="drpdBanco"><?php echo Texto::idioma("Banco", IDIOMA);?></label>
				</th>
		        <td>
					<select name="drpdBanco" id="drpdBanco" class="text ui-widget-content ui-corner-all">
						<?php 
		                	foreach ($listaBanco as $banco) {
		                		echo "<option value='{$banco->getIdBanco()}'>".Texto::idioma($banco->getDescripcion(), IDIOMA)."</option>";
		                	}
		                ?>
		               </select>
		        </td>
		        <th>
		        	<label for="drpdTipoCuenta"><?php echo Texto::idioma("Tipo_Cuenta", IDIOMA);?></label>
		        </th>
		        <td>
					<select name="drpdTipoCuenta" id="drpdTipoCuenta" class="text ui-widget-content ui-corner-all">
						<?php 
		                	foreach ($listaTipoCuenta as $tipoCuenta) {
		                		echo "<option value='{$tipoCuenta->getIdTipoCuenta()}'>".Texto::idioma($tipoCuenta->getDescripcion(), IDIOMA)."</option>";
		                	}
		                ?>
		               </select>
		        </td>
		        </tr>
		        <tr>
		        <th>
		        	<label for="txtNumeroCuenta"><?php echo Texto::idioma("Numero_Cuenta", IDIOMA);?></label>
		        </th>
		        <td colspan="3">
					<input type="number" name="txtNumeroCuenta" id="txtNumeroCuenta" class="text ui-widget-content ui-corner-all" value="0" placeholder="<?php echo Texto::idioma("Numero", IDIOMA);?>" maxlength="20" minlength="0" max="99999" min="0"/>
		        </td>
		        </tr>
			</table>
		</div>
		<div id="tabs-4">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
		      <tr>
		        <td>
		        	<label for="txtNombreGarante"><?php echo Texto::idioma("Nombre", IDIOMA);?></label>
					<input type="text" name="txtNombreGarante" id="txtNombreGarante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Nombre", IDIOMA);?>" maxlength="40" minlength="3"/>
		        </td>
		        <td>
		        	<label for="txtApellidoGarante"><?php echo Texto::idioma("Apellido", IDIOMA);?></label>
					<input type="text" name="txtApellidoGarante" id="txtApellidoGarante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Apellido", IDIOMA);?>" maxlength="40" minlength="3"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtCedulaGarante"><?php echo Texto::idioma("Cedula", IDIOMA);?></label>
					<input type="text" name="txtCedulaGarante" id="txtCedulaGarante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Cedula", IDIOMA);?>" maxlength="13" minlength="11"/>
		        </td>
		        <td>
		        	<label for="txtApodoGarante"><?php echo Texto::idioma("Apodo", IDIOMA);?></label>
					<input type="text" name="txtApodoGarante" id="txtApodoGarante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Apodo", IDIOMA);?>" maxlength="20" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtCorreoGarante"><?php echo Texto::idioma("Correo", IDIOMA);?></label>
					<input type="text" name="txtCorreoGarante" id="txtCorreoGarante" value="" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Correo", IDIOMA);?>" maxlength="50" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtOcupacionGarante"><?php echo Texto::idioma("Ocupacion", IDIOMA);?></label>
					<input type="text" name="txtOcupacionGarante" id="txtOcupacionGarante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Ocupacion", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		      	<td>
		        	<label for="txtIngreso"><?php echo Texto::idioma("Ingreso", IDIOMA);?></label>
					<input type="number" name="txtIngreso" id="txtIngreso" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Ingreso", IDIOMA);?>" maxlength="9" minlength="1" value="0" min='0'/>
		        </td>
		        <td>
		        	<label for="txtFechaNacimientoGarante"><?php echo Texto::idioma("Fecha_Nacimiento", IDIOMA);?></label>
					<input type="text" readonly="readonly" name="txtFechaNacimientoGarante" id="txtFechaNacimientoGarante" class="calendario text ui-widget-content ui-corner-all" value="<?php echo date("Y/m/d");?>" placeholder="<?php echo Texto::idioma("Fecha_Nacimiento", IDIOMA);?>" maxlength="10" minlength="0"/>
		        </td>
		        </tr>
		         <tr>
		         <td>
		     		<label for="drpdSexoGarante"><?php echo Texto::idioma("Sexo", IDIOMA);?></label>
		            <select name="drpdSexoGarante" id="drpdSexoGarante" class="text ui-widget-content ui-corner-all" >
		                <option value="F"><?php echo Texto::idioma("Femenino", IDIOMA);?></option>
		                <option value="M"><?php echo Texto::idioma("Masculino", IDIOMA);?></option>
		            </select>
		        </td>
		         <td>
		        	<label for="drpdProvinciaGarante"><?php echo Texto::idioma("Provincia", IDIOMA);?></label>
		            <select name="drpdProvinciaGarante" id="drpdProvinciaGarante" class=" ui-widget-content ui-corner-all" >
		                <option value="1"><?php echo Texto::idioma("Distrito Nacional", IDIOMA);?></option>
		                <option value="2"><?php echo Texto::idioma("Peravia", IDIOMA);?></option>
		            </select>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="drpdEstadoCivilGarante"><?php echo Texto::idioma("Estado_Civil", IDIOMA);?></label>
		            <select name="drpdEstadoCivilGarante" id="drpdEstadoCivilGarante" class="text ui-widget-content ui-corner-all" >
		                <option value="S"><?php echo Texto::idioma("Soltero", IDIOMA);?></option>
		                <option value="C"><?php echo Texto::idioma("Casado", IDIOMA);?></option>
		            </select>
		        </td>
		        <td>
		        	<label for="drpdNacionalidadGarante"><?php echo Texto::idioma("Nacionalidad", IDIOMA);?></label>
		            <select name="drpdNacionalidadGarante" id="drpdNacionalidadGarante" class=" ui-widget-content ui-corner-all" >
		                <option value="1"><?php echo Texto::idioma("Dominicana", IDIOMA);?></option>
		                <option value="2"><?php echo Texto::idioma("Americana", IDIOMA);?></option>
		            </select>
		        </td>
		      </tr>
		      <tr>
		        <td>
					<input type="hidden" name="txtIdGarante" id="txtIdGarante" class="text ui-widget-content ui-corner-all" value="0"/>
		        </td>
		        </tr>
		        <tr>
		        	<td>
		        	<label for="drpdParentescoGarante"><?php echo Texto::idioma("Parentesco", IDIOMA);?></label>
		            <select name="drpdParentescoGarante" id="drpdParentescoGarante" class=" ui-widget-content ui-corner-all" >
		                <option value="1"><?php echo Texto::idioma("Padre", IDIOMA);?></option>
		                <option value="2"><?php echo Texto::idioma("Hermano", IDIOMA);?></option>
		            </select>
		        </td>
		        </tr>
		      
		    </table>
		</div>
		<div id="tabs-5">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
		        <td>
		        	<label for="txtCalleGarante"><?php echo Texto::idioma("Calle", IDIOMA);?></label>
					<input type="text" name="txtCalleGarante" id="txtCalleGarante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Calle", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtNumeroGarante"><?php echo Texto::idioma("Numero", IDIOMA);?></label>
					<input type="number" name="txtNumeroGarante" id="txtNumeroGarante" class="text ui-widget-content ui-corner-all" value="0" placeholder="<?php echo Texto::idioma("Numero", IDIOMA);?>" maxlength="5" minlength="0" max="99999" min="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtBarrioGarante"><?php echo Texto::idioma("Barrio", IDIOMA);?></label>
					<input type="text" name="txtBarrioGarante" id="txtBarrioGarante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Barrio", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtDireccionViviendaGarante"><?php echo Texto::idioma("Direccion_Vivienda", IDIOMA);?></label>
					<input type="text" name="txtDireccionViviendaGarante" id="txtDireccionViviendaGarante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Direccion_Vivienda", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtDireccionNegocioGarante"><?php echo Texto::idioma("Direccion_Negocio", IDIOMA);?></label>
					<input type="text" name="txtDireccionNegocioGarante" id="txtDireccionNegocioGarante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Direccion_Negocio", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtUbicacionGarante"><?php echo Texto::idioma("Ubicacion", IDIOMA);?></label>
					<input type="text" name="txtUbicacionGarante" id="txtUbicacionGarante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Ubicacion", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtTelefono1Garante"><?php echo Texto::idioma("Telefono", IDIOMA);?> 1</label>
					<input type="text" name="txtTelefono1Garante" id="txtTelefono1Garante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Telefono", IDIOMA);?>" maxlength="12" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtTelefono2Garante"><?php echo Texto::idioma("Telxfono", IDIOMA);?> 2</label>
					<input type="text" name="txtTelefono2Garante" id="txtTelefono2Garante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Telefono", IDIOMA);?>" maxlength="12" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtCelular1Garante"><?php echo Texto::idioma("Celular", IDIOMA);?> 1</label>
					<input type="text" name="txtCelular1Garante" id="txtCelular1Garante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Celular", IDIOMA);?>" maxlength="12" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtCelular2Garante"><?php echo Texto::idioma("Celular", IDIOMA);?> 2</label>
					<input type="text" name="txtCelular2Garante" id="txtCelular2Garante" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Celular", IDIOMA);?>" maxlength="12" minlength="0"/>
		        </td>
		      </tr>
			</table>
		</div>
		<div id="tabs-6">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
		        <td>
		        	<label for="drpdTipoEmpleoDL"><?php echo Texto::idioma("Tipo_Empleo", IDIOMA);?></label>
					<select name="drpdTipoEmpleoDL" id="drpdTipoEmpleoDL" class="text ui-widget-content ui-corner-all" >
		                <option value="1"><?php echo Texto::idioma("Comerciante", IDIOMA);?></option>
		                <option value="2"><?php echo Texto::idioma("Empleado Privado", IDIOMA);?></option>
		            </select>
		        </td>
		        <td>
		        	<label for="txtEmpleoDL"><?php echo Texto::idioma("Empleo", IDIOMA);?></label>
					<input type="text" name="txtEmpleoDL" id="txtEmpleoDL" class="text ui-widget-content ui-corner-all" value="" placeholder="<?php echo Texto::idioma("Empleo", IDIOMA);?>" maxlength="300" minlength="0" />
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtCargoDL"><?php echo Texto::idioma("Cargo", IDIOMA);?></label>
					<input type="text" name="txtCargoDL" id="txtCargoDL" class="text ui-widget-content ui-corner-all" value="" placeholder="<?php echo Texto::idioma("Cargo", IDIOMA);?>" maxlength="300" minlength="0" />
		        </td>
		        
		        <td>
		        	<label for="txtDireccionTrabajoDL"><?php echo Texto::idioma("DireccionTrabajo", IDIOMA);?></label>
					<input type="text" name="txtDireccionTrabajoDL" id="txtDireccionTrabajoDL" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Direccion_Trabajo", IDIOMA);?>" maxlength="300" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtIngresoMesDL"><?php echo Texto::idioma("Ingreso_Mes", IDIOMA);?></label>
					<input type="number" name="txtIngresoMesDL" id="txtIngresoMesDL" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Ingreso_Mes", IDIOMA);?>" maxlength="10" minlength="0" min="0" value="0"/>
		        </td>
		        
		        <td>
		        	<label for="txtTiempoTrabajoDL"><?php echo Texto::idioma("Tiempo_Trabajo", IDIOMA);?></label>
					<select name="drpdTiempoTrabajoDL" id="drpdTiempoTrabajoDL">
					<?php
						for ($indice = 1; $indice < 50; $indice++) {
							echo "<option value='{$indice}'>{$indice} ".Texto::idioma("Axos", IDIOMA)."</option>";
						}
					?>
					</select>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtOtroIngresoDL"><?php echo Texto::idioma("Otro_Ingreso", IDIOMA);?></label>
					<input type="text" name="txtOtroIngresoDL" id="txtOtroIngresoDL" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Otro_Ingreso", IDIOMA);?>" maxlength="10" minlength="0"/>
		        </td>
		        </tr>
			</table>
		</div>
		<div id="tabs-7">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
		        <td>
		        	<label for="txtNombreRF"><?php echo Texto::idioma("Nombre", IDIOMA);?></label>
					<input type="text" name="txtNombreRF" id="txtNombreRF" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Nombre", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtTelefonoRF"><?php echo Texto::idioma("Telefono", IDIOMA);?></label>
					<input type="text" name="txtTelefonoRF" id="txtTelefonoRF" class="text ui-widget-content ui-corner-all" value="" placeholder="<?php echo Texto::idioma("Telefono", IDIOMA);?>" maxlength="15" minlength="0" />
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtCelularRF"><?php echo Texto::idioma("Celular", IDIOMA);?></label>
					<input type="text" name="txtCelularRF" id="txtCelularRF" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Celular", IDIOMA);?>" maxlength="15" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtDireccionRF"><?php echo Texto::idioma("Direccion", IDIOMA);?></label>
					<input type="text" name="txtDireccionRF" id="txtDireccionRF" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Direccion", IDIOMA);?>" maxlength="300" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtParentescoRF"><?php echo Texto::idioma("Parentesco", IDIOMA);?></label>
					<input type="text" name="txtParentescoRF" id="txtParentescoRF" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Parentesco", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		      </tr>
			</table>
		</div>
		<div id="tabs-8">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
		        <td>
		        	<label for="txtNombreRP"><?php echo Texto::idioma("Nombre", IDIOMA);?></label>
					<input type="text" name="txtNombreRP" id="txtNombreRP" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Nombre", IDIOMA);?>" maxlength="90" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtTelefonoRP"><?php echo Texto::idioma("Telefono", IDIOMA);?></label>
					<input type="text" name="txtTelefonoRP" id="txtTelefonoRP" class="text ui-widget-content ui-corner-all" value="" placeholder="<?php echo Texto::idioma("Telefono", IDIOMA);?>" maxlength="15" minlength="0" />
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="txtCelularRP"><?php echo Texto::idioma("Celular", IDIOMA);?></label>
					<input type="text" name="txtCelularRP" id="txtCelularRP" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Celular", IDIOMA);?>" maxlength="15" minlength="0"/>
		        </td>
		        <td>
		        	<label for="txtDireccionRP"><?php echo Texto::idioma("Direccion", IDIOMA);?></label>
					<input type="text" name="txtDireccionRP" id="txtDireccionRP" class="text ui-widget-content ui-corner-all" placeholder="<?php echo Texto::idioma("Direccion", IDIOMA);?>" maxlength="300" minlength="0"/>
		        </td>
		        </tr>
		      <tr>
		        <td>
		        	<label for="drpdTipoRelacionRP"><?php echo Texto::idioma("Tipo_Relacion", IDIOMA);?></label>
					<select name="drpdTipoRelacionRP" id="drpdTipoRelacionRP" class="text ui-widget-content ui-corner-all" >
		                <option value="S"><?php echo Texto::idioma("A", IDIOMA);?></option>
		                <option value="C"><?php echo Texto::idioma("B", IDIOMA);?></option>
		            </select>
		        </td>
		      </tr>
			</table>
		</div>
		</form>
	</div>
</div>

<div id="users-contain" class="ui-widget">
	
	
</div>
<input type="hidden" id="txtIdSecundario" name="txtIdSecundario" value="">
<input type="hidden" id="txtIdFila" name="txtIdFila" value="">
</div><!-- End demo -->

<div id="infoEliminar" title="<?php echo Texto::idioma("Eliminar", IDIOMA); ?>">
	<p><?php echo Texto::idioma("Mensaje_Eliminar_Cliente", IDIOMA); ?>?</p>
</div>

<div id="infoAlEliminar" title="<?php echo Texto::idioma("Notificacion", IDIOMA); ?>">
	<p><?php echo Texto::idioma("Cliente_Eliminado", IDIOMA); ?>.</p>
</div>

<div id="infoGeneral" title="<?php echo Texto::idioma("Notificacion", IDIOMA); ?>">
	<p id="pInformacion"></p>
</div>