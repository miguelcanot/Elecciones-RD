<link rel="stylesheet" type="text/css" href="<?php echo PLUGINS;?>select2/select2.min.css" />

<div class="row">
	<div class="col-xs-12">
		<h5 class="subtitle-margin"><?php echo Texto::idioma("Editar");?></h5>
		<h1><?php echo Texto::idioma("Perfil");?><span class="special-color">.</span></h1>
		<div class="title-separator-primary"></div>
	</div>
</div>	
<div>
	<form id="frmPerfil" class="" action="#" style="border-radius: 0px;" method="post" enctype="multipart/form-data" data-bind="submit:guardar">
		<div class="row margin-top-60">
			<div class="col-xs-6 col-xs-offset-3 col-sm-offset-0 col-sm-3 col-md-4">	
				<div class="agent-photos">
					<img data-bind="attr:{src:imagenActual}" id="agent-profile-photo" class="img-responsive" alt="" />
					<div class="change-photo">
						<i class="fa fa-pencil fa-lg" id="btnImagen"></i>
						<input type="file" name="imagen" id="imagen" />
					</div>
					<input type="text" id="rutaImagen" data-binds="html:imagen" class="form-control fileName" />
				</div>
			</div>
			<div class="col-xs-12 col-sm-9 col-md-8">
				<div class="labelled-input">
					<label for="nombre"><?php echo Texto::idioma("Nombre");?></label><input type="text" id="nombre" name="nombre" class="required form-control" placeholder="<?php echo Texto::idioma("Nombre");?>" minlength="2" maxlength="100" data-bind="value:nombre" autofocus/>
					<div class="clearfix"></div>
				</div>
				<div class="labelled-input">
					<label for="apellido"><?php echo Texto::idioma("Apellido");?></label><input type="text" id="apellido" name="apellido" class="required form-control" placeholder="<?php echo Texto::idioma("Apellido");?>" minlength="2" maxlength="100" data-bind="value:apellido"/>
					<div class="clearfix"></div>
				</div>
				<div class="labelled-input">
					<label for="correo"><?php echo Texto::idioma("Correo");?></label><input disabled="disabled" type="text" id="correo" name="correo" class="email form-control" placeholder="<?php echo Texto::idioma("Correo");?>" minlength="1" maxlength="100" data-bind="value:correo"/>
					<div class="clearfix"></div>
				</div>
				<div class="labelled-input">
					<label for="url"><?php echo Texto::idioma("Url");?></label><input type="text" id="url" name="url" class="required form-control" placeholder="<?php echo Texto::idioma("Url");?>" minlength="2" maxlength="100" data-bind="value:url"/>
					<div class="clearfix"></div>
				</div>
				<div class="labelled-input">
					<label for="telefono"><?php echo Texto::idioma("Telefono");?></label><input id="telefono" class="form-control digits" type="text" name="telefono" placeholder="<?php echo Texto::idioma("Telefono");?>"  data-bind="value:telefono" minlength="9" maxlength="15"/>
					<div class="clearfix"></div>
				</div>
				<div class="labelled-input last">
					<label for="address"><?php echo Texto::idioma("Direccion");?></label><input id="direccion" class="form-control" type="text" name="direccion" placeholder="<?php echo Texto::idioma("Direccion");?>"  data-bind="value:direccion" minlength="5" maxlength="100"/>
					<div class="clearfix"></div>
				</div>
				<div class="labelled-input last">
					<label for="fechaNacimiento"><?php echo Texto::idioma("Fecha_Nacimiento");?></label><input id="fechaNacimiento" class="calendario form-control" type="text" name="fechaNacimiento" placeholder="<?php echo Texto::idioma("Fecha_Nacimiento");?>"  data-bind="value:fechaNacimiento"/>
					<div class="clearfix"></div>
				</div>
				<div class="labelled-input last">
					<label for="sexo"><?php echo Texto::idioma("Sexo");?></label>
					<select id="sexo" name="sexo" class="form-control">
						<option value="F"><?php echo Texto::idioma("Femenino");?></option>
						<option value="M"><?php echo Texto::idioma("Masculino");?></option>
					</select>
					<div class="clearfix"></div>
				</div>
				<div class="labelled-input last">
					<label for="celular"><?php echo Texto::idioma("Celular");?></label><input id="celular" class="form-control digits" type="text" name="celular" placeholder="<?php echo Texto::idioma("Celular");?>"  data-bind="value:celular"  minlength="9" maxlength="15"/>
					<div class="clearfix"></div>
				</div>
				<div class="labelled-input last">
					<label for="address"><?php echo Texto::idioma("Estado_Civil");?></label>
					<select id="estadoCivil" name="estadoCivil" class="form-control">
						<option value="S"><?php echo Texto::idioma("Soltera(o)");?></option>
						<option value="C"><?php echo Texto::idioma("Casada(o)");?></option>
					</select>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="row margin-top-15">
			<div class="col-xs-12">
				<div class="labelled-textarea">
					<label for="bio"><?php echo Texto::idioma("Bio");?></label>
					<textarea id="bio" name="bio" class="form-control" placeholder="<?php echo Texto::idioma("Bio");?>" data-bind="value:bio"></textarea>
				</div>
			</div>
		</div>
		<div class="row margin-top-30" data-bind="foreach:listaTipoCuenta">
			<div class="col-xs-12 col-lg-6">
				<div class="labelled-input-short">
					<label for="">
						<span class="label-icon-circle pull-left">
							<i data-bind="css:'fa fa-'+descripcion"></i>
						</span>
						<span data-bind="html:nombre"></span>
					</label>
					<input type="text" class="input-full main-input" data-bind="attr:{name:'tipoCuenta['+IDtipo_cuenta+']', id:'tipoCuenta-'+IDtipo_cuenta, placeholder:nombre}"/>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		<div class="row margin-top-30">
			<div class="col-xs-12">
				<div class="info-box">
					<p><?php echo Texto::idioma("Mensaje_Compartir_Datos");?></p>
					<div class="small-triangle"></div>
					<div class="small-icon"><i class="fa fa-info fa-lg"></i></div>
				</div>
			</div>
		</div>

		<div class="row margin-top-30">
			<div class="col-xs-12 col-lg-6">
				<div class="labelled-input-short">
					<label for="compartirCelular">
						<span class="label-icon-circle pull-left">
							<i class="fa fa-phone"></i>
						</span>
						<?php echo Texto::idioma("Celular");?>
					</label>
					<div class="input-full main-input" data-toggle="buttons">
					  <label class="btn btn-radio btn-flat" id="compartirCelularSLabel">
					    <input type="radio" name="compartirCelular" id="compartirCelularS" autocomplete="off" value="1"> <?php echo Texto::idioma("Si");?>
					  </label>
					  <label class="btn btn-radio btn-flat" id="compartirCelularNLabel">
					    <input type="radio" name="compartirCelular" id="compartirCelularN" autocomplete="off" value="0"> <?php echo Texto::idioma("No");?>
					  </label>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-xs-12 col-lg-6">
				<div class="labelled-input-short">
					<label for="compartirCorreoSLabel">
						<span class="label-icon-circle pull-left">
							<i class="fa fa-envelope"></i>
						</span>
						<?php echo Texto::idioma("Correo");?>
					</label>
					<div class="input-full main-input" data-toggle="buttons">
					  <label class="btn btn-radio btn-flat" id="compartirCorreoSLabel">
					    <input type="radio" name="compartirCorreo" id="compartirCorreoS" autocomplete="off" value="1"> <?php echo Texto::idioma("Si");?>
					  </label>
					  <label class="btn btn-radio btn-flat" id="compartirCorreoNLabel">
					    <input type="radio" name="compartirCorreo" id="compartirCorreoN" autocomplete="off" value="0"> <?php echo Texto::idioma("No");?>
					  </label>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		<div class="row margin-top-30">
			<div class="col-xs-12">
				<div class="info-box">
					<p><?php echo Texto::idioma("Mensaje_Cambiar_Contrasena");?></p>
					<div class="small-triangle"></div>
					<div class="small-icon"><i class="fa fa-info fa-lg"></i></div>
				</div>
			</div>
		</div>
		<div class="row margin-top-15">
			<div class="col-xs-12 col-lg-12">
				<div class="labelled-input-short">
					<label for="contrasenaAnterior"><?php echo Texto::idioma("Contrasena_Anterior");?></label>
					<input type="password" id="contrasenaAnterior" name="contrasenaAnterior" class="form-control" placeholder="<?php echo Texto::idioma("Contrasena_Anterior");?>" minlength="3" maxlength="100">
					<span class="field-validation-error" data-valmsg-for="contrasenaAnterior" data-valmsg-replace="true"></span>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-xs-12 col-lg-12">
				<div class="labelled-input-short">
					<label for="contrasena"><?php echo Texto::idioma("Contrasena_Nueva");?></label>
					<input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="<?php echo Texto::idioma("Clave_Parametro");?>" minlength="3" maxlength="100">
					<span class="field-validation-error" data-valmsg-for="contrasena" data-valmsg-replace="true"></span>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-xs-12 col-lg-12">
				<div class="labelled-input-short">
					<label for="confirmarContrasena"><?php echo Texto::idioma("Confirmar_Contrasena_Nueva");?></label>
					<input type="password" id="confirmarContrasena" name="confirmarContrasena" class="form-control" equalto="#contrasena" placeholder="<?php echo Texto::idioma("Confirmar_Contrasena_Nueva");?>" minlength="3" maxlength="100">
					<span class="field-validation-error" data-valmsg-for="confirmarContrasena" data-valmsg-replace="true"></span>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="row margin-top-15">
			<div class="col-xs-12">
				<div class="center-button-cont center-button-cont-border">
					<button id="btnGuardar" type="submit" class="btn btn-flat button-primary button-shadow " data-loading-text="<?php echo Texto::idioma("Enviando");?>...">
		                <span><?php echo Texto::idioma("Enviar");?></span>
		                <div class="button-triangle"></div>
		                <div class="button-triangle2"></div>
		                <div class="button-icon"><i class="fa fa-lg fa-floppy-o"></i></div>
		            </button>
				</div>
			</div>
		</div>
	</form>
	<div class="overlay invisible" id="lPerfil">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div>
<div class="row margin-top-60"></div>

<script src="<?php echo VIEWMODEL;?>perfil.min.js"></script>
<link rel="stylesheet" href="<?php echo PLUGINS;?>datepicker/bootstrap-datetimepicker.css" type="text/css">
<script type="text/javascript" src="<?php echo PLUGINS;?>moment/moment.min.js" ></script>
<script type="text/javascript" src="<?php echo PLUGINS;?>datepicker/bootstrap-datetimepicker.js" ></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(perfil, $("#divVista").get(0));
		perfil.obtenerContenido();
		app.getPermisoMenu();

		$('.calendario').datetimepicker({
            viewMode: 'years',
            format: 'YYYY/MM/DD'
        }).keypress(function (event) {
            event.preventDefault();
        });
        $('#tabs').tab();
        botonImagen("imagen", "btnImagen", "rutaImagen", "I");

        $(".select2").select2({
          width: '100%'
        });
	});	
</script>
<link rel="stylesheet" href="<?php echo PLUGINS;?>select2/select2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo PLUGINS;?>select2/select2.min.js" ></script>