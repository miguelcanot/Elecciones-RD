	<script>

	function seleccionarCliente(idCliente, nombre, limiteCredito, prestado) {
		$("#txtCliente").val(nombre);
		$("#txtIdClientePrestamo").val(idCliente);
		$("#txtLimite").val(limiteCredito);
		$("#txtPrestado").val(prestado);
		busquedaDialog.dialog( "close" );
		$("#trInformacionPrestamo").show("slow");
		$("#liTabs-2").show("slow");
		$("#liTabs-3").show("slow");
		//parent.obtenerDatosClientePrestamo(idCliente);
	}
	
	window.onbeforeunload = function () {
		//alert("se va");
		//return "Ha ejecutado una accion que produce el cierre de esta pagina, esta de acuerdo? \n Si no entiende lo que dice este mensaje, por favor presione CANCELAR";
	};
	
	/* Global var for counter */
	var giCount = 0;
	
	$(document).ready(function() {
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
				{ "sTitle": "<?php echo Texto::idioma("", IDIOMA);?>", "sClass": "center" }
			]
		} );	

		obtenerCliente();
		$(".calendario").datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, changeMonth: true,yearRange: '1930:1995'  });
		
		//Mask
		//$('#txtLimiteCredito').mask("9999999");
		$('#txtCedula').mask("999-9999999-9");
		$('#txtTelefono1').mask("999-999-9999");
		$('#txtTelefono2').mask("999-999-9999");
		$('#txtCelular1').mask("999-999-9999");
		$('#txtCelular2').mask("999-999-9999"); 
		
		// Tabs
		$('#tabs').tabs();
		$( ".button" ).button();
	} );

	function obtenerCliente() {
		giCount = 0;
		direccion = '<?php echo HOST."usuario/obtenerClienteIdUsuarioPrestamo/";?>';	
		$.getJSON(direccion, function(data) {
			$.each(data, function(position, value) {
				agregarCliente({"id":value["id"],"nombre":value['nombre'], "apellido":value['apellido'], "cedula":value['cedula'], "limiteCredito":value['limiteCredito'], "telefono1":value['telefono1'], "celular1":value['celular1'], "correo":value['correo'], "prestado":value['prestado']});
			});
		});
	}

	function agregarCliente(cliente) {
		var seleccionar = "<a href='javascript:seleccionarCliente("+cliente['id']+", \""+cliente['nombre'] + " " + cliente['apellido']+"\", \""+cliente['limiteCredito']+"\", \""+cliente['prestado']+"\");'><img title='<?php echo Texto::idioma("Seleccionar", IDIOMA);?>' src='<?php echo IMAGE."seleccionar.png";?>'></a>";
		$('#users').dataTable().fnAddData( [
											cliente['id'],
		                        			cliente['nombre'] + " " + cliente['apellido'],
		                        			cliente['cedula'],
		                        			cliente['limiteCredito'],
		                        			seleccionar
		                        			] );
		giCount++;
	}
	</script>

<div class="demo">

<div id="users-contain" class="ui-widget">
	
	
</div>
</div><!-- End demo -->