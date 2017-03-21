@section('scripts')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">


//comienza tema
Highcharts.theme = {
    colors: [ '#55BF3B', '#DF5353', '#7798BF','#DDDF0D', '#aaeeee', '#ff0066', '#eeaaee',
        '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
    chart: {
        backgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
            stops: [
                [0, 'rgb(48, 48, 96)'],
                [1, 'rgb(0, 0, 0)']
            ]
        },
        borderColor: '#000000',
        borderWidth: 2,
        className: 'dark-container',
        plotBackgroundColor: 'rgba(255, 255, 255, .1)',
        plotBorderColor: '#CCCCCC',
        plotBorderWidth: 1
    },
    title: {
        style: {
            color: '#C0C0C0',
            font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
        }
    },
    subtitle: {
        style: {
            color: '#666666',
            font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
        }
    },
    xAxis: {
        gridLineColor: '#333333',
        gridLineWidth: 1,
        labels: {
            style: {
                color: '#A0A0A0'
            }
        },
        lineColor: '#A0A0A0',
        tickColor: '#A0A0A0',
        title: {
            style: {
                color: '#CCC',
                fontWeight: 'bold',
                fontSize: '12px',
                fontFamily: 'Trebuchet MS, Verdana, sans-serif'

            }
        }
    },
    yAxis: {
        gridLineColor: '#333333',
        labels: {
            style: {
                color: '#A0A0A0'
            }
        },
        lineColor: '#A0A0A0',
        minorTickInterval: null,
        tickColor: '#A0A0A0',
        tickWidth: 1,
        title: {
            style: {
                color: '#CCC',
                fontWeight: 'bold',
                fontSize: '12px',
                fontFamily: 'Trebuchet MS, Verdana, sans-serif'
            }
        }
    },
    tooltip: {
        backgroundColor: 'rgba(0, 0, 0, 0.75)',
        style: {
            color: '#F0F0F0'
        }
    },
    toolbar: {
        itemStyle: {
            color: 'silver'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                color: '#CCC'
            },
            marker: {
                lineColor: '#333'
            }
        },
        spline: {
            marker: {
                lineColor: '#333'
            }
        },
        scatter: {
            marker: {
                lineColor: '#333'
            }
        },
        candlestick: {
            lineColor: 'white'
        }
    },
    legend: {
        itemStyle: {
            font: '9pt Trebuchet MS, Verdana, sans-serif',
            color: '#A0A0A0'
        },
        itemHoverStyle: {
            color: '#FFF'
        },
        itemHiddenStyle: {
            color: '#444'
        }
    },
    credits: {
        style: {
            color: '#666'
        }
    },
    labels: {
        style: {
            color: '#CCC'
        }
    },

    navigation: {
        buttonOptions: {
            symbolStroke: '#DDDDDD',
            hoverSymbolStroke: '#FFFFFF',
            theme: {
                fill: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0.4, '#606060'],
                        [0.6, '#333333']
                    ]
                },
                stroke: '#000000'
            }
        }
    },

    // scroll charts
    rangeSelector: {
        buttonTheme: {
            fill: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0.4, '#888'],
                    [0.6, '#555']
                ]
            },
            stroke: '#000000',
            style: {
                color: '#CCC',
                fontWeight: 'bold'
            },
            states: {
                hover: {
                    fill: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0.4, '#BBB'],
                            [0.6, '#888']
                        ]
                    },
                    stroke: '#000000',
                    style: {
                        color: 'white'
                    }
                },
                select: {
                    fill: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0.1, '#000'],
                            [0.3, '#333']
                        ]
                    },
                    stroke: '#000000',
                    style: {
                        color: 'yellow'
                    }
                }
            }
        },
        inputStyle: {
            backgroundColor: '#333',
            color: 'silver'
        },
        labelStyle: {
            color: 'silver'
        }
    },

    navigator: {
        handles: {
            backgroundColor: '#666',
            borderColor: '#AAA'
        },
        outlineColor: '#CCC',
        maskFill: 'rgba(16, 16, 16, 0.5)',
        series: {
            color: '#7798BF',
            lineColor: '#A6C7ED'
        }
    },

    scrollbar: {
        barBackgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            stops: [
                    [0.4, '#888'],
                    [0.6, '#555']
            ]
        },
        barBorderColor: '#CCC',
        buttonArrowColor: '#CCC',
        buttonBackgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            stops: [
                    [0.4, '#888'],
                    [0.6, '#555']
            ]
        },
        buttonBorderColor: '#CCC',
        rifleColor: '#FFF',
        trackBackgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            stops: [
                [0, '#000'],
                [1, '#333']
            ]
        },
        trackBorderColor: '#666'
    },

    // special colors for some of the
    legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
    background2: 'rgb(35, 35, 70)',
    dataLabelsColor: '#444',
    textColor: '#C0C0C0',
    maskColor: 'rgba(255,255,255,0.3)'
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);
//termina tema

