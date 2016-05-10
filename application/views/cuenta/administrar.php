<script type="text/javascript">
	$(document).ready(function() { 
		toogleBoton("M", "btnFunAgregar", "<?php echo base_url()."cuenta/registrar";?>");
	});
</script>

<div class="table-responsive">
		<table class="table no-border hover">
			<thead class="no-border">
				<tr>
					<th class="grd"></th>
					<th class="grd"><?php echo Texto::idioma("Nombre", IDIOMA);?></th>
					<th class="grd"><?php echo Texto::idioma("Tipo_Cuenta", IDIOMA);?></th>
					<th class="grd"><?php echo Texto::idioma("Estatus", IDIOMA);?></th>
					<th class="grd text-center"><?php echo Texto::idioma("Accion", IDIOMA);?></th>
				</tr>	
			</thead>
			<tbody class="no-border-y">
				<?php 
					for ($indice = 0; $indice < count($listaCuenta); $indice++) {									
						$posicion = $indice + 1;
						$color = "";
						if ($posicion%2 != 0) {
							$color = "class=color1";	
						} else {
							$color = "class=color2";	
						}
						$id = Encryption::encode($listaCuenta[$indice]->getIdCuenta());
						$estado = ($listaCuenta[$indice]->getEstatus() == "A") ? "<button type='button' class='btn btn-xs btn-success'><i class='fa fa-check'></i></button>" : (($listaCuenta[$indice]->getEstatus() == "P") ? "<button type='button' class='btn btn-xs btn-warning'><i class='fa fa-clock-o'></i></button>" : "<button type='button' class='btn btn-xs btn-danger'><i class='fa fa-times'></i></button>");
						$modificar = "<a href='".base_url()."cuenta/modificar/{$id}'><img title='".Texto::idioma('Modificar')."' src='".IMAGEICON."icn_edit.png'></a>";
						$cambiarEstatus = "<a href='".base_url()."cuenta/cambiarestatus/{$id}/{$listaCuenta[$indice]->getEstatus()}'><img title='".Texto::idioma('Cambiar_Estatus')."' src='".IMAGEICON."icn_trash.png'></a>";
						$tipoCuenta = ($listaCuenta[$indice]->getIdTipoCuenta() == 1) ? '<button type="button" class="btn btn-xs btn-default btn-facebook bg"><i class="fa fa-facebook"></i></button>' : '<button type="button" class="btn btn-xs btn-default btn-twitter bg"><i class="fa fa-twitter">';
					?>
						<tr <?php echo $color;?>>
							<td><?php echo $posicion;?></td>
							<td><?php echo Texto::idioma($listaCuenta[$indice]->getDescripcion());?></td>
							<td><?php echo $tipoCuenta;?></td>
							<td><?php echo $estado;?></td>
							<td><?php echo $modificar;?> <?php echo $cambiarEstatus;?></td>
						</tr>
					<?php
					}
				?>
			</tbody>
		</table>
</div>