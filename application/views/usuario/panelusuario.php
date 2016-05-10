<div class="container">
	

    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="section-heading"><?php echo Texto::idioma("Mis_Telefonos");?></h2>
            <hr class="primary">
        </div>
    </div>
</div>
<div class="container">
	<div class="panel panel-primary">
	    <!-- Default panel contents -->
	    <div class="panel-heading">
	        <div class="row">
	            <div class="col-sm-6">
	                <button type="button" class="botonFuncion btn btn-primary btn-flat" data-bind="click:btnRegistrarTelefono"><i class="fa fa-plus"></i> <?php echo Texto::idioma("Registrar");?></button>
	            </div>
	            <div class="col-sm-6">
	                <div class="input-group">
	                    <input class="form-control" id="txtBusqueda" name="txtBusqueda" placeholder="<?php echo Texto::idioma("Buscar");?>" type="text" autofocus data-bind="event:{keypress:buscarKey}, value:buscador" />
	                    <span class="input-group-btn">
	                        <button class="btn btn-default" id="btnBuscar" name="btnBuscar" type="button" data-bind="click:buscar"><i class="fa fa-search"></i></button>
	                    </span>
	                </div><!-- /input-group -->
	            </div>
	        </div>
	    </div>
	
		<table class="table">
			<thead>
				<tr>
					<th><?php echo Texto::idioma("Estatus");?></th>
					<th><?php echo Texto::idioma("Marca");?></th>
					<th><?php echo Texto::idioma("Modelo");?></th>
					<th><?php echo Texto::idioma("IMEI");?></th>
					<th><?php echo Texto::idioma("Fecha");?></th>
					<th><?php echo Texto::idioma("Accion");?></th>
				</tr>
			</thead>
			<tbody data-bind="foreach:listaTelefono">
				<tr>
					<td data-bind="html:estatus"></td>
					<td data-bind="html:marca"></td>
					<td data-bind="html:modelo"></td>
					<td data-bind="html:imei"></td>
					<td data-bind="html:fecha"></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modalTelefono">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id=""><?php echo Texto::idioma("Registrar_Telefono");?></h3>
          </div>
          <div class="modal-body">
            <div class="">
	            <div id="divMensajeE" class="invisible alert alert-danger"></div>
	        </div>
	        <div class="row">
	        	<form id="frm" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit:registrar">
	        		<div class="col-xs-6">
						<div class="form-group">
							<label for="imei" class="col-sm-3 control-label"><?php echo Texto::idioma("IMEI");?></label>
							<div class="col-sm-9">
								<input id="imei" class="required form-control digits" type="text" name="imei" placeholder="<?php echo Texto::idioma("IMEI");?>" autofocus minlegth="14" maxlength="16"/>
							</div>
						</div>
						<div class="form-group">
							<label for="marca" class="col-sm-3 control-label"><?php echo Texto::idioma("Marca", IDIOMA);?></label>
							<div class="col-sm-9">
								<input id="marca" class="required form-control" type="text" name="marca" placeholder="<?php echo Texto::idioma("Marca");?>" maxlength="100" />
							</div>
						</div>
						<div class="form-group">
							<label for="modelo" class="col-sm-3 control-label"><?php echo Texto::idioma("Modelo", IDIOMA);?></label>
							<div class="col-sm-9">
								<input id="modelo" class="required form-control" type="text" name="modelo" placeholder="<?php echo Texto::idioma("Modelo");?>" maxlength="100" />
							</div>
						</div>
						<div class="form-group">
							<label for="descripcion" class="col-sm-3 control-label"><?php echo Texto::idioma("Descripcion", IDIOMA);?></label>
							<div class="col-sm-9">
								<textarea id="descripcion" class="form-control" name="descripcion" rows="5" placeholder="<?php echo Texto::idioma("Descripcion");?>" maxlength="1000"></textarea>
							</div>
						</div>
	        		</div>
	        		<div class="col-xs-6">
						<div class="form-group">
							<label for="pais" class="col-sm-3 control-label"><?php echo Texto::idioma("Pais");?></label>
							<div class="col-sm-9">
								<input id="pais" class="required form-control" type="text" name="pais" placeholder="<?php echo Texto::idioma("Pais");?>"/>
							</div>
						</div>
						<div class="form-group">
							<label for="ciudad" class="col-sm-3 control-label"><?php echo Texto::idioma("Ciudad");?></label>
							<div class="col-sm-9">
								<input id="ciudad" class="form-control" type="text" name="ciudad" placeholder="<?php echo Texto::idioma("Ciudad");?>"/>
							</div>
						</div>
						<div class="form-group">
							<label for="estatus" class="col-sm-3 control-label"><?php echo Texto::idioma("Estatus");?></label>
							<div class="col-sm-9">
								<select name="estatus" class="form-control required">
									<option selected="selected" value="A"><?php echo Texto::idioma("Personal");?></option>
									<option value="R"><?php echo Texto::idioma("Robado");?></option>
									<option value="P"><?php echo Texto::idioma("Perdido");?></option>
									<option value="E"><?php echo Texto::idioma("Encontrado");?></option>
								</select>
							</div>
						</div>
	        		</div>
					<div class="col-xs-12">
						<div class="col-xs-6">
							<button id="btnRegistrar" type="submit" class="btn btn-primary btn-block" data-loading-text="<?php echo Texto::idioma("Enviando");?>"><?php echo Texto::idioma("Guardar");?></button>
						</div>
						<div class="col-xs-6">
							<button  type="button" class="btn btn-warning btn-block"><?php echo Texto::idioma("Cancelar");?></button>
						</div>
					</div>
				</form>
	        </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<script src="<?php echo VIEWMODEL;?>imei.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(imei, $("#divVista").get(0));
		imei.obtenerMisTelefonos();
	});	
</script>