<script type="text/javascript">
	$(document).ready(function() {
		$("#frmSuscripcion").validate();
	});	
</script>

<form id="frmSuscripcion" class="form-horizontal" action="#" style="border-radius: 0px;" method="post">
	<div class="form-group">
		<label for="txtNombre"  class="col-sm-3 control-label"><?php echo Texto::idioma("Nombre");?></label> 
		<div class="col-sm-6">
			<input id="txtNombre" class="required form-control" type="text" name="txtNombre" placeholder="<?php echo Texto::idioma("Nombre");?>" maxlength="100" autofocus="autofocus">
		</div>
	</div>
	<div class="form-group">
		<label for="txtCorreo"  class="col-sm-3 control-label"><?php echo Texto::idioma("Correo");?></label> 
		<div class="col-sm-6">
			<input id="txtCorreo" class="required email form-control" type="text" name="txtCorreo" placeholder="<?php echo Texto::idioma("Correo");?>" maxlength="100">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-success"><?php echo Texto::idioma("Enviar");?></button>
			<button type="button" class="btn btn-default" onclick="javascript:irA('<?php echo base_url()."suscripcion";?>');"><?php echo Texto::idioma("Cancelar");?></button>
		</div>
	</div>
</form>