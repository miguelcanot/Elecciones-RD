<form id="frmCambiarContrasena" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit:cambiarCotrasena">
	<div class="form-group">
		<label class="col-sm-3 control-label" for="contrasenaAnterior"><?php echo Texto::idioma("Contrasena_Anterior");?></label>
		<div class="col-sm-6">
			<input type="password" id="contrasenaAnterior" name="contrasenaAnterior" class="required ancho300 form-control" placeholder="<?php echo Texto::idioma("Contrasena_Anterior");?>" minlength="3" maxlength="100">
			<span class="field-validation-error" data-valmsg-for="contrasenaAnterior" data-valmsg-replace="true"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="contrasena"><?php echo Texto::idioma("Contrasena_Nueva")." (".Texto::idioma("Clave_Parametro").")";?></label>
		<div class="col-sm-6">
			<input type="password" id="contrasena" name="contrasena" class="required ancho300 form-control" placeholder="<?php echo Texto::idioma("Contrasena_Nueva");?>" minlength="3" maxlength="100">
			<span class="field-validation-error" data-valmsg-for="contrasena" data-valmsg-replace="true"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="confirmarContrasena"><?php echo Texto::idioma("Confirmar_Contrasena_Nueva", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="password" id="confirmarContrasena" name="confirmarContrasena" class="required ancho300 form-control" equalto="#contrasena" placeholder="<?php echo Texto::idioma("Confirmar_Contrasena_Nueva");?>" minlength="3" maxlength="100">
			<span class="field-validation-error" data-valmsg-for="confirmarContrasena" data-valmsg-replace="true"></span>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button id="btnGuardar" type="submit" class="btn btn-primary" data-loading-text="<?php echo Texto::idioma("Enviando");?>"><?php echo Texto::idioma("Guardar");?></button> 
			<button type="button" data-bind="click:btnCancelar" class="btn btn-warning"><?php echo Texto::idioma("Cancelar");?></button> 
		</div>
	</div>
</form>
<script src="<?php echo VIEWMODEL;?>perfil.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(perfil, $("#divVista").get(0));
		app.getPermisoMenu();
		app.menuActivo("mUsuario");
	});	
</script>
