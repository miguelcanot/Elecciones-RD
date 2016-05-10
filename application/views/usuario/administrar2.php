<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');
?>
<script type="text/javascript">
$(document).ready(function() { 
	toogleBoton("M", "btnFunAgregar", "<?php echo base_url()."usuario/registrar";?>");
});
</script>

<div class="table-responsive">
		<table class="table no-border hover">
			<thead class="no-border">
				<tr>
					<th class="grd"></th>
					<th class="grd"><?php echo Texto::idioma("Usuario", IDIOMA); ?></th>
					<th data-hide="phone" class="grd"><?php echo Texto::idioma("Nombre"); ?></th>
					<th data-hide="phone" class="grd"><?php echo Texto::idioma("Apellido"); ?></th>
					<th data-hide="phone,tablet" class="grd"><?php echo Texto::idioma("Correo"); ?></th>
					<th data-hide="phone,tablet" class="grd"><?php echo Texto::idioma("Fecha Crea"); ?></th>
					<th data-hide="phone,tablet" class="grd"><?php echo Texto::idioma("Comentario"); ?></th>
					<th class="grd"><?php echo Texto::idioma("Estatus"); ?></th>
					<th class="grd text-center"><?php echo Texto::idioma("Accion");?></th>
				</tr>	
			</thead>
			<tbody class="no-border-y">
				<?php 
					for ($indice = 0; $indice < count($listaUsuario); $indice++) {
						$posicion = $indice + 1;
						$color = "";
						if ($posicion%2 != 0) {
							$color = "class=color1";
						} else {
							$color = "class=color2";
						}
						$id = Encryption::encode($listaUsuario[$indice]->getIdUsuario());
						$modificar = "<a href='".base_url()."usuario/modificar/{$id}'><img title='".Texto::idioma('Modificar')."' src='".IMAGEICON."icn_edit.png'></a>";
						
						$estado = ($listaUsuario[$indice]->getEstatus() == "A") ? "<a class='label label-success' href='#'><i class='fa fa-check'></i></a>" : (($listaUsuario[$indice]->getEstatus() == "P") ? "<a class='label label-warning' href='#'><i class='fa fa-clock-o'></i></a>" : "<a class='label label-danger' href='#'><i class='fa fa-times'></i></a>");
						echo "<tr {$color} onclick=javascript:irA('".base_url()."campana/modificar/{$id}')>";
						echo "<td {$color}><a href=".base_url()."usuario/modificar/{$id}>{$posicion}</a></td>";
						echo "<td {$color}><a href=".base_url()."usuario/modificar/{$id}>{$listaUsuario[$indice]->getUsuario()}</a></td>";
						echo "<td {$color}><a href=".base_url()."usuario/modificar/{$id}>{$listaUsuario[$indice]->getNombre()}</a></td>";
						echo "<td {$color}><a href=".base_url()."usuario/modificar/{$id}>{$listaUsuario[$indice]->getApellido()}</a></td>";
						echo "<td {$color}><a href=".base_url()."usuario/modificar/{$id}>{$listaUsuario[$indice]->getCorreo()}</a></td>";
						echo "<td {$color}><a href=".base_url()."usuario/modificar/{$id}>{$listaUsuario[$indice]->getFechaCrea()}</a></td>";
						echo "<td {$color}><a href=".base_url()."usuario/modificar/{$id}>{$listaUsuario[$indice]->getComentario()}</a></td>";
						echo "<td {$color}><a href=".base_url()."usuario/modificar/{$id}>{$estado}</a></td>";
						echo '<td class="text-center"> <a class="label label-danger" href="#"><i class="fa fa-trash-o"></i></a></td>';
						echo "<tr/>";
						
					}
				?>
			</tbody>
		</table>
</div>