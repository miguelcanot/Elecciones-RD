<div class="">
	<div class="panel panel-default">
	    <!-- Default panel contents -->
	    <div class="panel-heading">
	        <div class="row">
	            <div class="col-xs-6">
	                <button type="button" class="botonFuncion btn btn-primary btn-flat" data-bind="click:btnRegistrar"><i class="fa fa-plus"></i> <?php echo Texto::idioma("Registrar");?></button>
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
						<th><?php echo Texto::idioma("Estatus");?></th>
						<th><?php echo Texto::idioma("Permisos");?></th>
						<th><?php echo Texto::idioma("Accion");?></th>
					</tr>
				</thead>
				<tbody data-bind="foreach:listaRol">
					<tr>
						<td data-bind="html:nombre"></td>
						<td data-bind="html:estatus().icono"></td>
						<td>
							<button type="button" class="btn btn-info btn-xs" data-bind="click:$parent.btnPermiso" title='<?php echo Texto::idioma("Permiso");?>'><i class="fa fa-gear"></i></button>
						</td>
						<td>
							<button type="button" class="btn btn-info btn-xs" data-bind="click:$parent.btnModificar" title='<?php echo Texto::idioma("Modificar");?>'><i class="fa fa-pencil"></i></button> |
	                    	<button type="button" class="btn btn-danger btn-xs" data-bind="click:$parent.eliminar" title='<?php echo Texto::idioma("Eliminar");?>'><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				</tbody>
				<tbody data-bind="visible: listaRol().length == 0">
		            <tr>
		                <td colspan="4"><?php echo Texto::idioma("ERROR-102");?></td>
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
<div class="modal fade" id="modalRol">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" data-bind="visible:modificando() == false"><?php echo Texto::idioma("Registrar");?></h3>
        <h3 class="modal-title" data-bind="visible:modificando() == true"><?php echo Texto::idioma("Modificar");?></h3>
      </div>
      <div class="modal-body">
        <div class="">
            <div id="divMensajeERol" class="invisible alert alert-danger"></div>
        </div>
        <div class="row">
        	<form id="frmRol" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit:guardar" enctype="multipart/form-data">
        		<div class="col-xs-12">
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label"><?php echo Texto::idioma("Nombre");?></label>
						<div class="col-sm-6">
							<input id="nombre" class="required form-control" type="text" name="nombre" placeholder="<?php echo Texto::idioma("Nombre");?>" autofocus minlength="0" maxlength="100" data-bind="value:nombre"/>
						</div>
					</div>
					<div class="form-group">
						<label for="descripcion" class="col-sm-3 control-label"><?php echo Texto::idioma("Descripcion");?></label>
						<div class="col-sm-6">
							<textarea id="descripcion" rows="5" class="form-control"  name="descripcion" placeholder="<?php echo Texto::idioma("Descripcion");?>" maxlength="1000" data-bind="html:descripcion"></textarea>
						</div>
					</div>
        		</div>
				<div class="col-xs-12">
					<div class="col-xs-6">
						<input type="hidden" name="IDrol" id="IDrol" data-bind="value:IDrol" />
						<button id="btnGuardar" type="submit" class="btn btn-primary btn-block" data-loading-text="<?php echo Texto::idioma("Enviando");?>"><?php echo Texto::idioma("Guardar");?></button>
					</div>
					<div class="col-xs-6">
						<button  type="button" data-bind="click:btnCancelar" class="btn btn-warning btn-block"><?php echo Texto::idioma("Cancelar");?></button>
					</div>
				</div>
			</form>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalPermiso">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?php echo Texto::idioma("Permisos");?></h3>
      </div>
      <div class="modal-body">
        <div class="">
        	<div id="divMensajeSPermiso" class="invisible alert alert-success"></div>
            <div id="divMensajeEPermiso" class="invisible alert alert-danger"></div>
        </div>
        <div class="row">
        	<form id="frmPermiso" class="form-horizontal" action="#" style="border-radius: 0px;" method="post">
	        	<div class="overflow-hidden">
				    <blockquote>
				        <p><?php echo Texto::idioma("Mensaje_Permiso_Nota");?></p>
				    </blockquote>
				</div>

				<div class="col-md-12">
				    <input type="text" class="form-control" id="filtro" placeholder="<?php echo Texto::idioma("Filtrar");?>" />
				</div>

				<div class="col-md-6">
				    <h2 class="bold"><?php echo Texto::idioma("Permisos_Sin_Asignar");?></h2>
				    <div data-bind="foreach: listaObjeto" class="divLista">
				        <a href="#" data-bind="click: rol.agregarObjeto" class="list-group-item"><span data-bind="text:nombre_logico, attr:{id:IDobjeto}"></span> <button class="btn right btn-xs btn-info float-r" type="button"><i class=" fa fa-plus"></i></button></a>
				    </div>
				</div>
				<div class="col-md-6">
				    <h2 class="bold"><?php echo Texto::idioma("Permisos_Asignados");?></h2>
				    <div data-bind="foreach: listaRolObjeto" class="divLista">
				    	<a href="#" data-bind="click: rol.quitarObjeto" class="list-group-item"><span data-bind="text:nombre_logico, attr:{id:IDobjeto}"></span> <button class="btn right btn-xs btn-danger float-r" type="button"><i class=" fa fa-times"></i></button></a>
				    </div>
				</div>
			</form>
        </div>
        <div class="row"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo VIEWMODEL;?>rol.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(rol, $("#divVista").get(0));
		rol.obtenerRol();
		app.getPermisoMenu();

        app.menuActivo("mRol");
        //rol.getObjeto(rol.id);

        $('#filtro').keyup(function (data) {
            var query = $.trim(this.value);
            $('.list-group-item').each(function () {
                if ($(this).text().search(new RegExp(query, "i")) < 0) {
                    $(this).hide().removeClass('visible')
                } else {
                    $(this).show().addClass('visible');
                }
            });
            return false;
        });
    });
</script>