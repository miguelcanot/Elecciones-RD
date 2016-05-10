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
						<th><?php echo Texto::idioma("Tipo_Cuenta");?></th>
						<th><?php echo Texto::idioma("Estatus");?></th>
						<th><?php echo Texto::idioma("Accion");?></th>
					</tr>
				</thead>
				<tbody data-bind="foreach:listaSocial">
					<tr>
						<td data-bind="html:tipoCuenta"></td>
						<td data-bind="html:estatus.icono"></td>
						<td>
							<button type="button" class="btn btn-info btn-xs" data-bind="click:$parent.btnModificar" title='<?php echo Texto::idioma("Modificar");?>'><i class="fa fa-pencil"></i></button> |
	                    	<button type="button" class="btn btn-danger btn-xs" data-bind="click:$parent.eliminar" title='<?php echo Texto::idioma("Eliminar");?>'><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				</tbody>
				<tbody data-bind="visible: listaSocial().length == 0">
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
	    <!-- Loading (remove the following to stop the loading)-->
        <div class="overlay invisible" id="lSocial">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        <!-- end loading -->
	</div>
</div>
<div class="modal fade" id="modalSocial" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" data-bind="visible:modificando() == false"><?php echo Texto::idioma("Registrar");?></h3>
        <h3 class="modal-title" data-bind="visible:modificando() == true"><?php echo Texto::idioma("Modificar");?></h3>
      </div>
      <div class="modal-body">
        <div class="">
            <div id="divMensajeESocial" class="invisible alert alert-danger"></div>
        </div>
        <div class="row">
        	<form id="frmSocial" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit:guardar" enctype="multipart/form-data">
        		<div class="form-group">
					<label class="control-label col-md-3" for="IDtipo_cuenta"><?php echo Texto::idioma("TipoCuenta");?></label>
		            <div class="col-md-6">
						<select id="IDtipo_cuenta" name="IDtipo_cuenta" data-bind="options: listaTipoCuenta, optionsValue:'IDtipo_cuenta', optionsText:'nombre', optionsCaption: '<?php echo Texto::idioma("Seleccionar");?>...'" class="required form-control"></select>
						<span class="field-validation-error" data-valmsg-for="IDtipo_cuenta" data-valmsg-replace="true"></span>
					</div>
				</div>
        		<div class="col-xs-12">
					<div class="form-group">
						<label for="id" class="col-sm-3 control-label"><?php echo Texto::idioma("ID");?></label>
						<div class="col-sm-6">
							<input id="id" class="form-control" type="text" name="id" placeholder="<?php echo Texto::idioma("ID");?>" minlength="0" maxlength="500" data-bind="value:id"/>
							<span class="field-validation-error" data-valmsg-for="id" data-valmsg-replace="true"></span>
						</div>
					</div>
        		</div>
        		<div class="col-xs-12">
					<div class="form-group">
						<label for="access_token" class="col-sm-3 control-label"><?php echo Texto::idioma("Access_Token");?></label>
						<div class="col-sm-6">
							<input id="access_token" class="form-control" type="text" name="access_token" placeholder="<?php echo Texto::idioma("Access_Token");?>" minlength="0" maxlength="500" data-bind="value:access_token"/>
							<span class="field-validation-error" data-valmsg-for="access_token" data-valmsg-replace="true"></span>
						</div>
					</div>
        		</div>
        		<div class="col-xs-12">
					<div class="form-group">
						<label for="access_token_secret" class="col-sm-3 control-label"><?php echo Texto::idioma("Access_Token_Secret");?></label>
						<div class="col-sm-6">
							<input id="access_token_secret" class="form-control" type="text" name="access_token_secret" placeholder="<?php echo Texto::idioma("Access_Token_Secret");?>" minlength="0" maxlength="500" data-bind="value:access_token_secret"/>
							<span class="field-validation-error" data-valmsg-for="access_token_secret" data-valmsg-replace="true"></span>
						</div>
					</div>
        		</div>
				<div class="col-xs-12">
					<div class="col-xs-6">
						<input type="hidden" name="IDsocial" id="IDsocial" data-bind="value:IDsocial" />
						<button id="btnGuardar" type="submit" class="btn btn-primary btn-block" data-loading-text="<?php echo Texto::idioma("Enviando");?>"><?php echo Texto::idioma("Guardar");?></button>
					</div>
					<div class="col-xs-6">
						<button  type="button" data-bind="click:btnCancelar" class="btn btn-warning btn-block"><?php echo Texto::idioma("Cancelar");?></button>
					</div>
				</div>
			</form>
        </div>
        <!-- Loading (remove the following to stop the loading)-->
        <div class="overlay invisible" id="lmSocial">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        <!-- end loading -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo VIEWMODEL;?>social.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(social, $("#divVista").get(0));
		social.obtenerSocial();
		social.obtenerTipoCuenta();
		app.getPermisoMenu();
        app.menuActivo("mSocial");
    });
</script>