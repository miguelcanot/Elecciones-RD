<div class="row">
    <div class="col-xs-12 col-lg-12">
        <h1><?php echo Texto::idioma("Activacion");?></span><span class="special-color">.</span></h1>
        <div class="title-separator-primary"></div>
    </div>
</div>
<div class="row margin-top-60">
    <div class="col-md-12 text-center">
    	<div class="success-box margin-top-30">
			<p><?php echo Texto::idioma("Mensaje_Confirmacion_Cuenta");?></p>
			<div class="small-triangle"></div>
			<div class="small-icon"><i class="jfont"></i></div>
		</div>
        <button type="button" class="btn btn-flat button-primary button-shadow " data-bind="click:app.btnPerfil">
            <span><?php echo Texto::idioma("Continuar");?></span>
            <div class="button-triangle"></div>
            <div class="button-triangle2"></div>
            <div class="button-icon"><i class="fa fa-check"></i></div>
        </button>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(app, $("#divVista").get(0));
	});	
</script>