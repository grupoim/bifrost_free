@extends('administracion.main')
@section('scripts')
<script>
	$(document).on('ready', function(){
		var data = [
		{
			label:"Ventas",
			data: [
			@for ($i = 0; $i < count($graphs["ventasTotales"]); $i++)
				[ {{{ $i }}}, '{{{ $graphs["ventasTotales"][$i]["total"] }}}'],
			@endfor
			]
		}
		]
		var options = {
			series: {
				stack: 1,
				bars: { show: true, barWidth: 0.8 }
			},
			grid: {
				borderWidth: 0, hoverable: true, color: "#777"
			},
			colors: ["#ff6c24", "#ff2424"],
			bars: {
				show: true,
				lineWidth: 0,
				fill: true,
				fillColor: { colors: [ { opacity: 0.9 }, { opacity: 0.8 } ] }
			},
			xaxis: {
				ticks: [
				@for ($i = 0; $i < count($graphs["ventasTotales"]); $i++)
				[ {{{ $i }}}, '{{{ $graphs["ventasTotales"][$i]["producto"] }}}'],
				@endfor
				]
			}
		};

		$.plot($("#bar-chart"), data, options);
	});
</script>
@stop

@section('module')

<!-- Bar Chart -->
<div class="widget">

	<div class="widget-head">
		<div class="pull-left">Ventas del mes de {{{ $currentMonth }}}</div>
		<div class="widget-icons pull-right">
			<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
			<a href="#" class="wclose"><i class="fa fa-times"></i></a>
		</div>  
		<div class="clearfix"></div>
	</div>             
	<div class="widget-content">
		<div class="padd">
			<!-- Barchart. jQuery Flot plugin used. -->
			<div id="bar-chart"></div>
		</div>
	</div>

</div>
<!-- Bar chart ends -->
@stop