Highcharts.chart('container', {
   
   
    chart: {
        type: 'column',
         
    },


    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            @foreach($categories as $cat)
            '{{{$cat->nombre}}}',
            @endforeach
            
            
        ],
        crosshair: true
    },
     legend: {
       
        align: 'center',
        verticalAlign: 'top'
    },
    yAxis: {
      
        title: {
            text: '',

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
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
        title: {
            text: '',
            
        }
    },
    legend: {
       
        align: 'center',
        verticalAlign: 'top'
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
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>${point.y:,.0f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      
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

//ventas totales apiladas
Highcharts.chart('apiladas', {
    chart: {
       
       
        type: 'column'
    },
    title: {
        text: ''
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
        
        title: {
            text: ''
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            },
            formatter: function() {   
                        return 'Total mensual: $'+  Highcharts.numberFormat(this.total, 0, ',')  ;                                
                    }
        }
    },
    legend: {
        itemDistance: 2,
        align: 'right',
        x: -30,
        verticalAlign: 'top',
        y: -3,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: ${point.y:,.0f}<br/>Total: ${point.stackTotal:,.0f}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: false,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },
    

    series: [
            @foreach($categories as $cat)
            {name:'{{{$cat->nombre}}}', 
            data:[@foreach($acumulado_apilada as $ac) @if($ac->id == $cat->id){{{$ac->total}}},@endif
                 @endforeach 
                 ]
            },
            @endforeach
            ]


});
//fin ventas totales apiladas

//grafica totales por mes
Highcharts.chart('totales_mes', {
   
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
        title: {
            text: '',
            
        }
    },
    legend: {
       
        align: 'center',
        verticalAlign: 'top'
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
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>${point.y:,.0f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      
    },
    series: [{
        name:'{{{$serie_acumulado3['name']}}}',
        data:[@foreach($serie_acumulado3['data'] as $ac) {{{ round($ac->total,0)}}},@endforeach]
       },
       {
        name:'{{{$serie_acumulado2['name']}}}',  
        data:[@foreach($serie_acumulado2['data'] as $ac)  {{{round($ac->total,0)}}},@endforeach]
       },
       {
        name:'{{{$serie_acumulado1['name']}}}', 
        data:[@foreach($serie_acumulado1['data'] as $ac) {{{round($ac->total,0)}}},@endforeach]
       },
      {
        name:'{{{$serie_acumulado['name']}}}', 
        data: [@foreach($serie_acumulado['data'] as $ac) {{{round($ac->total,0)}}},@endforeach ]
      }

     ]
});

//fin grafica totales por mes

</script> 
@stop()

@section('module')


<div class="widget">
	<div class="widget-head">
		<div class="pull-left">Acumulados anual (Escala M = Millón)</div>
		<div class="pull-right">
		<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>         
        </div>  
		<div class="clearfix"></div>
	</div>
	
	<div class="widget-content">
		<div class="padd">
		<div id="acumulados" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    
<table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>{{{$serie_acumulado3['name']}}}</th>
            <?php $sum3 = 0;?> 
            @foreach($serie_acumulado3['data'] as $d) 
                <?php $sum3 = $d->total + $sum3; ?>
                <td>${{{number_format($sum3, 0, '.', ',')}}}</td> 
            @endforeach
        </tr>
        <tr>
            <th>{{{$serie_acumulado2['name']}}}</th>
             <?php $sum2 = 0;?> 
            @foreach($serie_acumulado2['data'] as $d) 
                <?php $sum2 = $d->total + $sum2; ?>
                <td>${{{number_format($sum2, 0, '.', ',')}}}</td> 
            @endforeach
        </tr>
        <tr>
            <th>{{{$serie_acumulado1['name']}}}</th>
            <?php $sum1 = 0;?> 
            @foreach($serie_acumulado1['data'] as $d) 
                <?php $sum1 = $d->total + $sum1; ?>
                <td>${{{number_format($sum1, 0, '.', ',')}}}</td> 
            @endforeach
        </tr>
        <tr>
            <th>{{{$serie_acumulado['name']}}}</th>
            <?php $sumx = 0;?> 
            @foreach($serie_acumulado['data'] as $d) 
                <?php $sumx = $d->total + $sumx; ?>
                <td>${{{number_format($sumx, 0, '.', ',')}}}</td> 
            @endforeach
        </tr>
       
    </tbody>
    <tfoot>
         
</table>
		
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
        <div class="pull-left">Comparativas por producto {{{$mes}}} {{{$serie3['name']}}}, {{{$serie2['name']}}}, {{{$serie1['name']}}} y {{{$serie['name']}}}</div>
        <div class="pull-right">
        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>  
        </div>  
        <div class="clearfix"></div>
    </div>
    
    <div class="widget-content">
        <div class="padd">
        

        <div id="container" style="min-width: 320px; height: 500px; margin: 0 auto"></div> 
            
<div >
            <table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
           
                       
            
        </tr>
    </thead>
    <tbody>
        <tr>
            
       
            <th>{{{$serie_acumulado3['name']}}}</th>
            
           @foreach($serie3['data'] as $d)<td class="text-center">  ${{{number_format($d->monto, 0, '.', ',')}}}</td>@endforeach
        </tr>
        <tr>
            <th>{{{$serie_acumulado2['name']}}}</th>
             <?php $sum2 = 0;?> 
            @foreach($serie2['data'] as $d)<td class="text-center">  ${{{number_format($d->monto, 0, '.', ',')}}}</td>@endforeach
        </tr>
        <tr>
            <th>{{{$serie_acumulado1['name']}}}</th>
             @foreach($serie1['data'] as $d)<td class="text-center">  ${{{number_format($d->monto, 0, '.', ',')}}}</td>@endforeach
        </tr>
        <tr>
            <th>{{{$serie_acumulado['name']}}}</th>
             @foreach($serie['data'] as $d)<td class="text-center">  ${{{number_format($d->monto, 0, '.', ',')}}}</td>@endforeach
        </tr>
       
    </tbody>
    <tfoot>
         
</table>
</div>
        
       
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
        <div class="pull-left">Ventas totales {{{$mes}}} de {{{$year}}}</div>
        <div class="pull-right">
       <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>  
       </div>  
        <div class="clearfix"></div>
    </div>
    
    <div class="widget-content">
        <div class="padd">
      

        <div id="apiladas" style="min-width: 310px; height: 480px; margin: 0 auto"></div>

<table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
           
        </tr>
    </thead>
    <tbody>


@foreach($categories as $cat)
         <tr>
            
            <th class="text-left col-md-3">{{{$cat->nombre}}}</th>
           @foreach($acumulado_apilada as $ac) 
                 
                
                @if($ac->id == $cat->id)<td class="text-left col-md-5">${{{number_format($ac->total, 0, '.', ',')}}} </td>@endif 
            @endforeach

        </tr>@endforeach
      
        
       
    </tbody>
    <tfoot>
         
</table>
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
        <div class="pull-left">Totales por mes</div>
        <div class="pull-right">
        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>         
        </div>  
        <div class="clearfix"></div>
    </div>
    
    <div class="widget-content">
        <div class="padd">
        <div id="totales_mes" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    
<table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>{{{$serie_acumulado3['name']}}}</th>
            
            @foreach($serie_acumulado3['data'] as $d) 
                
                <td>${{{number_format($d->total, 0, '.', ',')}}}</td> 
            @endforeach
        </tr>
        <tr>
            <th>{{{$serie_acumulado2['name']}}}</th>
             
            @foreach($serie_acumulado2['data'] as $d) 
                
                <td>${{{number_format($d->total, 0, '.', ',')}}}</td> 
            @endforeach
        </tr>
        <tr>
            <th>{{{$serie_acumulado1['name']}}}</th>
           
            @foreach($serie_acumulado1['data'] as $d) 
               
                <td>${{{number_format($d->total, 0, '.', ',')}}}</td> 
            @endforeach
        </tr>
        <tr>
            <th>{{{$serie_acumulado['name']}}}</th>
           
            @foreach($serie_acumulado['data'] as $d) 
                
                <td>${{{number_format($d->total, 0, '.', ',')}}}</td> 
            @endforeach
        </tr>
       
    </tbody>
    <tfoot>
         
</table>
        
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

@stop