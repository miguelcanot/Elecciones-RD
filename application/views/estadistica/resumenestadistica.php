<div class="col-xs-12">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3 data-bind="html:denunciaPendiente"></h3>
        <p><?php echo Texto::idioma("Denuncias_Pendientes"); ?></p>
      </div>
      <div class="icon">
        <i class="fa fa-bell"></i>
      </div>
    </div>
  </div><!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3 data-bind="html:denunciaAprobado"></h3>
        <p><?php echo Texto::idioma("Denuncias_Aprobadas"); ?></p>
      </div>
      <div class="icon">
        <i class="fa fa-bell"></i>
      </div>
    </div>
  </div><!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3 data-bind="html:publicacionPendiente"></h3>
        <p><?php echo Texto::idioma("Publicaciones_Pendientes"); ?></p>
      </div>
      <div class="icon">
        <i class="fa fa-bullhorn"></i>
      </div>
    </div>
  </div><!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3 data-bind="html:publicacionAprobado"></h3>
        <p><?php echo Texto::idioma("Publicaciones_Aprobadas"); ?></p>
      </div>
      <div class="icon">
        <i class="fa fa-bullhorn"></i>
      </div>
    </div>
  </div><!-- ./col -->
</div>

<div class="col-xs-12">
  <div class="panel panel-primary">
      <div class="panel-heading">
          <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo Texto::idioma("Consultas"); ?>
      </div>
      <div class="panel-body">
          <div id="divGConsulta" class="col-md-12"></div>
      </div>
  </div>
</div>

<div class="col-xs-12">
  <div class="panel panel-primary">
      <div class="panel-heading">
          <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo Texto::idioma("Reporte"); ?>
      </div>
      <div class="panel-body">
          <div id="divGREquipo" class="col-md-12"></div>
      </div>
  </div>
</div>

<script src="<?php echo VIEWMODEL;?>dashboard.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        app.getPermisoMenu();
        ko.applyBindings(dashboard, $("#divVista").get(0));
        dashboard.estadistica();
       /// dashboard.obtenerGConsulta();
        app.menuActivo("mDashboard");
    }); 
</script>
<script src="<?php echo PLUGINS;?>highcharts/js/highcharts.js"></script>
<script src="<?php echo PLUGINS;?>highcharts/js/modules/exporting.js"></script>