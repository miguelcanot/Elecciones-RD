<div class="panel panel-default panel-post">
	<div class="panel-body">
		<div class="row no-margin">
			<div class="col-lg-12 no-padding">
				<section class="bg-primary subtitle">
					<h2 data-bind="html:descripcion"></h2>
				</section>	
			</div>
		</div>
		<div id="divResultado" data-bind="visible:conResultado" class="post-thumbnail no-margin">
			<img src="" data-bind="attr:{src:img}">
			<div class="row no-margin">
				<button class="btn btn-flat btn-block btn-danger btn-lg" data-bind="click:obtenerResultado" type="button"><?php echo Texto::idioma("Ver_Otro_Resultado");?></button>
				<a id="btnCompartirFacebook" href="#" class="btn btn-block btn-social btn-flat btn-facebook" data-bind="click:btnCompartirResultadoFB"><i class="fa fa-reply"></i> <?php echo Texto::idioma("Compartir_Por_Facebook");?></a>
			</div>

		</div>
		<div class="post-thumbnail no-margin" data-bind="visible:!conResultado()">
			<img src="" data-bind="attr:{src:imgPost}" data-bind="visible:!conResultado()">
			<button class="btn btn-flat btn-block btn-primary btn-lg" data-bind="click:obtenerResultado" type="button"><?php echo Texto::idioma("Ver_Resultado");?></button>
		</div>
		
		<div class="overlay invisible" id="lAplicacion">
			<i class="fa fa-refresh fa-spin"></i>
		</div>	
	</div>
	<div class="panel-footer">
		<ul class="post-action">
			<li>
				<div class="fb-like" 
					data-href="<?php echo $url;?>" 
					data-layout="standard" 
					data-width="300" 
					data-action="like" 
					data-show-faces="true">
				</div>
			</li>
			<li class="pull-right"><a href="#comentario"><i class="fa fa-comments"></i> <?php echo Texto::idioma("Comentarios");?></a></li>
		</ul>
	</div>
</div>

<script src="<?php echo PLUGINSDEFAULT;?>easypiechart/jquery.easypiechart.min.js"></script>
<script src="<?php echo PLUGINS;?>jquery.countTo/jquery.countTo.js"></script>
<script src="<?php echo VIEWMODEL;?>frase.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(frase, $("#divVista").get(0));
		frase.id("<?php echo $id;?>");
		frase.obtenerDetalle();
    });
</script>