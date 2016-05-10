 <section class="bg-dark">
  <div class="container">
      <div class="row">
          <div class="col-lg-8 col-lg-offset-2 text-center">
              <h2 class="section-heading"><?php echo Texto::idioma("Conoce_Tu_Recinto");?>!</h2>
              <hr class="light">
              <div class="col-xs-12">
                <p><select id="IDMunicipio" name="IDMunicipio" data-bind="options: listaMunicipio, optionsValue:'IDMunicipio', optionsText:'Nombre', optionsCaption: '<?php echo Texto::idioma("Seleccionar");?>...', event:{change:obtenerRecinto}" class="required select2"></select></p>
              </div>
          </div>
           <!-- Loading (remove the following to stop the loading)-->
          <div class="overlay invisible" id="lCandidatura">
              <i class="fa fa-refresh fa-spin"></i>
          </div>
          <!-- end loading -->
      </div>
  </div>
</section>

<section class="">
  <div class="container">
      <div class="col-lg-8 col-lg-offset-2 text-center">
          <h2 class="section-heading"><?php echo Texto::idioma("Recintos");?>!</h2>
          <hr class="light">
      </div>
      <div class="row">
           <div id="estate-map" class="details-map"></div>
      </div>
      
  </div>
</section>

<link rel="stylesheet" href="<?php echo PLUGINS;?>select2/select2.min.css" type="text/css">
<script type="text/javascript" src="<?php echo PLUGINS;?>select2/select2.min.js" ></script>
<script src="<?php echo VIEWMODEL;?>recinto.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(recinto, $("#divVista").get(0));
		recinto.obtenerMunicipio();
        app.menuActivo("mRecinto");
        mapInit(18.48605749999999, -69.9312117, "estate-map", "", false);
        $ (".select2").select2({
          width: '100%'
        });
    });
</script>