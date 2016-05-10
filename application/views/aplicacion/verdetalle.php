<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#frmApp").validate();
	});	
</script>


<form id="frmApp" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<?php 
		$imagen = (file_exists(IMAGE_UPLOAD."app/".$app->getImg()) && $app->getImg() != "") ? IMAGEAPP.$app->getImg() : IMAGEAPP."app.png";
		?>
		<div class="col-sm-offset-5">
			<img alt="" src="<?php echo $imagen;?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtNombre"><?php echo Texto::idioma("Nombre", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input readonly="readonly" type="text" id="txtNombre" name="txtNombre"
								class="ancho500 form-control" placeholder="<?php echo Texto::idioma("Nombre")?>" minlength="3"
								maxlength="200" value="<?php echo $app->getNombre();?>" autofocus/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtDescripcion"><?php echo Texto::idioma("Descripcion", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input readonly="readonly" type="text" id="txtDescripcion" name="txtDescripcion"
								class=" ancho500 required form-control"
								placeholder="<?php echo Texto::idioma("Descripcion")?>" minlength="8"
								maxlength="1000" value="<?php echo $app->getDescripcion();?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtWeb"><?php echo Texto::idioma("Web", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input readonly="readonly" type="text" id="txtWeb" name="txtWeb"
								class=" ancho500 required form-control"
								placeholder="<?php echo Texto::idioma("Web")?>" minlength="1"
								maxlength="100" value="<?php echo $app->getWeb();?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtCallbackUrl"><?php echo Texto::idioma("Callback_Url", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input readonly="readonly" type="text" id="txtCallbackUrl" name="txtCallbackUrl"
								class=" ancho500 form-control"
								placeholder="<?php echo Texto::idioma("Callback_Url")?>" minlength="1"
								maxlength="200" value="<?php echo $app->getCallbackUrl();?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtKey"><?php echo Texto::idioma("Key", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input readonly="readonly" type="text" id="txtKey" name="txtKey"
								class=" ancho500 required form-control"
								placeholder="<?php echo Texto::idioma("Key")?>" minlength="1"
								maxlength="200" value="<?php echo $appToken->getKey();?>" />
		</div>
	</div><div class="form-group">
		<label class="col-sm-3 control-label" for="txtKeySecreto"><?php echo Texto::idioma("Key_Secreto", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input readonly="readonly" type="text" id="txtKey" name="txtKeySecreto"
								class=" ancho500 required form-control"
								placeholder="<?php echo Texto::idioma("Key_Secreto")?>" minlength="1"
								maxlength="200" value="<?php echo $appToken->getKeySecreto();?>" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2  col-sm-10">
			<a href="<?php echo base_url()."app/";?>"><button type="button" class="btn btn-primary"><?php echo Texto::idioma("Atras", IDIOMA);?></button></a>
		</div>
	</div>
</form>