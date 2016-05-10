<div class="row slider" id="wgAplicacionesSlider">
	<div class="owl-carousel" id="grid-games-owl">
		<!-- ko foreach:listaAplicacion -->
		<div class="card card-list" data-bind="click:aplicacion.verAplicacion">
			<div class="card-img">
				<img src="" data-bind="attr:{src:imgBlock}" alt="">
			</div>
			<div class="caption">
				<h4 class="card-title"><a href="#" data-bind="html:nombre"></a></h4>
			</div>
		</div>
		<!-- /ko -->
	</div>
	<a href="#" class="prev" id="grid-games-owl-prev"><i class="fa fa-angle-left"></i></a>
	<a href="#" class="next" id="grid-games-owl-next"><i class="fa fa-angle-right"></i></a>
</div>

<script src="<?php echo VIEWMODEL;?>aplicacion.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(aplicacion, $("#wgAplicacionesSlider").get(0));
		aplicacion.obtenerAplicacionActivas();
		//app.appOwlCarousel("grid-games-owl", "grid-games-owl-next", "grid-games-owl-prev");
    });
	
</script>