<section class="short-image no-padding contact-short-title">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-12 short-image-title">
				<h1 class="second-color"><?php echo Texto::idioma("Contactenos");?></h1>
				<div class="short-title-separator"></div>
			</div>
		</div>
	</div>
	
</section>

<section class="section-light section-both-shadow top-padding-45">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-6 margin-top-45">
				<p class="negative-margin"><?php echo Texto::idioma("Mensaje_Contactar");?></p>
				<img src="<?php echo IMAGE;?>logo-b.png" alt="" class="pull-left margin-top-45" />
				<address class="contact-info pull-left">
					<span data-bind="visible:webDireccion() != ''"><i class="fa fa-map-marker"></i><span data-bind="html:webDireccion"></span></span>
					<span><i class="fa fa-envelope"></i><a data-bind="html:webCorreo, attr:{href:'mailto:'+webCorreo()}"></a></span>
					<span data-bind="visible:webTelefono() != ''"><i class="fa fa-phone"></i><a data-bind="html:webTelefono, attr:{href:'tel:'+webTelefono()}"></a></span>
					<span><i class="fa fa-clock-o"></i>lun-vie: 09:00 - 17:00</span>
					<span class="span-last">sab: 10:00 - 16:00</span>
				</address>
			</div>
			<div class="col-xs-12 col-md-6 margin-top-45">
				<form name="frmContacto" id="frmContacto" action="#" method="post" data-bind="submit:enviarContacto">
					<div id="form-result"></div>
					<input name="nombre" id="nombre" type="text" class="input-short main-input required" placeholder="<?php echo Texto::idioma("Nombre");?>" />
					<input name="telefono" id="telefono" type="text" class="input-short pull-right main-input required" placeholder="<?php echo Texto::idioma("Telefono");?>" />
					<input name="correo" id="correo" type="email" class="input-full main-input required email" placeholder="<?php echo Texto::idioma("Correo");?>" />
					<textarea name="mensaje" id="mensaje" class="input-full contact-textarea main-input required" placeholder="<?php echo Texto::idioma("Mensaje");?>"></textarea>
					<div class="form-submit-cont">
						<button id="btnEnviarContacto" type="submit" class="btn btn-flat button-primary button-shadow button-full" data-loading-text="<?php echo Texto::idioma("Enviando");?>...">
	                        <span><?php echo Texto::idioma("Enviar");?></span>
	                        <div class="button-triangle"></div>
	                        <div class="button-triangle2"></div>
	                        <div class="button-icon"><i class="fa fa-save"></i></div>
	                    </button>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>
		</div>
		 <!-- Loading (remove the following to stop the loading)-->
        <div class="overlay invisible" id="lContacto">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        <!-- end loading -->
	</div>
</section>

<section class="contact-map2" id="mapaContacto">
</section>
<script src="<?php echo VIEWMODEL;?>app.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(app, $("#divVista").get(0));
		var imgPin  = imgDefault+"pin-contact.png";
		mapInit(18.485243479095566,-69.93241332963868, "mapaContacto", imgPin, false);	
	});
</script>