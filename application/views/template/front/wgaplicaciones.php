<div class="widget" id="wgAplicaciones">
	<div class="panel panel-default">
		<div class="panel-heading bold"><?php echo Texto::idioma("Juega");?></div>
		<div class="panel-body">
			<!-- ko foreach:listaAplicacion -->
			<div class="card card-video" data-bind="click:aplicacion.verAplicacion, visible: $index() < 1">
				<div class="card-img">
					<a href="#"><img src="" data-bind="attr:{src:imgBlock}" alt=""></a>
				</div>
				<div class="caption">
					<h3 class="card-title"><a href="#" data-bind="html:nombre"></a></h3>
				</div>
			</div>
			<!-- /ko -->
			<!--<a href="#" class="btn btn-inverse btn-block">---</a>-->
		</div>
	</div>
</div>



<script src="<?php echo VIEWMODEL;?>aplicacion.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(aplicacion, $("#wgAplicaciones").get(0));
		aplicacion.obtenerAplicacionActivas();
    });
</script>