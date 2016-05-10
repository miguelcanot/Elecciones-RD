<script type="text/javascript">
$(document).ready(function() { 
	toogleBoton("M", "btnFunAtras", "<?php echo base_url()."estadistica";?>");
});
</script>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'line'
            },
            title: {
                text: '<?php echo $tituloGrafico;?>'
            },
            subtitle: {
                text: '<?php echo $subTituloGrafico;?>'
            },
            xAxis: {
                categories: ['<?php echo $categoria;?>']
            },
            yAxis: {
                title: {
                    text: '<?php echo $ejeY;?>'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y;
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [<?php echo $serie;?>]
        });
    });
    
});
</script>
<script src="<?php echo JS;?>highcharts/highcharts.js"></script>
<script src="<?php echo JS;?>highcharts/modules/exporting.js"></script>
<div class="demo">
	<div class="div-informacion2 ">
		<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
	</div>
</div>
