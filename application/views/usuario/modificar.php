<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');
?>
       <script type="text/javascript">
	       $(document).ready(function() {
				$("#frmUsuario").validate();
				
			});	
		</script>

<form id="frmUsuario" class="form-horizontal" action="#" style="border-radius: 0px;" method="post">
	<div class="form-group">
		<?php if ($mensaje != "") {?>		
			<div id="divErrorGenerado"  class="col-md-12 alert alert-danger alert-white rounded"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button><div class="icon"><i class="fa fa-times-circle"></i></div><strong><?php echo Texto::idioma("Error");?>!</strong> <?php echo Texto::idioma($mensaje);?></div>
		<?php }?>	
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtUsuario"><?php echo Texto::idioma("Usuario", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="text" id="txtUsuario" name="txtUsuario" class="required ancho300 form-control" placeholder="<?php echo Texto::idioma("Usuario");?>" minlength="1" maxlength="100" value="<?php echo $usuario->getUsuario(); ?>" autofocus>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtNombre"><?php echo Texto::idioma("Nombre", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="text" id="txtNombre" name="txtNombre" class="required ancho300 form-control" placeholder="<?php echo Texto::idioma("Nombre");?>" minlength="1" maxlength="100" value="<?php echo $usuario->getNombre(); ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtApellido"><?php echo Texto::idioma("Apellido", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="text" id="txtApellido" name="txtApellido" class="required ancho300 form-control" placeholder="<?php echo Texto::idioma("Apellido");?>" minlength="1" maxlength="100" value="<?php echo $usuario->getApellido(); ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtCorreo"><?php echo Texto::idioma("Correo", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="text" id="txtCorreo" name="txtCorreo" class="required ancho300 email form-control" placeholder="<?php echo Texto::idioma("Correo");?>" minlength="1" maxlength="100" value="<?php echo $usuario->getCorreo(); ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="drpdRol"><?php echo Texto::idioma("Rol", IDIOMA);?></label>
		<div class="col-sm-6">
			<select class="required ancho300 form-control" id="drpdRol" name="drpdRol">
			<?php
				for ($indice = 0; $indice < count($listaRol); $indice++) {
					echo "<option value='{$listaRol[$indice]->getIdRol()}'>{$listaRol[$indice]->getNombre()}</option>";												
				}
			?>
			</select>
			<script> $("#drpdRol").val('<?php echo $idRol;?>');</script>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="drpdEstatus"><?php echo Texto::idioma("Estatus", IDIOMA);?></label>
		<div class="col-sm-6">
			<select id="drpdEstatus" name="drpdEstatus" class="ancho300 form-control">
				<option value="A"><?php echo Texto::idioma("Activo", IDIOMA);?></option>
				<option value="I"><?php echo Texto::idioma("Inactivo", IDIOMA);?></option>
				<option value="P"><?php echo Texto::idioma("Pendiente", IDIOMA);?></option>
			</select>
			<script> $("#drpdEstatus").val('<?php echo $usuario->getEstatus();?>');</script>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label" for="txtComentario"><?php echo Texto::idioma("Comentario", IDIOMA);?>
		</label>
		<div class="col-sm-6">
			<input type="text" id="txtComentario" name="txtComentario" class="ancho500 form-control" placeholder="<?php echo Texto::idioma("Comentario")?>" minlength="1" maxlength="500" value="<?php echo $usuario->getComentario(); ?>"/>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="hidden" id="txtIdUsuario" name="txtIdUsuario" class=" ancho200 form-control" minlength="1" maxlength="100" value ="<?php echo $usuario->getIdUsuario();?>" />
			<button type="submit" class="btn btn-primary"> <?php echo Texto::idioma("Salvar", IDIOMA);?></button> 
			<a href="<?php echo base_url()."usuario/administrar";?>"><button id="btnCancelar" type="button" class="btn btn-default"><?php echo Texto::idioma("Cancelar", IDIOMA);?></button></a>
		</div>
	</div>
</form>      