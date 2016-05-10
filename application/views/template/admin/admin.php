<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo Texto::idioma($titulo);?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="author" content="<?php echo Texto::idioma("Autor_App");?>">
    <meta name="description" content="<?php echo Texto::idioma("Descripcion_App");?>">
    <meta name="robots" CONTENT="noindex, nofollow">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="<?php echo ASSETS;?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link href="<?php echo CSSDEFAULTADMIN;?>AdminLTE.min.css" rel="stylesheet">
    <link href="<?php echo CSS;?>site.css" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo CSSDEFAULTADMIN;?>skins/_all-skins.min.css" rel="stylesheet">
    <link href="<?php echo PLUGINS;?>toastr/toastr.min.css" rel="stylesheet">

    <link href="<?php echo FONTS;?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo CSS;?>bootstrap-datetimepicker.css" rel="stylesheet">
    <script src="<?php echo JS;?>jquery-1.10.2.js"></script>
    <script src="<?php echo ASSETS;?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDfDCV5hXiPamCIT8_vwGXuzimLQ9MF76g&amp;libraries=places"></script>
    <script src="<?php echo JSDEFAULTADMIN;?>app.min.js"></script>
    <!-- Libreria de metodos MC-->
    <script src="<?php echo JS;?>functions.min.js"></script>
    <!-- bootbox code -->
    <script src="<?php echo PLUGINS;?>bootbox/bootbox.min.js"></script>
    <!-- Knockout-->
    <script src="<?php echo JS;?>knockout-3.3.0.js"></script>
    <script src="<?php echo JS;?>jquery.validate.min.js"></script>
    <script src="<?php echo JS;?>jquery.validate.unobtrusive.js"></script>
    <script src="<?php echo PLUGINS;?>toastr/toastr.min.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo ICO;?>favicon.png">
    <script>
        var error00 = '@Idioma.Error00';
        var error100 = '<?php echo Texto::idioma('ERROR-102');?>';
        var domingo = "@Idioma.Domingo";
        var lunes = "@Idioma.Lunes";
        var martes = "@Idioma.Martes";
        var miercoles = "@Idioma.Miercoles";
        var jueves = "@Idioma.Jueves";
        var viernes = "@Idioma.Viernes";
        var sabado = "@Idioma.Sabado";
        var si = "@Idioma.Si";
        var no = "@Idioma.No";  
        var activo = '<?php echo Texto::idioma('Activo');?>';
        var inactivo = '<?php echo Texto::idioma('Inactivo');?>';
        var pendiente = '<?php echo Texto::idioma('Pendiente');?>';
        var mensajeDistribuirEncuesta = "@Idioma.MensajeDistribuirEncuesta";
        //Services config
        var pathApi = "<?php echo base_url();?>";
        var pathWeb = "<?php echo base_url();?>";
        
        $(document).ready(function () {
            //app.getPermisoMenu();
        });
    </script>
</head>
<body class="skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header" id="header">
            <!-- Logo -->
            <a href="<?php echo HOST."admin";?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"></span>
                <!-- logo for regular state and mobile devices -->
                <?php $config = $this->session->userdata("sConfiguracion");?>
                <span class="logo-lg"><?php echo $config->empresa;?></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                       
                        <!-- Tasks: style can be found in dropdown.less -->
                        
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown" data-bind="visible:usuarioLog">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img class="imgPerfil media-object img-responsive" alt="" data-bind="attr:{src:imgPerfil}" src="">
                                <span data-bind="html:nombreApellido"></span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li data-bind="visible:usuarioLog"><a href="#" data-bind="click:btnPerfil"><?php echo Texto::idioma("Perfil");?></a></li>
                                <li data-bind="visible:usuarioLog"><a href="#" data-bind="click:btnCambiarContrasena"><?php echo Texto::idioma("Cambiar_Contrasena");?></a></li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-bind="click:cerrarSesion"><i class="fa fa-power-off"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar" id="divMenu">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="" class="img-circle" alt="User Image" data-bind="attr:{src:imgPerfil}"/>
                    </div>
                    <div class="pull-left info">
                      <p data-bind="html:usuario"></p>                                    
                      <h5 href="#" data-bind="html:rol"></h5>
                    </div>
                </div>
                <form action="#" method="post" class="sidebar-form">
                    <div class="input-group">
                      <input type="text" name="q" class="form-control" placeholder="Search...">
                      <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu"><?php $this->load->view(TEMADEFAULTADMIN."menu");?></ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            
            <section class="content-header">
                <h3 class="page-title">
                    <?php echo Texto::idioma($titulo);?>
                    <?php if (isset($subTitulo)) {?><small> | <?php echo Texto::idioma($subTitulo);?></small><?php }?>
                </h3>
                <!--
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
                    -->
            </section>

            <!-- Main content -->
            <section class="content" id="divVista">
                <div class="row">
                    <div class="col-md-6 col-md-offset-2 ">
                        <?php if (isset($mensaje)) {?>
                            <div class="alert alert-danger"><?php echo Texto::idioma($mensaje);?></div>
                        <?php }?>
                        <div id="divMensajeS" class="invisible alert alert-success"></div>
                        <div id="divMensajeE" class="invisible alert alert-danger"></div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="overlay invisible" id="divLoader">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-body">
                        <?php $this->load->view($vista);?>
                    </div>
                </div>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b><?php echo Texto::idioma("Version");?></b> <?php echo Texto::idioma("Version_App");?>
            </div>
            <?php echo Texto::idioma("Copyright");?>
        </footer>
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <script src="<?php echo VIEWMODEL;?>app.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() { 
            ko.applyBindings(app, $("#header").get(0));
            ko.applyBindings(app, $("#divMenu").get(0));
            <?php 
                if ($this->session->userdata("sUsuario")) {
                    $user = $this->session->userdata("sUsuario");
            ?>
                    app.usuarioLog(true);
                    app.obtenerPerfil();
                    app.usuario("<?php $user['nombre'].' '.$user['apellido'];?>");
            <?php
                    if ($user["estatus"] == "P") {
            ?>
                        $('#notificacionSesion').modal('show');
            <?php
                    }
                }
            ?>
        });
        var pathApi = "<?php echo HOST;?>";
        var pathWeb = "<?php echo HOST;?>";
        var mensajeConfirmacionModificar = "<?php echo Texto::idioma("mensajeConfirmacionModificar");?>";
        var mensajeConfirmacionEliminar = "<?php echo Texto::idioma("mensajeConfirmacionEliminar");?>";
    </script>


</body>
</html>