<style>
#divResumenEstadistica {
	margin-top: 100px;
	margin-bottom: 200px;
	position: relative;
}

.divIndicador {
	width: 300px;
	float: left;
}


/* Notifications & Labels
=================================================================== */
.notification {
	position: absolute;
	top: -12px;
	right: -12px;
	line-height: 16px;
	height: 16px;
	padding: 6px 10px;
	color: white !important;
	text-shadow: 0 1px hsla(0, 0%, 0%, 0.25);
	border-width: 1px;
	border-style: solid;
	border-radius: 10px;
	-webkit-border-radius: 50em;
	-moz-border-radius: 50em;
	border-radius: 50em;
	-webkit-box-shadow: 0 1px 1px hsla(0, 0%, 0%, 0.08), inset 0 1px
		hsla(0, 100%, 100%, 0.3);
	-moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.08), inset 0 1px
		rgba(255, 255, 255, 0.3);
	box-shadow: 0 1px 1px hsla(0, 0%, 0%, 0.08), inset 0 1px
		hsla(0, 100%, 100%, 0.3);
}

.notification-small {
	padding: 2px 7px;
	color: white !important;
	text-shadow: 0 1px hsla(0, 0%, 0%, 0.25);
	border-width: 1px;
	border-style: solid;
	-webkit-border-radius: 50em;
	-moz-border-radius: 50em;
	border-radius: 50em;
	-webkit-box-shadow: 0 1px 1px hsla(0, 0%, 0%, 0.08), inset 0 1px
		hsla(0, 100%, 100%, 0.3);
	-moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.08), inset 0 1px
		rgba(255, 255, 255, 0.3);
	box-shadow: 0 1px 1px hsla(0, 0%, 0%, 0.08), inset 0 1px
		hsla(0, 100%, 100%, 0.3);
}

.notification-small,.notification {
	border-color: #2FABE9;
	background-color: #67C2EF;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(200,
		80%, 82%) ), color-stop(100%, hsl(200, 81%, 67%) ) );
	background-image: -webkit-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: -moz-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: -ms-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: -o-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
}

.notification-small.green,.notification.green {
	border-color: #5AAD34;
	background-color: #78CD51;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(101,
		54%, 71%) ), color-stop(100%, hsl(101, 55%, 56%) ) );
	background-image: -webkit-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: -moz-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: -ms-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: -o-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
}

.notification-small.yellow,.notification.yellow {
	border-color: #F4A506;
	background-color: #FABB3D;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(40,
		95%, 76%) ), color-stop(100%, hsl(40, 95%, 61%) ) );
	background-image: -webkit-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: -moz-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: -ms-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: -o-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
}

.notification-small.red,.notification.red {
	border-color: #FA5833;
	background-color: #FA603D;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(11,
		95%, 76%) ), color-stop(100%, hsl(11, 95%, 61%) ) );
	background-image: -webkit-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: -moz-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: -ms-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: -o-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
}

.label-important,.badge-important {
	border-color: #FA5833;
	background-color: #FA603D;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(11,
		95%, 76%) ), color-stop(100%, hsl(11, 95%, 61%) ) );
	background-image: -webkit-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: -moz-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: -ms-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: -o-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
}

.label-important[href],.badge-important[href] {
	border-color: #FA5833;
	background-color: #FA603D;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(11,
		95%, 76%) ), color-stop(100%, hsl(11, 95%, 61%) ) );
	background-image: -webkit-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: -moz-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: -ms-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: -o-linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
	background-image: linear-gradient(top, hsl(11, 95%, 76%),
		hsl(11, 95%, 61%) );
}

.label-warning,.badge-warning {
	border-color: #F4A506;
	background-color: #FABB3D;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(40,
		95%, 76%) ), color-stop(100%, hsl(40, 95%, 61%) ) );
	background-image: -webkit-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: -moz-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: -ms-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: -o-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
}

.label-warning[href],.badge-warning[href] {
	border-color: #F4A506;
	background-color: #FABB3D;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(40,
		95%, 76%) ), color-stop(100%, hsl(40, 95%, 61%) ) );
	background-image: -webkit-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: -moz-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: -ms-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: -o-linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
	background-image: linear-gradient(top, hsl(40, 95%, 76%),
		hsl(40, 95%, 61%) );
}

.label-success,.badge-success {
	border-color: #5AAD34;
	background-color: #78CD51;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(101,
		54%, 71%) ), color-stop(100%, hsl(101, 55%, 56%) ) );
	background-image: -webkit-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: -moz-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: -ms-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: -o-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
}

