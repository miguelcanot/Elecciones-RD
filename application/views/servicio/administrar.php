<script type="text/javascript">
	$(document).ready(function() { 
		toogleBoton("M", "btnFunAgregar", "<?php echo base_url()."servicio/registrar";?>");
	});
</script>

			<div class="table-responsive">
				<table class="table no-border hover"
					id="tabla">
					<thead class="no-border">
						<tr>
							<th></th>
							<th><?php echo Texto::idioma("Nombre");?></th>
							<th data-hide="phone"><?php echo Texto::idioma("Descripcion");?></th>
							<th data-hide="phone"><?php echo Texto::idioma("Icono");?></th>
							<th><?php echo Texto::idioma("Estatus");?></th>
							<th></th>
						</tr>
					</thead>
					<tbody class="no-border-y">
					<?php
						$indice = 0;
						foreach ($listaServicio as $servicio) {
							$posicion = $indice + 1;
							$color = ($posicion%2 != 0) ? "class=color1" : "class=color2";
							$estatus = ($servicio->getEstatus() == "A") ? "<a class='label label-success' href='#'><i class='fa fa-check'></i></a>" : (($servicio->getEstatus() == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>");
							$id = Encryption::encode($servicio->getIdServicio());
							$modificar = "<a href='".base_url()."servicio/modificar/{$id}'><img title='".Texto::idioma('Modificar')."' src='".IMAGEICON."icn_edit.png'></a>";
							$cambiarEstatus = "<a href='".base_url()."servicio/cambiarestatus/{$id}/{$servicio->getEstatus()}'><img title='".Texto::idioma('Cambiar_Estatus')."' src='".IMAGEICON."icn_trash.png'></a>";

						?>
						<tr <?php echo $color;?>>
							<td><?php echo ++$indice;?></td>
							<td><?php echo Texto::idioma($servicio->getNombre());?></td>
							<td><?php echo Texto::idioma($servicio->getDescripcion());?></td>
							<td><?php echo Texto::idioma($servicio->getIcono());?></td>
							<td><?php echo $estatus;?></td>
							<td><?php echo $modificar;?> <?php echo $cambiarEstatus;?></td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
			<!-- /.table-responsive -->
