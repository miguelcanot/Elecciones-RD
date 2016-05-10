<section class="bg-dark">
  <div class="container">
      <div class="row">
          <div class="col-lg-8 col-lg-offset-2 text-center">
             <form method="post" data-bind="submit:buscarCandidato">
              <h2 class="section-heading"><?php echo Texto::idioma("Busca_Tus_Candidatos");?>!</h2>
              <hr class="light">
              <div class="col-xs-12">
                <p><input type="text" class="bigInput required form-control" placeholder="<?php echo Texto::idioma("Ejemplo_Busqueda_Inicio");?>" id="txtBusqueda" name="txtBusqueda" data-provide="typeahead" autocomplete="off"/></p>
                <button type="submit" class="btn btn-primary btn-xl" ><?php echo Texto::idioma("Buscar");?></a>
              </div>
              </form>    
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
      <div class="row">
           <div class="table-responsive">
            <table class="table table-striped tableDT">
              <thead>
                <th><?php echo Texto::idioma("Nivel");?></th>
                <th><?php echo Texto::idioma("Demarcacion");?></th>
                <th><?php echo Texto::idioma("Cargo");?></th>
                <th><?php echo Texto::idioma("Posicion");?></th>
                <th><?php echo Texto::idioma("Nombres");?></th>
                <th><?php echo Texto::idioma("Partido");?></th>
                <th><?php echo Texto::idioma("Siglas");?></th>
                <th><?php echo Texto::idioma("Partido_Aporta");?></th>
                <th><?php echo Texto::idioma("Sexo");?></th>
                <th><?php echo Texto::idioma("Aliados");?></th>
                <th><?php echo Texto::idioma("Nombre_Boleta");?></th>
                <th><?php echo Texto::idioma("Apellido_Boleta");?></th>
              </thead>
              <tbody data-bind="foreach:listaCandidatura">
                <tr>
                  <td data-bind="html:Nivel"></td>
                  <td data-bind="html:Demarcacion"></td>
                  <td data-bind="html:Cargo"></td>
                  <td data-bind="html:Posicion"></td>
                  <td data-bind="html:Nombres"></td>
                  <td data-bind="html:Partido"></td>
                  <td data-bind="html:Siglas"></td>
                  <td data-bind="html:PartidoAporta"></td>
                  <td data-bind="html:Sexo"></td>
                  <td data-bind="html:Aliados"></td>
                  <td data-bind="html:NombreBoleta"></td>
                  <td data-bind="html:ApellidoBoleta"></td>
                </tr>
              </tbody>
              <tbody data-bind="visible: listaCandidatura().length == 0">
                <tr><td colspan="12"><?php echo Texto::idioma("ERROR-102");?></td></tr>
            </tbody>
            </table>
        </div>
      </div>
      
  </div>
</section>

<link rel="stylesheet" href="<?php echo PLUGINS;?>datatables/dataTables.bootstrap.css" type="text/css">
<script type="text/javascript" src="<?php echo PLUGINS;?>datatables/jquery.dataTables.min.js" ></script>
<script type="text/javascript" src="<?php echo PLUGINS;?>datatables/dataTables.bootstrap.min.js" ></script>
<script type="text/javascript" src="<?php echo PLUGINS;?>typeahead/typeahead.js" ></script>
<script src="<?php echo VIEWMODEL;?>candidatura.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(candidatura, $("#divVista").get(0));
		candidatura.buscarCandidato();
        app.menuActivo("mCandidatura");
      
        var url = pathApi + "candidatura/apiobtenercandidaturajson/";
      
        var filtroNombres = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          //prefetch: url,
          remote: {
            url: 'candidatura/apiobtenercandidaturajson/%QUERY/Nombres',
            wildcard: '%QUERY'
          }
        });

        var filtroSiglas = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          //prefetch: url,
          remote: {
            url: 'candidatura/apiobtenercandidaturajson/%QUERY/Siglas',
            wildcard: '%QUERY'
          }
        });
      
        var filtroZonas = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          //prefetch: url,
          remote: {
            url: 'candidatura/apiobtenercandidaturajson/%QUERY/Demarcacion',
            wildcard: '%QUERY'
          }
        });
      
        var filtroCargos = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          //prefetch: url,
          remote: {
            url: 'candidatura/apiobtenercandidaturajson/%QUERY/Cargo',
            wildcard: '%QUERY'
          }
        });
      
      
        $('#txtBusqueda').typeahead({
          highlight: true
        },
        {
          
          source: filtroNombres,
          templates: {
            header: '<h3 class="league-name"><?php echo Texto::idioma("Candidatos");?></h3>'
          }
        },
        {
          source: filtroSiglas,
          templates: {
            header: '<h3 class="league-name"><?php echo Texto::idioma("Partidos");?></h3>'
          }
        },
        {
          source: filtroZonas,
          templates: {
            header: '<h3 class="league-name"><?php echo Texto::idioma("Zonas");?></h3>'
          }
        },
        {
          source: filtroCargos,
          templates: {
            header: '<h3 class="league-name"><?php echo Texto::idioma("Cargos");?></h3>'
          }
        });     
    });
</script>