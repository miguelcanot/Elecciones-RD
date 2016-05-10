<li class="header"><?php echo Texto::idioma("Accion");?></li>
<li data-bind="css:{active:app.menuActivo() == 'mDashboard'}"><a href="#" data-bind="click:mDashboard"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>

<li data-bind="visible:app.mContactoV, css:{active:app.menuActivo() == 'mContacto'}"><a href="#" data-bind="click:mContacto"><i class="fa fa-envelope text-aqua"></i> <span><?php echo Texto::idioma("Contacto");?></span></a></li>
<li data-bind="visible:app.mDenunciaV, css:{active:app.menuActivo() == 'mDenuncia'}"><a href="#" data-bind="click:mDenuncia"><i class="fa fa-bell text-aqua"></i> <span><?php echo Texto::idioma("Denuncias");?></span></a></li>
<li data-bind="visible:app.mPostSocialV, css:{active:app.menuActivo() == 'mPostSocial'}"><a href="#" data-bind="click:mPostSocial"><i class="fa fa-bullhorn text-aqua"></i> <span><?php echo Texto::idioma("Post_Social");?></span></a></li>
<li class="header"><?php echo Texto::idioma("Configuracion");?></li>
<li data-bind="visible:app.mCaracteristicaV, css:{active:app.menuActivo() == 'mCaracteristica'}"><a href="#" data-bind="click:mCaracteristica"><i class="fa fa-list text-aqua"></i> <span><?php echo Texto::idioma("Caracteristica");?></span></a></li>
<li data-bind="visible:app.mRolV, css:{active:app.menuActivo() == 'mRol'}"><a href="#" data-bind="click:mRol"><i class="fa fa-list-alt text-aqua"></i> <span><?php echo Texto::idioma("Rol");?></span></a></li>
<li data-bind="visible:app.mLogV, css:{active:app.menuActivo() == 'mLog'}"><a href="#" data-bind="click:mLog"><i class="fa fa-list-ul text-aqua"></i> <span><?php echo Texto::idioma("Log");?></span></a></li>


<li data-bind="visible:app.mUsuarioV, css:{active:app.menuActivo() == 'mUsuario'}"><a href="#" data-bind="click:mUsuario"><i class="fa fa-users text-aqua"></i> <span><?php echo Texto::idioma("Usuario");?></span></a></li>

<li data-bind="visible:app.mObjetoV, css:{active:app.menuActivo() == 'mObjeto'}"><a href="#" data-bind="click:mObjeto"><i class="fa fa-circle-o-notch text-aqua"></i> <span><?php echo Texto::idioma("Objeto");?></span></a></li>
<li data-bind="visible:app.mCambiarContrasenaV, css:{active:app.menuActivo() == 'mCambiarContrasena'}"><a href="#" data-bind="click:mCambiarContrasena"><i class="fa fa-lock text-aqua"></i> <span><?php echo Texto::idioma("Cambiar_Contrasena");?></span></a></li>

<li data-bind="visible:app.mConfiguracionV, css:{active:app.menuActivo() == 'mConfiguracion'}"><a href="#" data-bind="click:mConfiguracion"><i class="fa fa-gear text-aqua"></i> <span><?php echo Texto::idioma("Configuracion");?></span></a></li>
<li data-bind="visible:app.mSocialV, css:{active:app.menuActivo() == 'mSocial'}"><a href="#" data-bind="click:mSocial"><i class="fa fa-share-alt text-aqua"></i> <span><?php echo Texto::idioma("Social");?></span></a></li>