.label-success[href],.badge-success[href] {
	border-color: #5AAD34;
	background-color: #78CD51;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(101,
		54%, 71%) ), color-stop(100%, hsl(101, 55%, 56%) ) );
	background-image: -webkit-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: -moz-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: -ms-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: -o-linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
	background-image: linear-gradient(top, hsl(101, 54%, 71%),
		hsl(101, 55%, 56%) );
}

.label-info,.badge-info {
	border-color: #2FABE9;
	background-color: #67C2EF;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(200,
		80%, 82%) ), color-stop(100%, hsl(200, 81%, 67%) ) );
	background-image: -webkit-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: -moz-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: -ms-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: -o-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
}

.label-info[href],.badge-info[href] {
	border-color: #2FABE9;
	background-color: #67C2EF;
	background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, hsl(200,
		80%, 82%) ), color-stop(100%, hsl(200, 81%, 67%) ) );
	background-image: -webkit-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: -moz-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: -ms-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: -o-linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
	background-image: linear-gradient(top, hsl(200, 80%, 82%),
		hsl(200, 81%, 67%) );
}

/* Quick Buttons
=================================================================== */
.quick-button {
	border: 1px solid #ddd;
	margin-bottom: -1px;
	padding: 30px 0px 10px 0px;
	font-size: 14px;
	background-color: #fafafa;
	background-image: -moz-linear-gradient(top, #fafafa, #efefef);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fafafa),
		to(#efefef) );
	background-image: -webkit-linear-gradient(top, #fafafa, #efefef);
	background-image: -o-linear-gradient(top, #fafafa, #efefef);
	background-image: linear-gradient(to bottom, #fafafa, #efefef);
	filter: progid : dximagetransform.microsoft.gradient ( startColorstr =
		'#fafafa', endColorstr = '#efefef', GradientType = 0 );
	-webkit-box-shadow: 0 1px 0px rgba(255, 255, 255, .8);
	-moz-box-shadow: 0 1px 0px rgba(255, 255, 255, .8);
	box-shadow: 0 1px 0px rgba(255, 255, 255, .8);
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;
	display: block;
	color: #646464;
	text-shadow: 0 1px 0px rgba(255, 255, 255, .6);
	text-align: center;
	cursor: pointer;
	position: relative;
	-webkit-transition: all 0.3s ease;
	-moz-transition: all 0.3s ease;
	-ms-transition: all 0.3s ease;
	-o-transition: all 0.3s ease;
	transition: all 0.3s ease;
}

.quick-button:hover {
	text-decoration: none;
	border-color: #a5a5a5;
	color: #444444;
	text-shadow: 0 1px 0px rgba(255, 255, 255, 1);
	-webkit-transition: all 0.3s ease;
	-moz-transition: all 0.3s ease;
	-ms-transition: all 0.3s ease;
	-o-transition: all 0.3s ease;
	transition: all 0.3s ease;
	-webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, .25);
	-moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, .25);
	box-shadow: 0px 0px 3px rgba(0, 0, 0, .25);
}

.quick-button:hover .notification {
	-webkit-transition: all 0.3s ease;
	-moz-transition: all 0.3s ease;
	-ms-transition: all 0.3s ease;
	-o-transition: all 0.3s ease;
	transition: all 0.3s ease;
	-webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, .6);
	-moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, .6);
	box-shadow: 0px 0px 3px rgba(0, 0, 0, .6);
}

.quick-button i {
	font-size: 32px;
}

/* Quick Buttons Small
=================================================================== */
.quick-button-small {
	border: 1px solid #ddd;
	padding: 15px 0px 0px 0px;
	font-size: 10px;
	background-color: #fafafa;
	background-image: -moz-linear-gradient(top, #fafafa, #efefef);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fafafa),
		to(#efefef) );
	background-image: -webkit-linear-gradient(top, #fafafa, #efefef);
	background-image: -o-linear-gradient(top, #fafafa, #efefef);
	background-image: linear-gradient(to bottom, #fafafa, #efefef);
	filter: progid : dximagetransform.microsoft.gradient ( startColorstr =
		'#fafafa', endColorstr = '#efefef', GradientType = 0 );
	-webkit-box-shadow: 0 1px 0px rgba(255, 255, 255, .8);
	-moz-box-shadow: 0 1px 0px rgba(255, 255, 255, .8);
	box-shadow: 0 1px 0px rgba(255, 255, 255, .8);
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;
	display: block;
	color: #646464;
	text-shadow: 0 1px 0px rgba(255, 255, 255, .6);
	text-align: center;
	cursor: pointer;
	position: relative;
	-webkit-transition: all 0.3s ease;
	-moz-transition: all 0.3s ease;
	-ms-transition: all 0.3s ease;
	-o-transition: all 0.3s ease;
	transition: all 0.3s ease;
}

.quick-button-small:hover {
	text-decoration: none;
	border-color: #a5a5a5;
	color: #444444;
	text-shadow: 0 1px 0px rgba(255, 255, 255, 1);
	-webkit-transition: all 0.3s ease;
	-moz-transition: all 0.3s ease;
	-ms-transition: all 0.3s ease;
	-o-transition: all 0.3s ease;
	transition: all 0.3s ease;
	-webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, .25);
	-moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, .25);
	box-shadow: 0px 0px 3px rgba(0, 0, 0, .25);
}

.quick-button-small:hover .notification {
	-webkit-transition: all 0.3s ease;
	-moz-transition: all 0.3s ease;
	-ms-transition: all 0.3s ease;
	-o-transition: all 0.3s ease;
	transition: all 0.3s ease;
	-webkit-box-shadow: 0px 0px 3px rgba(0, 0, 0, .6);
	-moz-box-shadow: 0px 0px 3px rgba(0, 0, 0, .6);
	box-shadow: 0px 0px 3px rgba(0, 0, 0, .6);
}

.quick-button-small i {
	font-size: 20px;
}

.row-fluid .span2 {
	width: 14.52991452991453%;
}

[class *="span"] {
	float: left;
	min-height: 1px;
	margin-left: 20px;
}
</style>
	<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerPool',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Browser market shares at a specific website, 2010'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                    ['Firefox',   45.0],
                    ['Safari',    8.5],
                ]
            }]
        });
    });

    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containerPost',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Browser market shares at a specific website, 2010'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                    ['<?php echo Texto::idioma("Activo");?>',   45.0],
                    ['<?php echo Texto::idioma("Inactivo");?>',    8.5],
                ]
            }]
        });
    });
    
});
		</script>
