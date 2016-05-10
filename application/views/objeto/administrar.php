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
						<th><?php echo Texto::idioma("Nombre_Logico");?></th>
						<th><?php echo Texto::idioma("Nombre_Fisico");?></th>
						<th><?php echo Texto::idioma("Objeto_Relacionado");?></th>
						<th><?php echo Texto::idioma("Tipo_Objeto");?></th>
						<th><?php echo Texto::idioma("Estatus");?></th>
						<th><?php echo Texto::idioma("Accion");?></th>
					</tr>
				</thead>
				<tbody data-bind="foreach:listaObjeto">
					<tr>
						<td data-bind="html:nombre_logico"></td>
						<td data-bind="html:nombre_fisico"></td>
						<td data-bind="html:objetoRelacionado"></td>
						<td data-bind="html:tipo_objeto"></td>
						<td data-bind="html:estatus().icono"></td>
						<td>
							<button type="button" class="btn btn-info btn-xs" data-bind="click:$parent.btnModificar" title='<?php echo Texto::idioma("Modificar");?>'><i class="fa fa-pencil"></i></button> |
	                    	<button type="button" class="btn btn-danger btn-xs" data-bind="click:$parent.eliminar" title='<?php echo Texto::idioma("Eliminar");?>'><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				</tbody>
				<tbody data-bind="visible: listaObjeto().length == 0">
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
<div class="modal fade" id="modalObjeto">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" data-bind="visible:modificando() == false"><?php echo Texto::idioma("Registrar");?></h3>
        <h3 class="modal-title" data-bind="visible:modificando() == true"><?php echo Texto::idioma("Modificar");?></h3>
      </div>
      <div class="modal-body">
        <div class="">
            <div id="divMensajeEObjeto" class="invisible alert alert-danger"></div>
        </div>
        <div class="row">
        	<form id="frmObjeto" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit:guardar" enctype="multipart/form-data">
        		<div class="col-xs-12">
					<div class="form-group">
						<label for="nombre_logico" class="col-sm-3 control-label"><?php echo Texto::idioma("Nombre_Logico");?></label>
						<div class="col-sm-6">
							<input id="nombre_logico" class="required form-control" type="text" name="nombre_logico" placeholder="<?php echo Texto::idioma("Nombre_Logico");?>" autofocus maxlength="200" data-bind="value:nombre_logico"/>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre_fisico" class="col-sm-3 control-label"><?php echo Texto::idioma("Nombre_Fisico");?></label>
						<div class="col-sm-6">
							<input id="nombre_fisico" class="required form-control" type="text" name="nombre_fisico" placeholder="<?php echo Texto::idioma("Nombre_Fisico");?>" maxlength="300" data-bind="value:nombre_fisico"/>
						</div>
					</div>
					<div class="form-group">
						<label for="IDobjeto_relacionado" class="col-sm-3 control-label"><?php echo Texto::idioma("Objeto_Relacionado");?></label>
						<div class="col-sm-6">
							<select id="IDobjeto_relacionado" name="IDobjeto_relacionado" data-bind="options: listaObjetoRelacion, optionsValue:'IDobjeto', optionsText:'nombre_logico', optionsCaption: '<?php echo Texto::idioma("Seleccionar");?>...'" class="select2"></select>
						</div>
					</div>
					
			        <div class="form-group">
						<label for="tipo_objeto" class="col-sm-3 control-label"><?php echo Texto::idioma("Tipo_Objeto");?></label>
						<div class="col-sm-6">
							<select id="tipo_objeto" name="tipo_objeto" data-bind="options: listaTipoObjeto, optionsValue:'id', optionsText:'nombre', optionsCaption: '<?php echo Texto::idioma("Seleccionar");?>...'" class="required form-control"></select>
						</div>
					</div>
        		</div>
				<div class="col-xs-12">
					<div class="col-xs-6">
						<input type="hidden" name="IDobjeto" id="IDobjeto" data-bind="value:IDobjeto" />
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

<script src="<?php echo VIEWMODEL;?>objeto.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(objeto, $("#divVista").get(0));
		objeto.obtenerContenido();
		botonImagen("imagen", "btnImagen", "rutaImagen");
		app.getPermisoMenu();
		app.menuActivo("mObjeto");

		$(".select2").select2({
          width: '100%'
        });
	});	
</script>
<link rel="stylesheet" type="text/css" href="<?php echo PLUGINS;?>select2/select2.min.css" />
<script type="text/javascript" src="<?php echo PLUGINS;?>select2/select2.full.min.js" ></script>