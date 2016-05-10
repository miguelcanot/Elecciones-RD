<div class="panel panel-default panel-post">
	<div class="panel-body">
		<div class="row no-margin">
			<div class="col-lg-12 no-padding">
				<section class="bg-primary subtitle">
					<h2><?php echo Texto::idioma("Cual_Es_Tu_Frase_Diaria");?></h2>
				</section>	
			</div>
		</div>
		<div id="divResultado" data-bind="visible:conResultado">
			<img src="" data-bind="attr:{src:img}">
			<div class="row no-margin">
				<button class="btn btn-flat btn-block btn-danger btn-lg" data-bind="click:obtenerResultado" type="button"><?php echo Texto::idioma("Ver_Otro_Resultado");?></button>
				<a id="btnCompartirFacebook" href="#" class="btn btn-block btn-social btn-flat btn-facebook" data-bind="click:btnCompartirResultadoFB"><i class="fa fa-reply"></i> <?php echo Texto::idioma("Compartir_Por_Facebook");?></a>
			</div>

		</div>
		<div data-bind="visible:!conResultado()">
			<img src="<?php echo IMAGE."frasediaria/default.jpg";?>" data-bind="visible:!conResultado()">
			<button class="btn btn-flat btn-block btn-primary btn-lg" data-bind="click:obtenerResultado" type="button"><?php echo Texto::idioma("Ver_Resultado");?></button>
		</div>
		
		<div class="overlay invisible" id="lAplicacion">
			<i class="fa fa-refresh fa-spin"></i>
		</div>	
	</div>
	<div class="panel-footer">
		<ul class="post-action">
			<li><a href="#" class=""><i class="fa fa-heart"></i> <span data-bind="html:fraseDiaria.like"></span></a></li>

		</ul>
	</div>
</div>

<div id="comentario" class="margin-top-50">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="title outline">
				<h4><i class="fa fa-comments"></i> <?php echo Texto::idioma("Comentarios");?></h4>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="well">
			<div class="fb-comments" data-href="http://dominicancode.com" data-numposts="10"></div>
			<p><?php echo Texto::idioma("Nota_Comentario");?></p>
		</div>
	</div>
</div>

<script src="<?php echo PLUGINSDEFAULT;?>easypiechart/jquery.easypiechart.min.js"></script>
<script src="<?php echo PLUGINS;?>jquery.countTo/jquery.countTo.js"></script>
<script src="<?php echo VIEWMODEL;?>frasediaria.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(fraseDiaria, $("#divVista").get(0));
		fraseDiaria.id("<?php echo $id;?>");
		fraseDiaria.obtenerDetalle();
    });
</script>