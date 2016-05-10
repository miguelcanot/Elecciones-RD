<div class="login-box">
    <div class="login-logo">
        <?php $config = $this->session->userdata("sConfiguracion");?>
        <a href="#"><b><?php echo $config->empresa;?></b></a>
    </div><!-- /.login-logo -->
    <div id="divLogin" data-bind="visible:logV">
        <div class="login-box-body">
            <p class="login-box-msg"><?php echo Texto::idioma("Iniciar_Sesion");?></p>
            <form id="frm" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit: iniciarSesion">
                <div id="divMensajeS" class="invisible alert alert-success"></div>
                <div id="divMensajeE" class="invisible alert alert-danger"></div>
                <div class="form-group has-feedback">
                    <input class="form-control required" placeholder="<?php echo Texto::idioma("Usuario");?>" name="txtUsuario" id="txtUsuario" type="text" autofocus autocomplete="off">
                    <span class='form-control-feedback'><i class='fa fa-user'></i></span>
                    <span class="" data-valmsg-for="txtUsuario" data-valmsg-replace="true"></span>
                </div>
                <div class="form-group has-feedback">
                    <input class="form-control required" placeholder="<?php echo Texto::idioma("Contrasena");?>" name="txtContrasena" id="txtContrasena" maxlength="100" type="password" value="" autocomplete="off">
                    <span class='form-control-feedback'><i class='fa fa-lock'></i></span>
                    <span class="" data-valmsg-for="txtContrasena" data-valmsg-replace="true"></span>
                </div>
                <div class="row">
                    <div class="col-xs-6">

                    </div><!-- /.col -->
                    <div class="col-xs-6">
                        <button type="submit" id="btnEnviar" class="btn btn-primary btn-block btn-flat" data-loading-text="<?php echo Texto::idioma("Verificando");?>..."><?php echo Texto::idioma("Entrar");?></button>
                    </div><!-- /.col -->
                </div>
            </form>
            <div class="social-auth-links text-center">
                <p>- O -</p>
                <!--
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
                -->
            </div><!-- /.social-auth-links -->
            <p><a href="#" data-bind="click:mostrarRecuperarContrasena"><?php echo Texto::idioma("Olvido_Su_Contrasena");?></a></p>
            <!--<a href="#" class="text-center">Register a new membership</a>-->

        </div><!-- /.login-box-body -->
    </div>
    <div id="divPass" data-bind="visible:passV">
        <div class="login-box-body">
            <p class="login-box-msg"><?php echo Texto::idioma("Recuperar_Contrasena");?></p>
            <form id="frmPass" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit: recuperarContrasena">
                <div id="divMensajeSPass" class="invisible alert alert-success"></div>
                <div id="divMensajeEPass" class="invisible alert alert-danger"></div>
                <div class="form-group has-feedback">
                    <input class="form-control required" placeholder="<?php echo Texto::idioma("Usuario");?>" name="txtUsuarioRecuperar" id="txtUsuarioRecuperar" type="text" autofocus autocomplete="off">
                    <span class='form-control-feedback'><i class='fa fa-user'></i></span>
                    <span class="" data-valmsg-for="txtUsuarioRecuperar" data-valmsg-replace="true"></span>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                            
                    </div><!-- /.col -->
                    <div class="col-xs-6">
                        <button type="submit" id="btnEnviarRecuperar" class="btn btn-primary btn-block btn-flat" data-loading-text="<?php echo Texto::idioma("Enviando");?>..."><?php echo Texto::idioma("Enviar");?></button>
                    </div><!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- O -</p>
            </div><!-- /.social-auth-links -->

            <a href="#" data-bind="click:mostrarSesion"><?php echo Texto::idioma("Iniciar_Sesion");?></a>

        </div><!-- /.login-box-body -->
    </div>
</div><!-- /.login-box -->
<script src="<?php echo VIEWMODEL;?>sesion.min.js"></script>