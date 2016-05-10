<div id="divDetalleAplicacion">
	<!-- ko with:app.detalleAplicacion -->
	<div id="wgDetalleAplicacion" class="widget widget-game" data-bind="style:{backgroundImage:'url(\'' + imgBlock + '\')'}, visible:app.detalleAplicacion() != null">
		<div class="overlay">
			<div class="title" data-bind="html:nombre"></div>
			<div class="description">
				<p data-bind="html:descripcion"></p>
				<div class="margin-top-40">
					<a href="#" class="btn btn-primary" data-bind="click:app.registrarLike"><i class="fa fa-heart"></i> <?php echo Texto::idioma("Like");?> <span data-bind="html:like"></span></a>
					<a href="#" class="btn btn-primary" data-bind="click:app.compartirAplicacion"><i class="fa fa-reply"></i> <?php echo Texto::idioma("Compartir_Aplicacion");?></a>
				</div>
			</div>
		</div>
	</div>
	<!-- /ko -->

	<div id="mCompartir" class="modal fade bs-modal-sm" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title"><?php echo Texto::idioma("Compartir");?></h4>
				</div>
				<div class="modal-body">
					<a class="btn btn-block btn-social btn-facebook" data-bind="click:app.btnCompartirAppFb"><i class="fa fa-facebook"></i> <?php echo Texto::idioma("Facebook");?></a>
					<a class="btn btn-block btn-social btn-google-plus" data-bind="click:app.btnCompartirAppGPlus"><i class="fa fa-google-plus"></i> <?php echo Texto::idioma("Google");?></a>
					<a class="btn btn-block btn-social btn-twitter" data-bind="click:app.btnCompartirAppTwitter"><i class="fa fa-twitter"></i> <?php echo Texto::idioma("Twitter");?></a>
				</div>
			 </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(app, $("#divDetalleAplicacion").get(0));
		//ko.applyBindings(app, $("#mCompartir").get(0));
    });
</script>