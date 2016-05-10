<div class="login-box">
    <div class="login-logo">
        <?php $config = $this->session->userdata("sConfiguracion");?>
        <a href="#"><b><?php echo $config->empresa;?></b></a>
    </div><!-- /.login-logo -->
    <div id="divCambiarContrasena">
        <div class="login-box-body">
            <p class="login-box-msg"><?php echo Texto::idioma("Contrasena_Nueva");?></p>
            <form id="frm" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit: cambiarContrasenaRecuperada">
                <div id="divMensajeS" class="invisible alert alert-success"></div>
                <div id="divMensajeE" class="invisible alert alert-danger"></div>
                <div data-bind="visible:contrasenaCambiada() == false">
	                <div class="form-group has-feedback">
	                    <input class="form-control required" placeholder="<?php echo Texto::idioma("Contrasena");?>" name="contrasena" id="contrasena" maxlength="100" type="password" value="" autocomplete="off" autofocus>
	                    <span class='form-control-feedback'><i class='fa fa-lock'></i></span>
	                    <span class="" data-valmsg-for="contrasena" data-valmsg-replace="true"></span>
	                </div>
	                <div class="form-group has-feedback">
	                    <input class="form-control required" placeholder="<?php echo Texto::idioma("Confirmar_Contrasena");?>" name="contrasenaConfirmar" id="contrasenaConfirmar" equalto="#contrasena" maxlength="100" type="password" value="" autocomplete="off">
	                    <span class='form-control-feedback'><i class='fa fa-lock'></i></span>
	                    <span class="" data-valmsg-for="contrasenaConfirmar" data-valmsg-replace="true"></span>
	                </div>
	                <div class="row">
	                    <div class="col-xs-6">

	                    </div><!-- /.col -->
	                    <div class="col-xs-6">
	                    	<input type="hidden" name="token" value="<?php echo $token;?>"/>
	                        <button type="submit" id="btnEnviar" class="btn btn-primary btn-block btn-flat" data-loading-text="<?php echo Texto::idioma("Verificando");?>..."><?php echo Texto::idioma("Enviar");?></button>
	                    </div><!-- /.col -->
	                </div>
	            </div>
	            <div data-bind="visible:contrasenaCambiada">
	            	<button data-bind="click:btnSesion" type="button" class="btn btn-info btn-block btn-flat" ><?php echo Texto::idioma("Iniciar_Sesion");?></button>
	            </div>
            </form>
        </div><!-- /.login-box-body -->
    </div>
</div><!-- /.login-box -->
<script src="<?php echo VIEWMODEL;?>app.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(app, $("#divVista").get(0));
	});	
</script>