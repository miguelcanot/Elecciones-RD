<script type="text/javascript">
	$(document).ready(function() {
		$("#frmPerfil").validate();
		
		$("#txtImagen").change(function(a) {
			$("#rutaImagen").html($("#txtImagen").val());
		});
	});	
</script>


<form id="frmUsuario" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label class="col-sm-3 control-label" for="usuario"><?php echo Texto::idioma("Usuario", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input readonly="readonly" type="text" id="usuario" name="usuario" class="required form-control" placeholder="<?php echo Texto::idioma("Usuario");?>" minlength="1" maxlength="100" autofocus data-bind="value:usuario"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="nombre"><?php echo Texto::idioma("Nombre", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="text" id="nombre" name="nombre" class="required form-control" placeholder="<?php echo Texto::idioma("Nombre");?>" minlength="1" maxlength="100" data-bind="value:nombre"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="apellido"><?php echo Texto::idioma("Apellido", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="text" id="apellido" name="apellido" class="required form-control" placeholder="<?php echo Texto::idioma("Apellido");?>" minlength="1" maxlength="100" data-bind="value:apellido"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="correo"><?php echo Texto::idioma("Correo", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input readonly="readonly" type="text" id="correo" name="correo" class="required email form-control" placeholder="<?php echo Texto::idioma("Correo");?>" minlength="1" maxlength="100" data-bind="value:correo"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="fechaNacimiento"><?php echo Texto::idioma("Fecha_Nacimiento", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input id="fechaNacimiento" class="calendario form-control" readonly="readonly" type="text" name="fechaNacimiento" placeholder="<?php echo Texto::idioma("Fecha_Nacimiento");?>"  data-bind="value:fechaNacimiento"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="sexo"><?php echo Texto::idioma("Sexo", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<select id="sexo" name="sexo" class="form-control">
				<option value="F"><?php echo Texto::idioma("Femenino");?></option>
				<option value="M"><?php echo Texto::idioma("Masculino");?></option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="direccion"><?php echo Texto::idioma("Direccion", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input id="direccion" class="form-control" type="text" name="direccion" placeholder="<?php echo Texto::idioma("Direccion");?>"  data-bind="value:direccion"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="telefono"><?php echo Texto::idioma("Telefono", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input id="telefono" class="form-control" type="text" name="telefono" placeholder="<?php echo Texto::idioma("Telefono");?>"  data-bind="value:telefono"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="celular"><?php echo Texto::idioma("Celular", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input id="celular" class="form-control" type="text" name="celular" placeholder="<?php echo Texto::idioma("Celular");?>"  data-bind="value:celular"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="drpdEstadoCivil"><?php echo Texto::idioma("Estado_Civil", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<select id="drpdEstadoCivil" name="drpdEstadoCivil" class="form-control">
				<option value="S"><?php echo Texto::idioma("Soltera(o)");?></option>
				<option value="C"><?php echo Texto::idioma("Casada(o)");?></option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtImagen"><?php echo Texto::idioma("Imagen", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="file" name='txtImagen' id='txtImagen' class="form-control invisible"/>
			<button type="button" class="btn btn-block btn-prusia" onclick="document.getElementById('txtImagen').click();"><i class='fa fa-picture-o'></i></button>
			<span id="rutaImagen"></span>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"> <?php echo Texto::idioma("Guardar", IDIOMA);?></button> 
		</div>
	</div>
</form>
<script src="<?php echo VIEWMODEL;?>perfil.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(perfil, $("#divVista").get(0));
		perfil.obtenerContenido();
	});	
</script>