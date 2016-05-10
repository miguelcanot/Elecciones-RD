<div class="row">
    <div class="col-xs-12 col-lg-12">
        <h1><?php echo Texto::idioma("Contrasena_Nueva");?></span><span class="special-color">.</span></h1>
        <h5 class="subtitle-margin"><?php echo Texto::idioma("Contrasena_Parametro");?></h5>
        <div class="title-separator-primary"></div>
    </div>
</div>
<div class="row margin-top-60">
    <div class="col-xs-12 col-sm-12">
        <form id="frm" class="form-horizontal" name="contact-from" action="#" data-bind="submit:cambiarContrasenaRecuperadaF">
        	<div data-bind="visible:contrasenaCambiada() == false" class="col-xs-12">
				<div class="form-group has-feedback">
					<label for="contrasena" class="col-sm-3 control-label"><?php echo Texto::idioma("Contrasena");?></label>
					<div class="col-sm-6">
						<input class="form-control required" placeholder="<?php echo Texto::idioma("Contrasena");?>" name="contrasena" id="contrasena" maxlength="100" type="password" value="" autocomplete="off" autofocus>
	                    <span class="" data-valmsg-for="contrasena" data-valmsg-replace="true"></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					<label for="contrasenaConfirmar" class="col-sm-3 control-label"><?php echo Texto::idioma("Confirmar_Contrasena");?></label>
					<div class="col-sm-6">
						<input class="form-control required" placeholder="<?php echo Texto::idioma("Confirmar_Contrasena");?>" name="contrasenaConfirmar" id="contrasenaConfirmar" equalto="#contrasena" maxlength="100" type="password" value="" autocomplete="off">
	                    <span class="" data-valmsg-for="contrasenaConfirmar" data-valmsg-replace="true"></span>
					</div>
				</div>
            	<div class="form-group">
            		<button id="btnEnviar" type="submit" class="btn btn-flat button-primary button-shadow pull-right" data-loading-text="<?php echo Texto::idioma("Verificando");?>...">
	                    <span><?php echo Texto::idioma("Enviar");?></span>
	                    <div class="button-triangle"></div>
	                    <div class="button-triangle2"></div>
	                    <div class="button-icon"><i class="fa fa-paper-plane"></i></div>
	                </button>
	                <div class="clearfix"></div>
            		<input type="hidden" name="token" value="<?php echo $token;?>"/>
                </div>
            </div>
            <div data-bind="visible:contrasenaCambiada">
            	<div class="col-xs-6">
            		<a href="#" data-bind="click:btnInicio" class="button-primary">
                        <span><?php echo Texto::idioma("Iniciar_Sesion");?></span>
                        <div class="button-triangle"></div>
                        <div class="button-triangle2"></div>
                        <div class="button-icon"><i class="fa fa-search"></i></div>
                    </a>
            	</div>
            </div>
        </form>
    </div>
</div>
<script src="<?php echo VIEWMODEL;?>app.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(app, $("#divVista").get(0));
	});	
</script>