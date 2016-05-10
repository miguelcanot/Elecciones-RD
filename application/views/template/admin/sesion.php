<!DOCTYPE html>

<html>
<head>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="author" content="<?php echo Texto::idioma("Autor_App");?>">
    <meta name="description" content="<?php echo Texto::idioma("Descripcion_App");?>">
    <meta name="robots" CONTENT="noindex, nofollow">
    <title><?php echo Texto::idioma($titulo);?></title>
    <link href="<?php echo ASSETS;?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link href="<?php echo CSSDEFAULTADMIN;?>AdminLTE.min.css" rel="stylesheet">
    <link href="<?php echo CSS;?>site.css" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo CSSDEFAULTADMIN;?>skins/_all-skins.min.css" rel="stylesheet">
    
    <link href="<?php echo FONTS;?>css/font-awesome.min.css" rel="stylesheet">
    <script src="<?php echo JS;?>jquery-1.10.2.js"></script>
    <script src="<?php echo ASSETS;?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo JSDEFAULTADMIN;?>app.min.js"></script>
    <!-- Libreria de metodos MC-->
    <script src="<?php echo JS;?>functions.min.js"></script>
    <!-- bootbox code -->
    <script src="<?php echo PLUGINS;?>bootbox/bootbox.min.js"></script>
    <!-- Knockout-->
    <script src="<?php echo JS;?>knockout-3.3.0.js"></script>
    <script src="<?php echo JS;?>jquery.validate.min.js"></script>
    <script src="<?php echo JS;?>jquery.validate.unobtrusive.js"></script>
    <script type="text/javascript">
        var error00 = '@Idioma.Error00';
        //Services config
        var pathApi = "<?php echo base_url();?>";
        var pathWeb = "<?php echo base_url();?>";
    </script>
</head>
<body class="bg-black login-page">
    <?php $this->load->view("usuario/sesion");?>
</body>
</html>