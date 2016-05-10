<section class="border-top-1 border-grey-200 padding-top-20" id="divSAplicaciones">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="title outline">
					<h4><i class="fa fa-play"></i> <?php echo Texto::idioma("Te_Podria_Gustar");?></h4>
				</div>
			</div>
		</div>
		<div class="row masonry">
			<!-- ko foreach:listaAplicacion -->
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 post-grid">
				<div class="card card-hover" data-bind="click:aplicacion.verAplicacion">
					<div class="card-img">
						<a href="#"><img src="" data-bind="attr:{src:imgBlock}" alt=""></a>
					</div>
					<div class="caption">
						<h3 class="card-title"><a href="#" data-bind="html:nombre"></a></h3>
					</div>
				</div>
			</div>
			<!-- /ko -->
		</div>
	</div>
</section>
<script src="<?php echo VIEWMODEL;?>aplicacion.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(aplicacion, $("#divSAplicaciones").get(0));
		aplicacion.obtenerAplicacionActivas();
    });
</script>