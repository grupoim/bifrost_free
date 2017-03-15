@section('scripts')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">



 Highcharts.theme = {
    colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
             '#FF9655', '#FFF263', '#6AF9C4'],
    chart: {
        backgroundColor: {
            linearGradient: [0, 0, 500, 500],
            stops: [
                [0, 'rgb(255, 255, 255)'],
                [1, 'rgb(240, 240, 255)']
            ]
        },
    },
    title: {
        style: {
            color: '#000',
            font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
        }
    },
    subtitle: {
        style: {
            color: '#666666',
            font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
        }
    },

    legend: {
        itemStyle: {
            font: '9pt Trebuchet MS, Verdana, sans-serif',
            color: 'black'
        },
        itemHoverStyle:{
            color: 'gray'
        }   
    }
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);

Highcharts.chart('container', {
    
   data: {
    table: document.getElementById('datatable'),
    startRow: 1
},
    chart: {
        type: 'column',
         
    },


    title: {
        text: 'Ventas comparativas'
    },
    subtitle: {
        text: '{{{$mes}}} {{{$serie3['name']}}}, {{{$serie2['name']}}}, {{{$serie1['name']}}} y {{{$serie['name']}}}'
    },
    xAxis: {
        categories: [
            @foreach($categories as $cat)
            '{{{$cat->nombre}}}',
            @endforeach
            
            
        ],
        crosshair: true
    },
    yAxis: {
        min: 1000,
        title: {
            text: 'Ventas'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>${point.y:,.0f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
        
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
   series: [    
   

   {
        name: '{{{$serie3['name']}}}',
        data: [@foreach($serie3['data'] as $d) {{{round($d->monto,0)}}}, @endforeach]
        

    },

   {
        name: '{{{$serie2['name']}}}',
        data: [@foreach($serie2['data'] as $d) {{{round($d->monto,0)}}}, @endforeach]
        

    },

    {
        name: '{{{$serie1['name']}}}',
        data: [@foreach($serie1['data'] as $d) {{{round($d->monto,0)}}}, @endforeach]
        

    },

     

    {
        name: '{{{$serie['name']}}}',
        data: [@foreach($serie['data'] as $d) {{{round($d->monto,0)}}}, @endforeach]
        

    },
   
    ]
});

//grafica de acumulados
Highcharts.chart('acumulados', {
   
    title: {
        text: 'Monthly Average Temperature'
    },
    subtitle: {
        text: 'Source: WorldClimate.com'
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
        title: {
            text: 'Temperature (°C)'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: false
            },
            enableMouseTracking: true
        }
    },
       tooltip: {
        formatter: function () {
            var s = '<b>' + this.x + '</b>';

            $.each(this.points, function () {
                s += '<br/>' + this.series.name + ': ' +
                    '$'+ this.y;
            });

            return s;
        },
        shared: true
    },
    series: [{
        name:'{{{$serie_acumulado3['name']}}}', <?php $sum3 = 0;?>
        data:[@foreach($serie_acumulado3['data'] as $ac) <?php $sum3 = $ac->total + $sum3; ?> {{{ round($sum3,0)}}},@endforeach]
       },
       {
        name:'{{{$serie_acumulado2['name']}}}', <?php $sum2 = 0; ?> 
        data:[@foreach($serie_acumulado2['data'] as $ac) <?php $sum2 = $ac->total + $sum2; ?> {{{round($sum2,0)}}},@endforeach]
       },
       {
        name:'{{{$serie_acumulado1['name']}}}', <?php $sum1 = 0; ?> 
        data:[@foreach($serie_acumulado1['data'] as $ac) <?php $sum1 = $ac->total + $sum1; ?> {{{round($sum1,0)}}},@endforeach]
       },
      {
        name:'{{{$serie_acumulado['name']}}}', <?php $sumx = 0; ?>
        data: [@foreach($serie_acumulado['data'] as $ac) <?php $sumx = $ac->total + $sumx; ?> {{{round($sumx,0)}}},@endforeach ]
      }

     ]
});

//fin grafica acumulados

</script> 
@stop()

@section('module')


<div class="widget">
	<div class="widget-head">
		<div class="pull-left">Comparativas por producto</div>
		<div class="pull-right">
		<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>         
        </div>  
		<div class="clearfix"></div>
	</div>
	
	<div class="widget-content">
		<div class="padd">
		<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    {{{$datos}}}
		
		</div>
	</div>


	<div class="widget-foot">
		<div class="pull-right">
			<div class="btn-group">
				
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>


<div class="widget">
    <div class="widget-head">
        <div class="pull-left">Acumulados anual</div>
        <div class="pull-right">
        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>  
        </div>  
        <div class="clearfix"></div>
    </div>
    
    <div class="widget-content">
        <div class="padd">
        

        <div id="acumulados" style="min-width: 310px; height: 400px; margin: 0 auto"></div> 

       
        </div>
    </div>


    <div class="widget-foot">
        <div class="pull-right">
            <div class="btn-group">
               
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

{{--
<div class="widget">
    <div class="widget-head">
        <div class="pull-left">Comisiones pendientes</div>
        <div class="pull-right">
        <a href="#myModal" class="btn btn-primary" data-toggle="modal"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Sube Archivo </a>
        <a href="{{action('ComisionControlador@getPeriodos')}}" class="btn btn-success" data-toggle="modal"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Periodos </a>
        </div>  
        <div class="clearfix"></div>
    </div>
    
    <div class="widget-content">
        <div class="padd">
      

        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>


    <div class="widget-foot">
        <div class="pull-right">
            <div class="btn-group">
                <button class="btn btn-danger">Cancelar</button>
                <button class="btn btn-primary">Pagar</button>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div> --}}

@stop