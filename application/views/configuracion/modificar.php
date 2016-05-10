<script language="javascript">
	$(document).ready(function() {
		$("#frmConfiguracion").validate();
	});
</script>

<form id="frmConfiguracion" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtLogo"><?php echo Texto::idioma("Logo", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="file" id="txtLogo" name="txtLogo" class="ancho500 form-control" placeholder="<?php echo Texto::idioma("Logo");?>" value="<?php echo $configuracion->getLogo();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtEmpresa"><?php echo Texto::idioma("Empresa", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="txtEmpresa" name="txtEmpresa" class="ancho500 form-control" minlength="0" maxlength="300" placeholder="<?php echo Texto::idioma("Empresa");?>" value="<?php echo $configuracion->getEmpresa();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtEslogan"><?php echo Texto::idioma("Eslogan", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="txtEslogan" name="txtEslogan" class="ancho500 form-control" minlength="0" maxlength="1000" placeholder="<?php echo Texto::idioma("Eslogan");?>" value="<?php echo $configuracion->getEslogan();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtDireccion"><?php echo Texto::idioma("Direccion", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="txtDireccion" name="txtDireccion" class="ancho500 form-control" minlength="0" maxlength="300" placeholder="<?php echo Texto::idioma("Direccion");?>" value="<?php echo $configuracion->getDireccion();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtTelefono"><?php echo Texto::idioma("Telefono", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="txtTelefono" name="txtTelefono" class="ancho500 required form-control" minlength="0" maxlength="1000" placeholder="<?php echo Texto::idioma("Telefono");?>" value="<?php echo $configuracion->getTelefono();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtFax"><?php echo Texto::idioma("Fax", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="txtFax" name="txtFax" class="ancho500 form-control" minlength="0" maxlength="1000" placeholder="<?php echo Texto::idioma("Fax");?>" value="<?php echo $configuracion->getFax();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtDireccion"><?php echo Texto::idioma("Direccion", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="txtDireccion" name="txtDireccion" class="ancho500 form-control" minlength="0" maxlength="300" placeholder="<?php echo Texto::idioma("Direccion");?>" value="<?php echo $configuracion->getDireccion();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtEmail"><?php echo Texto::idioma("Email_Empresa", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="txtEmail" name="txtEmail" class="ancho500 required form-control" minlength="0" maxlength="100" placeholder="<?php echo Texto::idioma("Email_Empresa");?>" value="<?php echo $configuracion->getEmail();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtEmailEnvio"><?php echo Texto::idioma("Email_Envio", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="txtEmailEnvio" name="txtEmailEnvio" class="ancho500 required form-control" minlength="0" maxlength="100" placeholder="<?php echo Texto::idioma("Email_Envio");?>" value="<?php echo $configuracion->getEmailEnvio();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtClave"><?php echo Texto::idioma("Clave", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="password" id="txtClave" name="txtClave" class="ancho500 required form-control" minlength="0" maxlength="100" placeholder="<?php echo Texto::idioma("Clave");?>" value="<?php echo $configuracion->getClave();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtHost"><?php echo Texto::idioma("Host", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="txtHost" name="txtHost" class="ancho500 required form-control" minlength="0" maxlength="100" placeholder="<?php echo Texto::idioma("Host");?>" value="<?php echo $configuracion->getHost();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtPuerto"><?php echo Texto::idioma("Puerto", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="number" id="txtPuerto" name="txtPuerto" class="ancho500 required form-control" minlength="0" maxlength="10" placeholder="<?php echo Texto::idioma("Puerto");?>" value="<?php echo $configuracion->getPuerto();?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtZonaHorario"><?php echo Texto::idioma("Zona_Horario", IDIOMA);?></label>
		<div class="col-sm-6">
			<input type="text" id="txtZonaHorario" name="txtZonaHorario" class="ancho500 form-control" minlength="0" maxlength="100" placeholder="<?php echo Texto::idioma("Zona_Horario");?>" value="<?php echo $configuracion->getZonaHorario();?>"/>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button id="submit" type="submit" class="btn btn-primary"> <?php echo Texto::idioma("Salvar", IDIOMA);?></button> 
			<a href="<?php echo base_url();?>"><button id="btnCancelar" type="button" class="btn btn-default"><?php echo Texto::idioma("Cancelar", IDIOMA);?></button></a>
		</div>
	</div>
</form>