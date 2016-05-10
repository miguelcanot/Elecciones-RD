<script src="<?php echo PLUGINS;?>chart/Chart.bundle.js"></script>
<div class="col-lg-8 col-lg-offset-2 text-center">
  <h2 class="section-heading"><?php echo Texto::idioma("Denuncias_Por_Recintos");?>!</h2>
  <hr class="light">
</div>
<div >
    <canvas id="canvas"></canvas>
</div>
<script>
   
</script>


<script src="<?php echo VIEWMODEL;?>denuncia.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(denuncia, $("#divVista").get(0));
		denuncia.obtenerEstadisticaRecinto();
    });
</script>