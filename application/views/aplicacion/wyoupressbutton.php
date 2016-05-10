<!-- ko with: frase -->
<div class="panel panel-default panel-post">
	<div class="panel-body">
		<div class="mPointer">
			<div class="well bg-info borderB no-margin bghInfo mHeight-550" id="divOpcion1">
				<div class="divFrase">
					<p class="fSize25" id="tOpcion1"><em data-bind="html:opcion_1"></em></p>
				</div>
				<div class="alert-danger alert-lg fade in margin-top-30 divFrase" id="tOpcion2">
					<h4 class="alert-title"><?php echo Texto::idioma("Pero");?>!</h4>
					<p class="fSize25" data-bind="html:opcion_2"></p>
					<button type="button" class="btn btn-success" data-bind="click:wYouPressButton.registrarRespuesta.bind($data, 2)"><?php echo Texto::idioma("No_Lo_Presionare");?></button>
				</div>
				<div class="divPuntuacion invisible col-xs-6">
					<div class="puntuacionCentrada" id="cOpcion1">
						<span class="number-big text-color3 dCount" data-from="0" data-speed="1500" data-bind="attr:{'data-to':pro1}"></span><span class="number-big">%</span>
						<br/><span class="text-color3" data-bind="html:opcion_1_total"></span><span class=""> <?php echo Texto::idioma("Si_Presionaron");?></span>
						<p class="fSize20"><em data-bind="html:opcion_1"></em></p>
					</div>	
				</div>
				<div class="divPuntuacion invisible col-xs-6">
					<div class="puntuacionCentrada" id="cOpcion2">
						<span class="number-big text-color3 dCount" data-from="0" data-speed="1500" data-bind="attr:{'data-to':pro2}"></span><span class="number-big">%</span>
						<br/><span class="text-color3" data-bind="html:opcion_2_total"></span><span class=""> <?php echo Texto::idioma("No_Presionaron");?></span>
						<p class="fSize20"><em data-bind="html:opcion_2"></em></p>
					</div>	
				</div>
			</div>
			<button class="centerButton arcade-button animated pulse infinite " id="btnOpcion1" data-bind="click:wYouPressButton.registrarRespuesta.bind($data, 1)"><span class="invisible fSize30 fColor-W" id='btnSiguiente'><?php echo Texto::idioma("Siguiente");?></span></button>
		</div>
		<div class="overlay invisible" id="lAplicacion">
			<i class="fa fa-refresh fa-spin"></i>
		</div>	
	</div>
</div>
<div id="mInfo" class="modal fade bs-modal-sm" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title"><?php echo Texto::idioma("Informacion");?></h4>
			</div>
			<div class="modal-body" data-bind="html:info"></div>
		 </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- /ko -->

<script src="<?php echo PLUGINSDEFAULT;?>easypiechart/jquery.easypiechart.min.js"></script>
<script src="<?php echo PLUGINS;?>jquery.countTo/jquery.countTo.js"></script>
<script src="<?php echo VIEWMODEL;?>wyoupressbutton.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(wYouPressButton, $("#divVista").get(0));
		wYouPressButton.id("<?php echo $id;?>");
		wYouPressButton.obtenerDetalle();
		wYouPressButton.obtenerFrase();
    });
</script>