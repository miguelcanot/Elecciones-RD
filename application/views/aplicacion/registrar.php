<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#frmApp").validate();
	});
</script>


<form id="frmApp" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" enctype="multipart/form-data">
	<?php if ($mensaje != "") {?>		
		<div class="col-md-12 alert alert-warning alert-white rounded"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><div class="icon"><i class="fa fa-times-circle"></i></div><strong><?php echo Texto::idioma("Alerta");?>!</strong> <?php echo Texto::idioma($mensaje);?></div>
	<?php }?>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtNombre"><?php echo Texto::idioma("Nombre", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="text" id="txtNombre" name="txtNombre"
								class="ancho500 form-control" placeholder="<?php echo Texto::idioma("Nombre")?>" minlength="3"
								maxlength="200" value="<?php echo $app->getNombre();?>" autofocus/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtDescripcion"><?php echo Texto::idioma("Descripcion", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="text" id="txtDescripcion" name="txtDescripcion"
								class=" ancho500 required form-control"
								placeholder="<?php echo Texto::idioma("Descripcion")?>" minlength="8"
								maxlength="1000" value="<?php echo $app->getDescripcion();?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtWeb"><?php echo Texto::idioma("Web", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="text" id="txtWeb" name="txtWeb"
								class=" ancho500 required form-control"
								placeholder="<?php echo Texto::idioma("Web")?>" minlength="1"
								maxlength="100" value="<?php echo $app->getWeb();?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtCallbackUrl"><?php echo Texto::idioma("Callback_Url", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="text" id="txtCallbackUrl" name="txtCallbackUrl"
								class=" ancho500 form-control"
								placeholder="<?php echo Texto::idioma("Callback_Url")?>" minlength="1"
								maxlength="200" value="<?php echo $app->getCallbackUrl();?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtImagen"><?php echo Texto::idioma("Imagen", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="file" name='txtImagen' id='txtImagen' class="form-control"/>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button id="submit" type="submit" class="btn btn-primary"> <?php echo Texto::idioma("Salvar", IDIOMA);?></button> 
			<a href="<?php echo base_url()."app/";?>"><button id="btnCancelar" type="button" class="btn btn-default"><?php echo Texto::idioma("Cancelar", IDIOMA);?></button></a>
		</div>
	</div>
</form>