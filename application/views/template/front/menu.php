 <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand page-scroll" href="#page-top"><?php echo Texto::idioma("Nombre_App");?></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a data-bind="click:app.mAsiSeVota" class="page-scroll" href="#asiSeVota"><?php echo Texto::idioma("Asi_Se_Vota");?></a>
				</li>
				<li>
					<a data-bind="click:app.mComoVotar" class="page-scroll" href="#comoVotar"><?php echo Texto::idioma("Como_Votar");?></a>
				</li>
				<li>
					<a data-bind="click:app.mPadron" class="page-scroll" href="#padron"><?php echo Texto::idioma("Donde_Voto");?></a>
				</li>
				<li>
					<a data-bind="click:app.mCandidaturas" href="#"><?php echo Texto::idioma("Candidaturas");?></a>
				</li>
				<li>
					<a data-bind="click:app.mRecintos" href="#"><?php echo Texto::idioma("Recintos");?></a>
				</li>
				<li>
					<a data-bind="click:app.mDenuncias" href="#"><?php echo Texto::idioma("Denuncias");?></a>
				</li>
				<li>
					<a data-bind="click:app.mEstadisticas" href="#"><?php echo Texto::idioma("Estadisticas");?></a>
				</li>
				<li>
					<a data-bind="click:app.mInformate" href="#"><?php echo Texto::idioma("Informate");?></a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>