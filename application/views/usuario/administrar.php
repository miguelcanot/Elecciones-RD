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
						<th><?php echo Texto::idioma("Usuario");?></th>
						<th><?php echo Texto::idioma("Nombre");?></th>
						<th><?php echo Texto::idioma("Apellido");?></th>
						<th><?php echo Texto::idioma("Correo");?></th>
						<th><?php echo Texto::idioma("Rol");?></th>
						<th><?php echo Texto::idioma("Estatus");?></th>
						<th><?php echo Texto::idioma("Accion");?></th>
					</tr>
				</thead>
				<tbody data-bind="foreach:listaUsuario">
					<tr>
						<td data-bind="html:usuario"></td>
						<td data-bind="html:nombre"></td>
						<td data-bind="html:apellido"></td>
						<td data-bind="html:correo"></td>
						<td data-bind="html:rol"></td>
						<td data-bind="html:estatus().icono"></td>
						<td>
							<button type="button" class="btn btn-info btn-xs" data-bind="click:$parent.btnModificar" title='<?php echo Texto::idioma("Modificar");?>'><i class="fa fa-pencil"></i></button> |
	                    	<button type="button" class="btn btn-danger btn-xs" data-bind="click:$parent.eliminar" title='<?php echo Texto::idioma("Eliminar");?>'><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				</tbody>
				<tbody data-bind="visible: listaUsuario().length == 0">
		            <tr>
		                <td colspan="7"><?php echo Texto::idioma("ERROR-102");?></td>
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
<div class="modal fade" id="modalUsuario">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" data-bind="visible:modificando() == false"><?php echo Texto::idioma("Registrar");?></h3>
        <h3 class="modal-title" data-bind="visible:modificando() == true"><?php echo Texto::idioma("Modificar");?></h3>
      </div>
      <div class="modal-body">
        <div class="">
            <div id="divMensajeEUsuario" class="invisible alert alert-danger"></div>
        </div>
        <div class="row">
        	<form id="frmUsuario" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit:guardar" enctype="multipart/form-data">
        		<div class="col-xs-12">
					<div class="form-group">
						<label for="usuario" class="col-sm-3 control-label"><?php echo Texto::idioma("Usuario");?></label>
						<div class="col-sm-6">
							<input id="usuario" class="required form-control" type="text" name="usuario" placeholder="<?php echo Texto::idioma("Usuario");?>" autofocus minlength="0" maxlength="100" data-bind="value:usuario"/>
							<span class="field-validation-error" data-valmsg-for="usuario" data-valmsg-replace="true"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label"><?php echo Texto::idioma("Nombre");?></label>
						<div class="col-sm-6">
							<input id="nombre" class="required form-control" type="text" name="nombre" placeholder="<?php echo Texto::idioma("Nombre");?>" minlength="0" maxlength="100" data-bind="value:nombre"/>
						</div>
					</div>
					<div class="form-group">
						<label for="apellido" class="col-sm-3 control-label"><?php echo Texto::idioma("Apellido");?></label>
						<div class="col-sm-6">
							<input id="apellido" class="required form-control" type="text" name="apellido" placeholder="<?php echo Texto::idioma("Apellido");?>" minlength="0" maxlength="100" data-bind="value:apellido"/>
						</div>
					</div>
					<div class="form-group">
						<label for="correo" class="col-sm-3 control-label"><?php echo Texto::idioma("Correo");?></label>
						<div class="col-sm-6">
							<input id="correo" class="required form-control email" type="email" name="correo" placeholder="<?php echo Texto::idioma("Correo");?>" minlength="0" maxlength="100" data-bind="value:correo"/>
						</div>
					</div>
					<div class="form-group">
						<label for="comentario" class="col-sm-3 control-label"><?php echo Texto::idioma("Comentario");?></label>
						<div class="col-sm-6">
							<input id="comentario" class="form-control" type="text" name="comentario" placeholder="<?php echo Texto::idioma("Comentario");?>" minlength="0" maxlength="100" data-bind="value:comentario"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3" for="IDrol"><?php echo Texto::idioma("Rol");?></label>
			            <div class="col-md-6">
							<select id="IDrol" name="IDrol" data-bind="options: listaRol, optionsValue:'IDrol', optionsText:'nombre', optionsCaption: '<?php echo Texto::idioma("Seleccionar");?>...'" class="required form-control"></select>
						</div>
					</div>
					<div class="form-group">
                        <label class="control-label col-md-3" for="Agente"><?php echo Texto::idioma("Agente");?></label>
                        <div class="col-md-6">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary" id="agenteSLabel">
                                    <input class="required" type="radio" name="agente" id="agenteS" value="1" autocomplete="off"> <?php echo Texto::idioma("Si");?>
                                </label>
                                <label class="btn btn-primary" id="agenteNLabel">
                                    <input class="required" type="radio" name="agente" id="agenteN" value="0" autocomplete="off"> <?php echo Texto::idioma("No");?>
                                </label>
                            </div>
                            <span class="field-validation-error" data-valmsg-for="agente" data-valmsg-replace="true"></span>
                        </div>
                    </div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label"><?php echo Texto::idioma("Contrasena");?></label>
						<div class="col-sm-6">
							<span><?php echo Texto::idioma("Mensaje_Contrasena_Default");?></span>
						</div>
					</div>
        		</div>
				<div class="col-xs-12">
					<div class="col-xs-6">
						<input type="hidden" name="IDusuario" id="IDusuario" data-bind="value:IDusuario" />
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

<script src="<?php echo VIEWMODEL;?>usuario.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(usuario, $("#divVista").get(0));
		usuario.obtenerUsuario();
		app.getPermisoMenu();
		usuario.obtenerRol();
		app.menuActivo("mUsuario");
	});	
</script>