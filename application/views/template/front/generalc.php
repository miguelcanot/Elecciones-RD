<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="<?php echo Texto::idioma("Autor_App");?>">
    <meta name="keywords" content="<?php echo Texto::idioma("Keywords_App");?>">
    <meta name="description" content="<?php echo Texto::idioma("Descripcion_App");?>">  
    <meta name="Abstract" content="<?php echo Texto::idioma("Abstract");?>"> 

    <title><?php echo Texto::idioma($titulo);?></title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo CSSDEFAULT;?>bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo ASSETSDEFAULT;?>font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo CSSDEFAULTADMIN;?>AdminLTE.min.css" type="text/css">
   
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="<?php echo CSSDEFAULT;?>animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo CSSDEFAULT;?>creative.css" type="text/css">

    <!-- Custom CSS -->
    
    <link rel="stylesheet" href="<?php echo CSSDEFAULT;?>custom.css" type="text/css">
    <link href="<?php echo PLUGINS;?>toastr/toastr.min.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="<?php echo JSDEFAULT;?>jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo JSDEFAULT;?>bootstrap.min.js"></script>

    <script src="<?php echo JS;?>knockout-3.3.0.js"></script>
	<script src="<?php echo PLUGINS;?>toastr/toastr.min.js"></script>
    <!-- Google Maps -->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDfDCV5hXiPamCIT8_vwGXuzimLQ9MF76g&amp;libraries=places"></script>
 
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

   <?php $this->load->view(TEMADEFAULT."menu");?>  

    <div class="" id="divVista">
       <?php $this->load->view($vista);?>  
    </div>
    
    <?php $this->load->view(TEMADEFAULT."pie");?>  

    <!-- Plugin JavaScript -->
    <script src="<?php echo JSDEFAULT;?>jquery.easing.min.js"></script>
    <script src="<?php echo JSDEFAULT;?>jquery.fittext.js"></script>
    <script src="<?php echo JSDEFAULT;?>wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
	<script src="<?php echo JS;?>functions.min.js"></script>
    <script src="<?php echo VIEWMODEL;?>app.min.js"></script>
    <script src="<?php echo JS;?>jquery.validate.min.js"></script>
    <script src="<?php echo JS;?>jquery.validate.unobtrusive.js"></script>
	<script type="text/javascript">
        $(document).ready(function() { 
        	ko.applyBindings(app, $("#mainNav").get(0));
        	//ko.applyBindings(app, $("#divPie").get(0));
        	//ko.applyBindings(app, $("#divPanelLateral").get(0));
        	//ko.applyBindings(app, $("#divSesion").get(0));
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
        var error102 = "<?php echo Texto::idioma("ERROR-102");?>";
        var pathApi = "<?php echo HOST;?>";
        var pathWeb = "<?php echo HOST;?>";
        var imgDefault = "<?php echo IMGDEFAULT;?>";
	</script>
</body>

</html>
