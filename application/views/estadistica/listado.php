<div class="col-xs-12 col-md-8 col-md-offset-2">
    <a href="#" data-bind="click:btnDenunciaMunicipio">
        <div class="bs-callout bs-callout-info"> 
            <h4><?php echo Texto::idioma("Denuncias_Por_Municipios");?></h4>
        </div>
    </a>
    <a href="#" data-bind="click:btnDenunciaRecinto">
        <div class="bs-callout bs-callout-info"> 
            <h4><?php echo Texto::idioma("Denuncias_Por_Recintos");?></h4>
        </div>
    </a>
     <a href="#" data-bind="click:btnPoblacionPorSexo">
        <div class="bs-callout bs-callout-info"> 
            <h4><?php echo Texto::idioma("Poblacion_Por_Sexo");?></h4>
        </div>
    </a>
    
    
</div>
<div class="modal fade" id="modalEstadistica">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"><?php echo Texto::idioma("Resultados");?></h3>
        </div>
        <div class="modal-body">
          <iframe id="ifEstadistica" width="100%" height="600" frameborder="0" ></iframe>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo VIEWMODEL;?>estadistica.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(estadistica, $("#divVista").get(0));
    });
</script>