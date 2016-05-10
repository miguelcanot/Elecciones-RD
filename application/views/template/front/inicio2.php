<!DOCTYPE html>
<html lang="en">
<head>
	<!-- META -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="author" content="<?php echo Texto::idioma("Autor_App");?>">
    <meta name="keywords" content="<?php echo Texto::idioma("Keywords_App");?>">
    <meta name="description" content="<?php echo Texto::idioma("Descripcion_App");?>">    
    <meta name="theme-color" content="#141619">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="<?php echo ICO;?>favicon.png">

    <title><?php echo $titulo;?></title>
	
	
	<!-- CORE CSS -->
	<link rel="stylesheet" href="<?php echo PLUGINSDEFAULT;?>bootstrap/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo CSSDEFAULT;?>theme.css" type="text/css">
	<link rel="stylesheet" href="<?php echo CSSDEFAULT;?>custom.css" type="text/css">
	<link rel="stylesheet" href="<?php echo CSSDEFAULT;?>helpers.min.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'> 
    
	<!-- PLUGINS -->
	<link href="<?php echo PLUGINSDEFAULT;?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo PLUGINSDEFAULT;?>ionicons/css/ionicons.min.css" rel="stylesheet">
	<link href="<?php echo PLUGINSDEFAULT;?>animate/animate.min.css" rel="stylesheet">
	<link href="<?php echo PLUGINSDEFAULT;?>animate/animate.delay.css" rel="stylesheet">
	<link href="<?php echo PLUGINSDEFAULT;?>owl-carousel/owl.carousel.css" rel="stylesheet">
</head>

<body class="fixed-header">
	<?php $this->load->view(TEMADEFAULT."tfacebook");?>

	<?php $this->load->view(TEMADEFAULT."tganalytics");?> 

	<header>
		<?php $this->load->view(TEMADEFAULT."menu");?>   
	</header>
	<!-- /header -->
	
	<div class="modal-search">
		<div class="container">
			<input type="text" class="form-control" placeholder="Type to search...">
			<i class="fa fa-times close"></i>
		</div>
	</div><!-- /.modal-search -->
	
	<!-- wrapper --> 
	<div id="wrapper">	
		
	</div>
	<!-- /#wrapper -->
	
	<!-- footer -->
	<footer>
		<div class="container">
			<div class="widget row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<h4 class="title">About GameForest</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pharetra mattis arcu, a congue leo malesuada eu. Nam nec mauris ut odio tristique varius et eu metus. Quisque massa purus, aliquet quis blandit et, <br /> <br />mollis sed lorem. Sed vel tincidunt elit. Phasellus at varius odio, sit amet fermentum mauris.</p>
				</div>
					
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<h4 class="title">Categories</h4>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
							<ul class="nav">
								<li><a href="#">Playstation 4</a></li>
								<li><a href="#">XBOX ONE</a></li>
								<li><a href="#">PC</a></li>
								<li><a href="#">PS3</a></li>
							</ul>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<ul class="nav">
								<li><a href="#">Gaming</a></li>
								<li><a href="#">Portfolio</a></li>
								<li><a href="#">Videos</a></li>
								<li><a href="#">Reviews</a></li>
							</ul>
						</div>
					</div>
				</div>
		
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<h4 class="title">Email Newsletters</h4>
					<p>Subscribe to our newsletter and get notification when new games are available.</p>
					<form method="post" class="btn-inline form-inverse">
						<input type="text" class="form-control" placeholder="Email..." />
						<button type="submit" class="btn btn-link"><i class="fa fa-envelope"></i></button>
					</form>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">	
				<ul class="list-inline">
					<li><a href="#" class="btn btn-circle btn-social-icon" data-toggle="tooltip" title="Follow us on Twitter"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#" class="btn btn-circle btn-social-icon" data-toggle="tooltip" title="Follow us on Facebook"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#" class="btn btn-circle btn-social-icon" data-toggle="tooltip" title="Follow us on Google"><i class="fa fa-google-plus"></i></a></li>
					<li><a href="#" class="btn btn-circle btn-social-icon" data-toggle="tooltip" title="Follow us on Steam"><i class="fa fa-steam"></i></a></li>
				</ul>
				&copy; 2016 Gameforest. All rights reserved.
			</div>
		</div>
	</footer>	
	<!-- /.footer -->
	
	<div id="signin" class="modal fade" tabindex="-1">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title"><i class="fa fa-user"></i> Sign In to Gameforest</h3>
				</div>
				<div class="modal-body">
					<a class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i> Connect with Facebook</a>
					<div class="separator"><span>or</span></div>								
				</div>
				<div class="modal-footer text-left">
					Don't have Gameforest account? <a href="register.html">Sign Up Now</a>
				</div>
			</div>
		</div>
	</div><!-- /.modal --> 
	
	<!-- Javascript -->
	<script src="<?php echo PLUGINSDEFAULT;?>jquery/jquery-1.11.1.min.js"></script>
	<script src="<?php echo PLUGINSDEFAULT;?>bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo PLUGINSDEFAULT;?>core.js"></script>
	<script src="<?php echo PLUGINSDEFAULT;?>owl-carousel/owl.carousel.min.js"></script>
	<script src="<?php echo PLUGINSDEFAULT;?>masonry/imagesloaded.pkgd.min.js"></script>
	<script src="<?php echo PLUGINSDEFAULT;?>masonry/masonry.pkgd.min.js"></script>
	<script>
	(function($) {
	"use strict";
		var owl = $(".owl-carousel");
			 
		owl.owlCarousel({
			items : 4, //4 items above 1000px browser width
			itemsDesktop : [1000,3], //3 items between 1000px and 0
			itemsTablet: [600,1], //1 items between 600 and 0
			itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
		});
			 
		$(".next").click(function(){
			owl.trigger('owl.next');
			return false;
		})
		$(".prev").click(function(){
			owl.trigger('owl.prev');
			return false;
		})
	})(jQuery);
	</script>
</body>
</html>