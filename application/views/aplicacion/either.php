<!-- ko with: frase -->
<div class="panel panel-default panel-post">
	<div class="panel-body">
		<div class="row no-margin">
			<div class="col-lg-12 no-padding">
				<section class="bg-primary subtitle">
					<h2 data-bind="html:frase"></h2>
				</section>	
			</div>
		</div>
		<div class="mPointer">
			<div class="well bg-success borderB no-margin bghSuccess mHeight-300" id="divOpcion1" data-bind="click:either.registrarRespuesta.bind($data, 1)">
				<div class="divFrase">
					<p class="fSize35" id="tOpcion1"><em data-bind="html:opcion_1"></em></p>
					<h4 class="margin-bottom-20 text-uppercase fSize30" id="fOpcion1"><?php echo Texto::idioma("Esta");?></h4>
				</div>
				<div class="divPuntuacion invisible">
					<div class="puntuacionCentrada" id="cOpcion1">
						<span class="number-big text-color3 dCount" data-from="0" data-speed="1500" data-bind="attr:{'data-to':pro1}"></span><span class="number-big">%</span>
						<br/><span class="text-color3" data-bind="html:opcion_1_total"></span><span class=""> <?php echo Texto::idioma("Votos");?></span>
						<p class="fSize20"><em data-bind="html:opcion_1"></em></p>
					</div>	
				</div>
			</div>
			<span data-bind="visible:info == ''" class="label label-info lOrIrfo" id=""><?php echo Texto::idioma("O");?></span>
			<span data-bind="click:either.mostrarInfo, visible:info != ''" class="label label-info lOrIrfo" id=""><?php echo Texto::idioma("¡");?></span>
			<div class="well bg-warning no-margin bghWarning mHeight-300" id="divOpcion2" data-bind="click:either.registrarRespuesta.bind($data, 2)">
				<div class="divFrase">
					<p class="fSize35" id="tOpcion2"><em data-bind="html:opcion_2"></em></p>
					<h4 class="margin-bottom-20 text-uppercase fSize30" id="fOpcion2"><?php echo Texto::idioma("Esta");?></h4>
				</div>
				<div class="divPuntuacion invisible">
					<div class="puntuacionCentrada" id="cOpcion2">
						<span class="number-big text-color3 dCount" data-from="0" data-speed="1500" data-bind="attr:{'data-to':pro2}"></span><span class="number-big">%</span>
						<br/><span class="text-color3" data-bind="html:opcion_2_total"></span><span class=""> <?php echo Texto::idioma("Votos");?></span>
						<p class="fSize20"><em data-bind="html:opcion_2"></em></p>
					</div>	
				</div>
			</div>
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
<script src="<?php echo VIEWMODEL;?>either.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(either, $("#divVista").get(0));
		either.id("<?php echo $id;?>");
		either.obtenerDetalle();
		either.obtenerFrase();
    });
</script>