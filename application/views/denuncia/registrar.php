<form id="frmDenuncia" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit:registrar" enctype="multipart/form-data">
	<div class="col-xs-12">
		<div class="form-group">
			<label for="IDMunicipio" class="col-sm-3 control-label"><?php echo Texto::idioma("Municipio");?></label>
			<div class="col-sm-6">
				<select id="IDMunicipio" name="IDMunicipio" data-bind="options: recinto.listaMunicipio, optionsValue:'IDMunicipio', optionsText:'Nombre', optionsCaption: '<?php echo Texto::idioma("Seleccionar");?>...', event:{change:recinto.obtenerRecinto}" class="required select2" autofocus></select>
				<span class="" data-valmsg-for="IDMunicipio" data-valmsg-replace="true"></span>
			</div>
		</div>
		<div class="form-group">
			<label for="IDRecinto" class="col-sm-3 control-label"><?php echo Texto::idioma("Recinto");?></label>
			<div class="col-sm-6">
				<select id="IDRecinto" name="IDRecinto" data-bind="options: recinto.listaRecinto, optionsValue:'IDRecinto', optionsText:'Nombre', optionsCaption: '<?php echo Texto::idioma("Seleccionar");?>...'" class="required select2"></select>
				<span class="" data-valmsg-for="IDRecinto" data-valmsg-replace="true"></span>
			</div>
		</div>
		<div class="form-group">
			<label for="Denunciante" class="col-sm-3 control-label"><?php echo Texto::idioma("Identificate");?></label>
			<div class="col-sm-6">
				<input id="Denunciante" class="form-control" type="text" name="Denunciante" placeholder="<?php echo Texto::idioma("Identificate");?>" maxlength="100" />
				<span class="" data-valmsg-for="Denunciante" data-valmsg-replace="true"></span>
			</div>
		</div>
		<div class="form-group">
			<label for="Mesa" class="col-sm-3 control-label"><?php echo Texto::idioma("Mesa");?></label>
			<div class="col-sm-6">
				<input id="Mesa" class="form-control" type="text" name="Mesa" placeholder="<?php echo Texto::idioma("Mesa");?>" maxlength="10" />
				<span class="" data-valmsg-for="Mesa" data-valmsg-replace="true"></span>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-8 col-md-offset-2" data-bind="foreach:listaTipoDenuncia">
		<div class="bs-callout bs-callout-info"> 
		<input type="checkbox" name="tipoDenuncia[]" data-bind="value:IDTipoDenuncia"/>
		<label><span></span><h4 data-bind="html:Nombre"></h4></label>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="form-group">
			<label for="Comentario" class="col-sm-3 control-label"><?php echo Texto::idioma("Comentario");?></label>
			<div class="col-sm-6">
				<input id="Comentario" class="form-control" type="text" name="Comentario" placeholder="<?php echo Texto::idioma("Comentario");?>" maxlength="500" />
				<span class="" data-valmsg-for="Comentario" data-valmsg-replace="true"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="imagen"><?php echo Texto::idioma("Imagen");?></label>
			<div class="col-sm-6">
				<input type="file" name='imagen' id='imagen' class="form-control invisible file" />
				<button type="button" class="btn btn-block btn-info btn-lg" id="btnImagen"><i class='fa fa-picture-o'></i></button>
				<span id="rutaImagen"></span>
			</div>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="form-group">
			<div class="col-md-6 col-md-offset-3">
				<button id="btnGuardar" type="submit" class="btn btn-success btn-block btn-lg" data-loading-text="<?php echo Texto::idioma("Enviando");?>"><?php echo Texto::idioma("Enviar");?></button>
			</div>
		</div>
	</div>
</form>
 <!-- Loading (remove the following to stop the loading)-->
<div class="overlay invisible" id="lDenuncia">
  <i class="fa fa-refresh fa-spin"></i>
</div>
<!-- end loading -->

<link rel="stylesheet" href="<?php echo PLUGINS;?>select2/select2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo PLUGINS;?>select2/select2.min.js" ></script>
<script src="<?php echo VIEWMODEL;?>denuncia.min.js"></script>
<script src="<?php echo VIEWMODEL;?>recinto.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(denuncia, $("#divVista").get(0));
		denuncia.obtenerTipoDenuncia();
		recinto.obtenerMunicipio();
        app.menuActivo("mDenuncia");   
		botonImagen("imagen", "btnImagen", "rutaImagen");
		$(".select2").select2({
          width: '100%'
        });
    });
</script>