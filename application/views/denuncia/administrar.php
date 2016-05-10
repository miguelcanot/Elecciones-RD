<div class="">
	<div class="panel panel-default">
	    <!-- Default panel contents -->
	    <div class="panel-heading">
	        <div class="row">
	            <div class="col-xs-6">
	                
	            </div>
	            <div class="col-xs-6">
		            <form id="frmBuscador" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit:buscar">
		                <div class="input-group">
		                    <input class="form-control" id="busqueda" name="busqueda" placeholder="<?php echo Texto::idioma("Buscar");?>" type="text" autofocus  />
		                    <span class="input-group-btn">
		                        <button class="btn btn-default" id="btnBuscar" name="btnBuscar" type="submit" data-loading-text="<?php echo Texto::idioma("...");?>" maxlenght="20"><i class="fa fa-search"></i></button>
		                    </span>
		                </div><!-- /input-group -->
		            </form>
		        </div>
	        </div>
	    </div>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><?php echo Texto::idioma("Fecha");?></th>
						<th><?php echo Texto::idioma("Denunciante");?></th>
						<th><?php echo Texto::idioma("Comentario");?></th>
						<th><?php echo Texto::idioma("Mesa");?></th>
						<th><?php echo Texto::idioma("Estatus");?></th>
						<th><?php echo Texto::idioma("Accion");?></th>
					</tr>
				</thead>
				<tbody data-bind="foreach:listaDenuncia">
					<tr>
						<td data-bind="html:Fecha"></td>
						<td data-bind="html:Denunciante"></td>
						<td data-bind="html:Comentario"></td>
						<td data-bind="html:Mesa"></td>
						<td data-bind="html:Estatus.icono"></td>
						<td>
							<button type="button" class="btn btn-info btn-xs" data-bind="click:$parent.btnImagen, enable:Imagen != ''" title='<?php echo Texto::idioma("Imagen");?>'><i class="fa fa-picture-o"></i></button> |
							<button type="button" class="btn btn-info btn-xs" data-bind="click:$parent.detalle" title='<?php echo Texto::idioma("Detalle");?>'><i class="fa fa-list"></i></button> |
							<button type="button" class="btn btn-success btn-xs" data-bind="click:$parent.aprobar" title='<?php echo Texto::idioma("Aprobar");?>'><i class="fa fa-check"></i></button> |
	                    	<button type="button" class="btn btn-danger btn-xs" data-bind="click:$parent.eliminar" title='<?php echo Texto::idioma("Eliminar");?>'><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				</tbody>
				<tbody data-bind="visible: listaDenuncia().length == 0">
		            <tr>
		                <td colspan="6"><?php echo Texto::idioma("ERROR-102");?></td>
		            </tr>
		        </tbody>
			</table>
		</div>
		 <ul class="pager">
	        <li data-bind="visible:paginaActual() > 0"><a href="#" data-bind="click:paginaAnterior"><?php echo Texto::idioma("Anterior");?></a></li>
	        <li data-bind="visible:!paginaFinal()"><a href="#" data-bind="click:paginaSiguiente"><?php echo Texto::idioma("Siguiente");?></a></li>
	    </ul>
	     <!-- Loading (remove the following to stop the loading)-->
		<div class="overlay invisible" id="lDenuncia">
		  <i class="fa fa-refresh fa-spin"></i>
		</div>
		<!-- end loading -->
	</div>
</div>

<div class="modal fade" id="modalDetalle">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?php echo Texto::idioma("Detalle");?></h3>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-xs-12 col-md-8 col-md-offset-2" data-bind="foreach:listaDetalle">
				<div class="bs-callout bs-callout-info"> 
				<label><span></span><h4 data-bind="html:TipoDenuncia"></h4></label>
				</div>
			</div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalImagen">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?php echo Texto::idioma("Imagen");?></h3>
      </div>
      <div class="modal-body">
        <img class="img-responsive" src"" data-bind="attr:{src:urlImagen}">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script src="<?php echo VIEWMODEL;?>denuncia.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(denuncia, $("#divVista").get(0));
		denuncia.obtenerDenuncia();
		app.getPermisoMenu();
		app.menuActivo("mDenuncia");
	});	
</script>