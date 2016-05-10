<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $titulo;?></title>
	<script type="text/javascript" src="<?php echo JS;?>jquery-1.10.2.min.js"></script>
	<link href="<?php echo ASSETS;?>bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo FONTS;?>css/font-awesome.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="<?php echo CSS;?>site.css" rel="stylesheet" />	
	<link rel="shortcut icon" href="<?php echo ICO;?>favicon.png">
</head>

<body class="texture">

	<div id="cl-wrapper" class="error-container">
		<div class="page-error">
			<h1 class="number text-center">404</h1>
			<h2 class="description text-center"><?php echo Texto::idioma("Sorry, but this page doesn't exists");?>!</h2>
			<h3 class="text-center"><?php echo Texto::idioma("Would you like to go");?> <a href="<?php echo base_url();?>"><?php echo Texto::idioma("Inicio");?></a>?</h3>
		</div>
		<div class="text-center copy"><a href="#"><?php echo Texto::idioma("Copyright");?></a></div>
	</div>
	<script type="text/javascript">
	  $(function(){
	    $("#cl-wrapper").css({opacity:1,'margin-left':0});
	  });
	</script>
</body>
</html>