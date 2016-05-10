<div class="">
	<div class="panel panel-default">
	    <!-- Default panel contents -->
	    <div class="panel-heading">
	        <div class="row">
	            <div class="col-xs-6">
	                <button type="button" class="botonFuncion btn btn-primary btn-flat" data-bind="click:btnConfig"><i class="fa fa-gear" title="<?php echo Texto::idioma("Configuracion");?>"></i></button>
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
						<th><?php echo Texto::idioma("Publicacion");?></th>
						<th><?php echo Texto::idioma("Usuario");?></th>
						<th><?php echo Texto::idioma("RT");?></th>
						<th><?php echo Texto::idioma("Like");?></th>
						<th><?php echo Texto::idioma("Red_Social");?></th>
						<th><?php echo Texto::idioma("Estatus");?></th>
						<th><?php echo Texto::idioma("Accion");?></th>
					</tr>
				</thead>
				<tbody data-bind="foreach:listaPostSocial">
					<tr>
						<td data-bind="html:Fecha"></td>
						<td data-bind="html:Cuerpo"></td>
						<td data-bind="html:Usuario"></td>
						<td data-bind="html:RT"></td>
						<td data-bind="html:Like"></td>
						<td data-bind="html:TipoCuenta"></td>
						<td data-bind="html:Estatus.icono"></td>
						<td>
							<button type="button" class="btn btn-info btn-xs" data-bind="click:$parent.verPost" title='<?php echo Texto::idioma("Ver");?>'><i class="fa fa-circle"></i></button> |
                    		<button type="button" class="btn btn-success btn-xs" data-bind="click:$parent.aprobar" title='<?php echo Texto::idioma("Aprobar");?>'><i class="fa fa-check"></i></button> |
	                    	<button type="button" class="btn btn-danger btn-xs" data-bind="click:$parent.eliminar" title='<?php echo Texto::idioma("Eliminar");?>'><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				</tbody>
				<tbody data-bind="visible: listaPostSocial().length == 0">
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
        <div class="overlay invisible" id="lPostSocial">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        <!-- end loading -->
	</div>
</div>

<div class="modal fade" id="modalConfig">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?php echo Texto::idioma("Config");?></h3>
      </div>
      <div class="modal-body">
        <div class="row">
        	<form id="frmConfig" class="form-horizontal" action="#" style="border-radius: 0px;" method="post" data-bind="submit:registrarConfig">
        		<div class="col-xs-12">
					<div class="form-group">
						<label for="Descripcion" class="col-sm-3 control-label"><?php echo Texto::idioma("Descripcion");?></label>
						<div class="col-sm-6">
							<input id="Descripcion" class="required form-control" type="text" name="Descripcion" placeholder="<?php echo Texto::idioma("Descripcion");?>" maxlength="100"/>
							<span class="" data-valmsg-for="Descripcion" data-valmsg-replace="true"></span>
						</div>
					</div>
			        <div class="form-group">
						<label for="Tipo" class="col-sm-3 control-label"><?php echo Texto::idioma("Tipo");?></label>
						<div class="col-sm-6">
							<select id="Tipo" name="Tipo" data-bind="options: listaTipo, optionsValue:'id', optionsText:'nombre', optionsCaption: '<?php echo Texto::idioma("Seleccionar");?>...'" class="required form-control"></select>
							<span class="" data-valmsg-for="Tipo" data-valmsg-replace="true"></span>
						</div>
					</div>
        		</div>
				<div class="col-xs-12">
					<div class="col-md-6 col-md-offset-3">
						<button id="btnGuardar" type="submit" class="btn btn-primary btn-block" data-loading-text="<?php echo Texto::idioma("Enviando");?>"><?php echo Texto::idioma("Guardar");?></button>
					</div>
				</div>
			</form>
        	<div class="col-xs-12 col-md-8 col-md-offset-2" data-bind="foreach:listaDetalle">
				<div class="bs-callout bs-callout-info"> 
				<h4><span data-bind="attr:{class:'fa fa-'+Icono}"></span> <span data-bind="html:Tipo.icono + Descripcion"></span> <button type="button" class="btn btn-danger btn-xs pull-right" data-bind="click:postSocial.eliminarConfig" title='<?php echo Texto::idioma("Eliminar");?>'><i class="fa fa-trash"></i></button></h4>
				</div>
			</div>
			<!-- Loading (remove the following to stop the loading)-->
			<div class="overlay invisible" id="lmPostSocial">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			<!-- end loading -->
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalVerPost" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" ><?php echo Texto::idioma("Publicacion");?></h3>
      </div>
      <div class="modal-body">
		  <iframe id="ifPost" width="100%" height="600" frameborder="0" ></iframe>
		</div>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo VIEWMODEL;?>postsocial.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(postSocial, $("#divVista").get(0));
		postSocial.obtenerPostSocial();
		app.getPermisoMenu();
        app.menuActivo("mPostSocial");
    });
</script>