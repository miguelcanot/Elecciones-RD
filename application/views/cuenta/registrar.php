<script type="text/javascript">
	$(document).ready(function() {
		$("#frmCuenta").validate();
	});	
</script>
<form id="frmCuenta" class="form-horizontal" action="#" style="border-radius: 0px;" method="post">
	<div class="form-group">
		<label class="col-sm-3 control-label" for="drpdTipoCuenta"><?php echo Texto::idioma("Categoria", IDIOMA);?></label>
		<div class="col-sm-6">
			<select class="required ancho300 form-control" id="drpdTipoCuenta" name="drpdTipoCuenta" autofocus>
			<?php
				foreach ($listaTipoCuenta as $tipoCuenta) {
					echo "<option value='{$tipoCuenta->getIdTipoCuenta()}'>{$tipoCuenta->getNombre()}</option>";												
				}
			?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="txtNombre" class="col-sm-3 control-label"><?php echo Texto::idioma("Nombre");?></label>
		<div class="col-sm-6">
			<input id="txtNombre" class="required form-control" type="text" name="txtNombre" placeholder="<?php echo Texto::idioma("Nombre");?>" maxlength="200"/>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button id="submit" type="submit" class="btn btn-primary"> <?php echo Texto::idioma("Salvar", IDIOMA);?></button> 
			<a href="<?php echo base_url()."cuenta";?>"><button id="btnCancelar" type="button" class="btn btn-default"><?php echo Texto::idioma("Cancelar", IDIOMA);?></button></a>
		</div>
	</div>
</form>