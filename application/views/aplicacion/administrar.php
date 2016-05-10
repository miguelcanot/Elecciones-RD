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
			<table class="table">
				<thead>
					<tr>
						<th><?php echo Texto::idioma("Nombre");?></th>
						<th><?php echo Texto::idioma("Estatus");?></th>
						<th><?php echo Texto::idioma("Accion");?></th>
					</tr>
				</thead>
				<tbody data-bind="foreach:listaAplicacion">
					<tr>
						<td data-bind="html:nombre"></td>
						<td data-bind="html:estatus.icono"></td>
						<td>
							<button type="button" class="btn btn-info btn-xs" data-bind="click:$parent.btnModificar" title='<?php echo Texto::idioma("Modificar");?>'><i class="fa fa-pencil"></i></button> |
	                    	<button type="button" class="btn btn-danger btn-xs" data-bind="click:$parent.eliminar" title='<?php echo Texto::idioma("Eliminar");?>'><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				</tbody>
				<tbody data-bind="visible: listaAplicacion().length == 0">
		            <tr>
		                <td colspan="3"><?php echo Texto::idioma("ERROR-102");?></td>
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
<div class="modal fade" id="modalAplicacion">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" data-bind="visible:modificando() == false"><?php echo Texto::idioma("Registrar");?></h3>
        <h3 class="modal-title" data-bind="visible:modificando() == true"><?php echo Texto::idioma("Modificar");?></h3>
      </div>
      <div class="modal-body">
        <div class="">
            <div id="divMensajeEAplicacion" class="invisible alert alert-danger"></div>
        </div>
        <div class="row">
        	<form id="frmAplicacion" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit:guardar" enctype="multipart/form-data">
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
							<input id="descripcion" class="form-control" type="text" name="descripcion" placeholder="<?php echo Texto::idioma("Descripcion");?>" minlength="0" maxlength="1000" data-bind="value:descripcion"/>
						</div>
					</div>
					<div class="form-group">
						<label for="web" class="col-sm-3 control-label"><?php echo Texto::idioma("Web");?></label>
						<div class="col-sm-6">
							<input id="web" class="form-control" type="text" name="web" placeholder="<?php echo Texto::idioma("Web");?>" minlength="0" maxlength="100" data-bind="value:web"/>
						</div>
					</div>
					<div class="form-group">
						<label for="web" class="col-sm-3 control-label"><?php echo Texto::idioma("Callback URL");?></label>
						<div class="col-sm-6">
							<input id="callback_url" class="required form-control" type="text" name="callback_url" placeholder="<?php echo Texto::idioma("Callback URL");?>" minlength="0" maxlength="100" data-bind="value:callback_url"/>
						</div>
					</div>
					<div class="form-group">
						<label for="img" class="col-sm-3 control-label"><?php echo Texto::idioma("Imagen");?></label>
						<div class="col-sm-6">
							 <input type="file" name='img' id='img' class="form-control invisible file" data-bind="value:img"/>
					        <button type="button" class="btn btn-block btn-info" id="btnImagen"><i class='fa fa-picture-o'></i></button>
					        <span id="rutaImagen" data-bind="html:img"></span>
						</div>
					</div>
        		</div>
				<div class="col-xs-12">
					<div class="col-xs-6">
						<input type="hidden" name="IDapp" id="IDapp" data-bind="value:IDapp" />
						<button id="btnGuardar" type="submit" class="btn btn-primary btn-block" data-loading-text="<?php echo Texto::idioma("Enviando");?>"><?php echo Texto::idioma("Guardar");?></button>
					</div>
					<div class="col-xs-6">
						<button  type="button" data-bind="click:btnCancelar" class="btn btn-warning btn-block"><?php echo Texto::idioma("Cancelar");?></button>
					</div>
				</div>
			</form>
        </div>
        <!-- Loading (remove the following to stop the loading)-->
        <div class="overlay invisible" id="lmAplicacion">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        <!-- end loading -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo VIEWMODEL;?>aplicacion.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(aplicacion, $("#divVista").get(0));
		aplicacion.obtenerAplicacion();
		app.getPermisoMenu();
		botonImagen("img", "btnImagen", "rutaImagen");
        app.menuActivo("mAplicacion");
    });
</script>