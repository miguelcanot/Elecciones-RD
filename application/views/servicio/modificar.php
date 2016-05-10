<script type="text/javascript">
	$(document).ready(function() {
		$("#frmServicio").validate();
	});	
</script>
		<form id="frmServicio" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="txtNombre" class="col-sm-3 control-label"><?php echo Texto::idioma("Nombre");?></label>
				<div class="col-sm-6">
					<input id="txtNombre" class="required form-control" type="text" name="txtNombre" placeholder="<?php echo Texto::idioma("Nombre");?>" value="<?php echo Texto::idioma($servicio->getNombre());?>" autofocus/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="txtDescripcion"><?php echo Texto::idioma("Descripcion", IDIOMA);?></label>
				<div class="col-sm-6">
					<input id="txtDescripcion" class="form-control" type="text" name="txtDescripcion" placeholder="<?php echo Texto::idioma("Descripcion");?>" maxlength="2000" value="<?php echo Texto::idioma($servicio->getDescripcion());?>"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="txtIcono"><?php echo Texto::idioma("Icono", IDIOMA);?></label>
				<div class="col-sm-6">
					<input id="txtIcono" class="form-control" type="text" name="txtIcono" placeholder="<?php echo Texto::idioma("Icono");?>" maxlength="50" value="<?php echo Texto::idioma($servicio->getIcono());?>"/>
				</div>
			</div>
			<div class="form-group">
				<label for="txtEntorno" class="col-sm-3 control-label"><?php echo Texto::idioma("Imagen");?></label>
				<div class="col-sm-6">
					<button type="button" class="btnImagen btn btn-block btn-primary" onclick=document.getElementById("txtImagen").click();><i class="fa fa-picture-o"></i></button>
					<input type="file" name="txtImagen" id="txtImagen" class="form-control invisible"/>
				</div>
			</div>
			<div class="form-group">
				<label for="txtComentario" class="col-sm-3 control-label"><?php echo Texto::idioma("Comentario");?></label>
				<div class="col-sm-6">
					<input id="txtComentario" class="form-control" type="text" name="txtComentario" placeholder="<?php echo Texto::idioma("Comentario");?>" maxlength="500" value="<?php echo Texto::idioma($servicio->getComentario());?>"/>
				</div>
			</div>
			<div id="divImagen" class="col-sm-offset-3 col-sm-6"></div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input id="txtIdServicio" class="required" type="hidden" name="txtIdServicio" value="<?php echo $idServicio;?>">
					<button id="submit" type="submit" class="btn btn-primary"> <?php echo Texto::idioma("Salvar", IDIOMA);?></button> 
					<a href="<?php echo base_url()."servicio";?>"><button id="btnCancelar" type="button" class="btn btn-default"><?php echo Texto::idioma("Cancelar", IDIOMA);?></button></a>
				</div>
			</div>
		</form>