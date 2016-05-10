<form id="frmConfiguracion" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" enctype="multipart/form-data" data-bind="submit:guardar">
	<div class="form-group">
		<label class="col-sm-3 control-label" for="empresa"><?php echo Texto::idioma("Empresa", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="empresa" name="empresa" class="ancho500 form-control" minlength="0" maxlength="300" placeholder="<?php echo Texto::idioma("Empresa");?>" data-bind="value:empresa"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="eslogan"><?php echo Texto::idioma("Eslogan", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="eslogan" name="eslogan" class="ancho500 form-control" minlength="0" maxlength="1000" placeholder="<?php echo Texto::idioma("Eslogan");?>" data-bind="value:eslogan"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="direccion"><?php echo Texto::idioma("Direccion", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="direccion" name="direccion" class="ancho500 form-control" minlength="0" maxlength="300" placeholder="<?php echo Texto::idioma("Direccion");?>" data-bind="value:direccion"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="telefono"><?php echo Texto::idioma("Telefono", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="telefono" name="telefono" class="ancho500 required form-control" minlength="0" maxlength="1000" placeholder="<?php echo Texto::idioma("Telefono");?>" data-bind="value:telefono"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="fax"><?php echo Texto::idioma("Fax", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="fax" name="fax" class="ancho500 form-control" minlength="0" maxlength="1000" placeholder="<?php echo Texto::idioma("Fax");?>" data-bind="value:fax"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="email"><?php echo Texto::idioma("Email_Empresa", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="email" name="email" class="ancho500 required form-control" minlength="0" maxlength="100" placeholder="<?php echo Texto::idioma("Email_Empresa");?>" data-bind="value:email"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="email_envio"><?php echo Texto::idioma("Email_Envio", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="email_envio" name="email_envio" class="ancho500 required form-control" minlength="0" maxlength="100" placeholder="<?php echo Texto::idioma("Email_Envio");?>" data-bind="value:email_envio"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="clave"><?php echo Texto::idioma("Clave", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="password" id="clave" name="clave" class="ancho500 required form-control" minlength="0" maxlength="100" placeholder="<?php echo Texto::idioma("Clave");?>" data-bind="value:clave"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="host"><?php echo Texto::idioma("Host", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="host" name="host" class="ancho500 required form-control" minlength="0" maxlength="100" placeholder="<?php echo Texto::idioma("Host");?>" data-bind="value:host"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="puerto"><?php echo Texto::idioma("Puerto", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="number" id="puerto" name="puerto" class="ancho500 required form-control" minlength="0" maxlength="10" placeholder="<?php echo Texto::idioma("Puerto");?>" data-bind="value:puerto"/>
		</div>
	</div>
	<div class="form-group">
	    <label class="control-label col-sm-3" for="imagen"><?php echo Texto::idioma("Logo");?></label>
	    <div class="col-sm-6">
	        <input type="file" name='imagen' id='imagen' class="form-control invisible file" data-bind="value:imagen"/>
	        <button type="button" class="btn btn-block btn-info" id="btnImagen"><i class='fa fa-picture-o'></i></button>
	        <span id="rutaImagen" data-bind="html:imagen"></span>
	    </div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for=""></label>
		<div class="col-sm-6">
			<button id="btnCorreo" data-loading-text="<?php echo Texto::idioma("Enviando");?>..." type="button" class="btn btn-info btn-block" data-bind="click:enviarCorreo"><?php echo Texto::idioma("Probar_Correo");?></button>
			<small><?php echo Texto::idioma("Probar_Correo_Info");?></small>
			<div id="mensajeResultado"></div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button id="submit" type="submit" class="btn btn-primary"> <?php echo Texto::idioma("Salvar");?></button> 
		</div>
	</div>
</form>

<script src="<?php echo VIEWMODEL;?>configuracion.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(configuracion, $("#divVista").get(0));
		configuracion.obtenerConfiguracion();;
		botonImagen("imagen", "btnImagen", "rutaImagen");
		app.getPermisoMenu();
		app.menuActivo("mConfiguracion");
	});	
</script>