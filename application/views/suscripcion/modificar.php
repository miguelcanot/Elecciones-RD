       <script type="text/javascript">
			$(document).ready(function() {
				$("#frmSuscripcion").validate();
			});	
		</script>
 
 <div class="container col-md-12">
	<div class="row"> 
		<form id="frmSuscripcion" method="post" action="#">
			<div class="form-group">
				<label for="txtNombre" class=""><?php echo Texto::idioma("Nombre");?></label> 
				<input id="txtNombre" class="required form-control" type="text" name="txtNombre" placeholder="<?php echo Texto::idioma("Nombre");?>" maxlength="100" value="<?php echo Texto::idioma($suscripcion->getNombre());?>" autofocus="autofocus">
			</div>
			<div class="form-group">
				<label for="txtCorreo" class=""><?php echo Texto::idioma("Correo");?></label> 
								<input id="txtCorreo" class="required email form-control" type="text" name="txtCorreo" placeholder="<?php echo Texto::idioma("Correo");?>" maxlength="100" value="<?php echo Texto::idioma($suscripcion->getCorreo());?>">
			</div>
			<div class="form-group">
				<input id="txtIdSuscripcion" class="required" type="hidden" name="txtIdSuscripcion" value="<?php echo $idSuscripcion;?>">
				<button type="submit" class="btn btn-success"><?php echo Texto::idioma("Enviar");?></button>
				<button type="button" class="btn btn-default" onclick="javascript:irA('<?php echo base_url()."suscripcion";?>');"><?php echo Texto::idioma("Cancelar");?></button>
			</div>
		</form>
	</div>
</div> 