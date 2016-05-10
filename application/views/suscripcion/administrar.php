<script type="text/javascript">
$(document).ready(function() { 
	toogleBoton("M", "btnFunAgregar", "<?php echo base_url()."suscripcion/registrar";?>");
});

var idSuscripcionEliminar = 0;

function eliminarPool() {
	var direccion = '<?php echo HOST."suscripcion/eliminarSuscripcion/";?>'+idSuscripcionEliminar+"/";
	$('#mod-espera').modal('show');
	$.post(direccion, function(data) {
		$('#mod-espera').modal('hide');
		if (data["estado"]) {
			mostrarNotificacion("I", data["mensaje"]);
			$('#pool'+idSuscripcionEliminar).remove();
		} else {
			mostrarNotificacion("E", data["mensaje"]);
		}
		idPostAElimnar = 0;
	}, "json");
}

function mostrarAdvertencia(id) {
	idSuscripcionEliminar = id;
	$("#mod-eliminarSuscripcion").modal("show");
}
</script>

<div class="table-responsive">
		<table class="table no-border hover">
			<thead>
				<tr>
					<th></th>
					<th><?php echo Texto::idioma("Nombre");?></th>
            		<th><?php echo Texto::idioma("Correo");?></th>
            		<th><?php echo Texto::idioma("Fecha");?></th>
            		<th><?php echo Texto::idioma("Estatus");?></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php 
        			$indice = 0;
        			foreach ($listaSuscripcion as $suscripcion) { 
        				$estado = ($suscripcion->getEstatus() == "A") ? "<a class='label label-success' href='#'><i class='fa fa-check'></i></a>" : (($suscripcion->getEstatus() == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>");
        				$id = Encryption::encode($suscripcion->getIdSuscripcion());
        				$modificar = "<a href='".base_url()."suscripcion/modificar/{$id}'><img title='".Texto::idioma('Modificar')."' src='".IMAGEICON."icn_edit.png'></a>";
        				$cambiarEstatus = "<a href='".base_url()."suscripcion/cambiarestatus/{$id}/{$suscripcion->getEstatus()}'><img title='".Texto::idioma('Cambiar_Estatus')."' src='".IMAGEICON."icn_trash.png'></a>";
        		?>
        				<tr>
        					<td><?php echo ++$indice;?></td>
                			<td><?php echo Texto::idioma($suscripcion->getNombre());?></td>
                			<td><?php echo Texto::idioma($suscripcion->getCorreo());?></td>
                			<td><?php echo Texto::setFormatoFecha($suscripcion->getFecha(), "Y/m/d");?></td>
                			<td><?php echo $estado;?><span class="invisible"><?php echo $suscripcion->getEstatus();?></span></td>
                			<td><?php echo $modificar;?> <?php echo $cambiarEstatus;?></td>
                			<td class="text-center"> <a class="label label-danger" href=javascript:mostrarAdvertencia('<?php echo $id;?>');><i class="fa fa-trash-o"></i></a></td>
                		</tr>
        		<?php                 				
        			}
        		?>
			</tbody>
		</table>
</div>
 <div class="modal fade" id="mod-eliminarSuscripcion" tabindex="-1" role="dialog">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		</div>
		<div class="modal-body">
			<div class="text-center">
				<div class="i-circle warning"><i class="fa fa-warning"></i></div>
				<h4><?php echo Texto::idioma("Advertencia");?>!</h4>
				<p><?php echo Texto::idioma("Eliminar_Suscripcion");?>?</p>
			</div>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><?php echo Texto::idioma("No");?></button>
		  <button type="button" class="btn btn-warning btn-flat" data-dismiss="modal" onclick="javascript:eliminarPool();"><?php echo Texto::idioma("Si");?></button>
		</div>
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->