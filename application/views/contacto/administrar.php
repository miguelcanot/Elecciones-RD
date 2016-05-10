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
						<th><?php echo Texto::idioma("Nombre");?></th>
						<th><?php echo Texto::idioma("Correo");?></th>
						<th><?php echo Texto::idioma("Telefono");?></th>
						<th><?php echo Texto::idioma("Fecha");?></th>
						<th><?php echo Texto::idioma("Estatus");?></th>
						<th><?php echo Texto::idioma("Accion");?></th>
					</tr>
				</thead>
				<tbody data-bind="foreach:listaContacto">
					<tr>
						<td data-bind="html:nombre"></td>
						<td data-bind="html:correo"></td>
						<td data-bind="html:telefono"></td>
						<td data-bind="html:fecha"></td>
						<td data-bind="html:estatus().icono"></td>
						<td>
							<button type="button" class="btn btn-info btn-xs" data-bind="click:$parent.btnModificar" title='<?php echo Texto::idioma("Ver");?>'><i class="fa fa-pencil"></i></button> |
	                    	<button type="button" class="btn btn-danger btn-xs" data-bind="click:$parent.eliminar" title='<?php echo Texto::idioma("Eliminar");?>'><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				</tbody>
				<tbody data-bind="visible: listaContacto().length == 0">
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
	</div>
</div>
<div class="modal fade" id="modalContacto">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?php echo Texto::idioma("Mensaje");?></h3>
      </div>
      <div class="modal-body">
        <div class="">
            <div id="divMensajeEContacto" class="invisible alert alert-danger"></div>
        </div>
        <div class="">
			<textarea id="mensaje" rows="10" class="form-control" name="mensaje" placeholder="<?php echo Texto::idioma("Mensaje");?>" data-bind="value:mensaje" readonly="readonly"></textarea>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo VIEWMODEL;?>contacto.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(contacto, $("#divVista").get(0));
		contacto.obtenerContacto();
		app.getPermisoMenu();
        app.menuActivo("mContacto");
    });
</script>