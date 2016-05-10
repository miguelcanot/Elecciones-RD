<?php
if ( ! defined('APPPATH')) exit('No direct script access allowed');
?>

		<div class="col-lg-8">
			<?php if ($estatus == "B") {?>
				<div class="bs-callout bs-callout-successs">
					<h2 class="centrado"><?php echo Texto::idioma("Suscripcion_Exitosa");?></h2>
				</div>
				<div class="bs-callout bs-callout-info">
					<p class="tBlanco"><?php echo Texto::idioma("Mensaje_Suscripcion");?></p>
				</div>
			<?php } else if ($estatus == "EC") {?>
				<div class="bs-callout bs-callout-danger">
					<h2 class="centrado"><?php echo Texto::idioma("Error_Correo");?></h2>
				</div>
				<div class="bs-callout bs-callout-danger">
					<p class="tBlanco"><?php echo Texto::idioma("Mensaje_Suscripcion_Error_Correo");?></p>
				</div>
			<?php } else {?>
				<div class="bs-callout bs-callout-successs">
					<h2 class="centrado"><?php echo Texto::idioma("Suscripcion_Exitosa");?></h2>
				</div>
				<div class="bs-callout bs-callout-info">
					<p class="tBlanco"><?php echo Texto::idioma("Mensaje_Suscripcion");?></p>
				</div>
			<?php }?>
		</div>

<div class="marginTop250"></div>