<section class="bg-grey-50 padding-top-60 padding-bottom-60 relative">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="title outline">
					<h4><i class="fa fa-heart"></i> <?php echo Texto::idioma("Juegos");?></h4>
					<p><?php echo Texto::idioma("Disfruta_Juegos_Gratis");?></p>
				</div>
			</div>
		</div>
		<div class="row masonry" data-bind="foreach:listaAplicacion">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 post-grid" data-bind="click:aplicacion.verAplicacion">
				<div class="card card-hover mPointer">
					<div class="card-img">
						<img src="" data-bind="attr:{src:imgBlock}" alt="">
						<!--<div class="category"><span class="label label-primary">PC</span></div>-->
						<div class="meta"><a href="#"><i class="fa fa-heart-o"></i> <span data-bind="html:like"></span></a></div>
					</div>
					<div class="caption">
						<h3 class="card-title"><a href="#" data-bind="html:nombre"></a></h3>
						<ul>
							<li data-bind="html:fecha"></li>
						</ul>
						<p data-bind="html:descripcion"></p>
					</div>
				</div>
			</div>
		</div>
		<!--
		<div class="text-center"><a href="#" class="btn btn-primary btn-lg btn-shadow btn-rounded btn-icon-right margin-top-10 margin-bottom-20">Show More <i class="fa fa-angle-right"></i></a></div>
		-->
		<div class="overlay invisible" id="lJuegos">
	        <i class="fa fa-refresh fa-spin"></i>
	    </div>
	</div>
</section>
<!--	
<div class="background-image margin-top-40" style="background-image: url(http://img.youtube.com/vi/JtYmlx3rJdU/maxresdefault.jpg);">
	<span class="background-overlay"></span>
	<div class="container">
		<div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/JtYmlx3rJdU?rel=0&amp;showinfo=0" allowfullscreen></iframe>
		</div>
	</div>
</div>
-->

<script src="<?php echo VIEWMODEL;?>aplicacion.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(aplicacion, $("#divVista").get(0));
		aplicacion.obtenerAplicacionActivas();
    });
</script>