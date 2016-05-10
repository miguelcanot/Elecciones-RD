function buscar() {
	document.frmBusqueda.submit();
}

function irA(direccion) {
	document.location.href = baseUrl+direccion;
}

function cambiarEstatus(direccion) {
	var cantidad = 0;
	for (i=0;i<document.frmInformacion.elements.length;i++) {
		if (document.frmInformacion.elements[i].type == "checkbox") {	
			if (document.frmInformacion.elements[i].checked == 1) {
				cantidad++; 
			} 
		}
	}
	if (cantidad > 0) {
		document.frmInformacion.action = direccion;
		document.frmInformacion.submit();
	} else {
		alert('Debe seleccionar por lo menos un expediente.');
	}
}

function agregar(direccion) {
	document.location.href = direccion;
}

function modificar(direccion) {
	var cantidad = 0;
	for (i=0;i<document.frmInformacion.elements.length;i++) {
		if (document.frmInformacion.elements[i].type == "checkbox") {	
			if (document.frmInformacion.elements[i].checked == 1) {
				cantidad++; 
			} 
		}
	}
	if (cantidad > 0) {
		if (cantidad == 1) {
			document.frmInformacion.action = direccion;
			document.frmInformacion.submit();
		} else {
			alert('Debe seleccionar un solo expediente.');
		}
	} else {
		alert('Debe seleccionar por lo menos un expediente.');
	}
}

function seleccionar(){ 
	if ($("#chSeleccion").val() == 0) {
		seleccionarTodo();
		$("#chSeleccion").val(1);
	} else {
		deseleccionarTodo();
		$("#chSeleccion").val(0);
	}
}

function seleccionarTodo(){ 
   for (i=0;i<document.frmInformacion.elements.length;i++) {
      if (document.frmInformacion.elements[i].type == "checkbox") {	
         document.frmInformacion.elements[i].checked = 1; 
      }
   }
} 

function deseleccionarTodo(){ 
   for (i=0;i<document.frmInformacion.elements.length;i++) {
      if (document.frmInformacion.elements[i].type == "checkbox") {	
         document.frmInformacion.elements[i].checked = 0; 
      }
   }
} 

function borrar() {
	$('#frmInformacion').each (function(){
		  this.reset();
		});
	$('#frmBusqueda').each (function(){
		  this.reset();
		});
}
//TRUE fecha1 es mayor a fecha2
function compararFecha(fecha, fecha2){
		var xMes=fecha.substring(3, 5);
		var xDia=fecha.substring(0, 2);
		var xAnio=fecha.substring(6,10);
		var yMes=fecha2.substring(3, 5);
		var yDia=fecha2.substring(0, 2);
		var yAnio=fecha2.substring(6,10);
		if (xAnio > yAnio){
			return(true);
		}else{
			if (xAnio == yAnio){
				if (xMes > yMes){
		      		return(true);
				}
		 		if (xMes == yMes){
					if (xDia > yDia){
						return(true);
					}else{
						return(false);
					}
				}else{
					return(false);
				}
			}else{
				return(false);
			}
		} 
	
}

function toogleBoton(visual, id, direccion) {
	var direccion = direccion || "";
	if (visual == "M") {
		$("#"+id).show();
		$("#"+id+" a").attr("href", direccion);
	} else if (visual == "O") {
		$("#"+id).hide();
	} else {
		alert("Error-01");
	}
}