<div id="divResumenEstadistica">
	<div class="sortable row-fluid ui-sortable">

		<a class="quick-button span2"> <i class="fa-icon-group"></i>
			<p>Users</p> <span class="notification">1.367</span> </a> <a
			class="quick-button span2"> <i class="fa-icon-comments-alt"></i>
			<p>Comments</p> <span class="notification green">167</span> </a> <a
			class="quick-button span2"> <i class="fa-icon-shopping-cart"></i>
			<p>Orders</p> </a> <a class="quick-button span2"> <i
			class="fa-icon-barcode"></i>
			<p>Products</p> </a> <a class="quick-button span2"> <i
			class="fa-icon-envelope"></i>
			<p>Messages</p> </a> <a class="quick-button span2"> <i
			class="fa-icon-calendar"></i>
			<p>Calendar</p> <span class="notification red">68</span> </a>

	</div>
	
	<div class="divIndicador" id="containerPost" style="min-width: 200px; height: 200px; margin: 0 auto"></div>
	<div class="divIndicador" id="containerCampana" style="min-width: 200px; height: 200px; margin: 0 auto"></div>
	<div class="divIndicador" id="containerPool" style="min-width: 200px; height: 200px; margin: 0 auto"></div>

</div>



<div class="demo">
	<div class="div-informacion2 ">

		<div class="" id="panel">
		<?php if ($idRol == 1 || $idRol == 2) {?>


			<div class="icon">
				<a href="<?php echo base_url()."estadistica/mes/post"?>"><img
					src="<?php echo IMAGE."estadistica.png"?>"
					title="<?php echo Texto::idioma("Post_Mensual", IDIOMA);?>"><span><?php echo Texto::idioma('Post_Mensual', IDIOMA);?>
				</span> </a>
			</div>

			<div class="icon">
				<a href="<?php echo base_url()."estadistica/mes/campana"?>"><img
					src="<?php echo IMAGE."estadistica.png"?>"
					title="<?php echo Texto::idioma("Campana_Mensual", IDIOMA);?>"><span><?php echo Texto::idioma('Campana_Mensual', IDIOMA);?>
				</span> </a>
			</div>

			<?php } ?>
		</div>
	</div>
</div>
<script src="<?php echo JS;?>highcharts/highcharts.js"></script>
<script src="<?php echo JS;?>highcharts/modules/exporting.js"></script>