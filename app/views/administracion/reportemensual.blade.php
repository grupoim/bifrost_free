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

        },
       labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
    },
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
            
        },
       labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
    },
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
                labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
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

// ventas totales febrero 

Highcharts.chart('VentasTotal', {

    title: {
        text: ''
    },

    subtitle: {
        text: ''
    },
   xAxis: {
        categories: ['{{{$serie3['name']}}}','{{{$serie2['name']}}}','{{{$serie1['name']}}}','{{{$serie['name']}}}']
    },
    yAxis: {
        title: {
            text: ''
        },
        labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
    },
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },
   tooltip: {
       pointFormat: '<b>${point.y:,.2f}</b> USD'
    },

  plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },

    series: [{
        name: '{{{$mes}}}',
        data: [@foreach($serie_total['data'] as $d) {{{round($d->total,0)}}}, @endforeach]
    }]

});
//fin ventas totales  febrero

//grafica vendedores mes, 2017
Highcharts.chart('vendedores', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
          xAxis: {
        categories: [
            @foreach($vendedores as $ven)
            '{{{$ven->asesor}}}',
            @endforeach
        ],
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        },
        labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
    },
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: false
    },

    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'gray'
            }
        }
    },

    series: [{
       
        data: [@foreach($serie_vendedores['data'] as $d) {{{round($d->monto,0)}}}, @endforeach ],
  
    }]
});
//fin de grafica de vendedores 

// grafica de promotorias

Highcharts.chart('promotorias', {
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
        labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
    },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            },
            formatter: function() {   
                        return 'Total mensual: $'+  Highcharts.numberFormat(this.total, 0, ',')  ;                                
                 },                  
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
            @foreach($promotor as $pro)
            {
                name:'{{{$pro->promotor}}}', 
            data:[@foreach($serie_promotoria as $sep) @if($sep->promotor == $pro->promotor){{{$sep->total}}},@endif
                 @endforeach 
                 ]
            },
            @endforeach
            ]


});
// fin  de graficas promotorias

// grafica de extras 
Highcharts.chart('Extras', {

    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Extras {{{$mes}}} {{{$serie['name']}}}'
    },
    tooltip: {
           pointFormat: '{series.name}: ${point.y:,.0f}<br/>'
    },
          subtitle: {
        text: 'Extras total:@foreach($serie_extra_total as $ex_total) ${{{number_format($ex_total->total, 0, '.', ',')}}}@endforeach'

    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: ${point.y:,.0f}',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                },
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Total',
        data: [
         @foreach($serie_extra as $ext)
            { name: '{{{$ext->nombre}}}', y: {{{$ext->monto}}} },
               @endforeach            
        ]
    }]
});
    // fin de grafica extras

//empieza grafica cartera cliente ///////////////////////////////////////// MODIFICADO
Highcharts.chart('Cartera', {
   
   
    chart: {
        type: 'column',
         
    },

    title: {
        text: 'Cartera clientes {{{$mes}}} {{{$serie['name']}}}'
    },
      subtitle: {
          text: 'Cartera total:@foreach($serie_cartera_total as $car_total) ${{{number_format($car_total->total, 0, '.', ',')}}}@endforeach'
    },
    xAxis: {
        categories: ['{{{$fechas['mes3']}}}','{{{$fechas['mes2']}}}','{{{$fechas['mes']}}}'
            
            
        ],
        crosshair: true
    },
   yAxis: {
        min: 0,
        title: {
            text: ''
        },
       labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
    },

    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>${point.y:,.0f}</b></td></tr>',
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
   

        @foreach($categories_cartera as $cat)
        {
        name:'{{{$cat->nombre}}}',
        data:[@foreach($serie_cartera as $scats) @if($scats->nombre == $cat->nombre and $scats->month == $fechas['month3'] and $scats->year == $fechas['year']){{{$scats->monto}}},@endif 
                                                 @if($scats->nombre == $cat->nombre and $scats->month == $fechas['month2'] and $scats->year == $fechas['year']){{{$scats->monto}}},@endif  
                                                 @if($scats->nombre == $cat->nombre and $scats->month == $fechas['month'] and $scats->year == $fechas['year']){{{$scats->monto}}},@endif  @endforeach ]
        },
  @endforeach


    ]
});

//termina grafica cartera cliente ///////////////////////////////////////////////////////////
// grafica de cartera pastel /&//#$%"""""""""""""""""#$&"#$%&$%/&$/&2346" MODIFICADO
Highcharts.chart('Cartera_pastel', {

    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Cartera clientes {{{$mes}}} {{{$serie['name']}}}'
    },

    tooltip: {
           pointFormat: '{series.name}: ${point.y:,.0f}<br/>'
    },
    subtitle: {
          text: 'Cartera total:@foreach($serie_cartera_total as $car_total) ${{{number_format($car_total->total, 0, '.', ',')}}}@endforeach'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
               format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                },
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Total',
        data: [@foreach($serie_cartera as $d) @if($d->month == $fechas['month'] and $d->year == $fechas['year']) { name:'{{{$d->nombre}}}', y: {{{$d->monto}}} }, @endif @endforeach]

    }]
});
    // fin de grafica cartera pastel 1246b c1111113478902634628903648274723894789237489723489


//termina grafica cartera cliente
//empieza grafica cartera acumulada MODIFICADO ///////////////////////////////////////////////////
Highcharts.chart('Cartera_acumulado', {
 chart: {
        type: 'column'
    },
    title: {
        text: 'Cartera clientes {{{$mes}}} {{{$serie['name']}}}'
    },
      subtitle: {
          text: 'Cartera total:@foreach($serie_cartera_total as $car_total) ${{{number_format($car_total->total, 0, '.', ',')}}}@endforeach'
    },

    xAxis: {
                categories: ['{{{$fechas['mes3']}}}','{{{$fechas['mes2']}}}','{{{$fechas['mes']}}}'
            
            
        ],
      
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        },
       labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
    },

    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>${point.y:,.0f}</b></td></tr>',
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
    series: [{
        name:'Atrasado', 
        data: [@foreach($serie_cartera as $sc) @if($sc->nombre == 'Atrasado 31 a 60 dias' and $sc->month == $fechas['month3'] and $sc->year == $fechas['year'])<?php $sum3 = $sc->monto  ?> @else <?php $sum3 = 0;?> @endif @endforeach 
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Atrasado 61 a 90 dias' and $sc->month == $fechas['month3'] and $sc->year == $fechas['year'])<?php $sum2 = $sc->monto + $sum3; ?>@else <?php $sum2 = 0;?> @endif @endforeach
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Atrasado 91 a 120 dias' and $sc->month == $fechas['month3'] and $sc->year == $fechas['year'])<?php $sum_atrasado3 = $sc->monto + $sum2; ?>  {{{round($sum_atrasado3,0)}}}, @endif @endforeach  
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Atrasado 31 a 60 dias' and $sc->month == $fechas['month2'] and $sc->year == $fechas['year'])<?php $sum3 = $sc->monto  ?> @else <?php $sum3 = 0;?> @endif @endforeach 
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Atrasado 61 a 90 dias' and $sc->month == $fechas['month2'] and $sc->year == $fechas['year'])<?php $sum2 = $sc->monto + $sum3; ?> @else <?php $sum2 = 0;?> @endif @endforeach
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Atrasado 91 a 120 dias' and $sc->month == $fechas['month2'] and $sc->year == $fechas['year'])<?php $sum_atrasado2 = $sc->monto + $sum2; ?>  {{{round($sum_atrasado2,0)}}}, @endif @endforeach  
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Atrasado 31 a 60 dias' and $sc->month == $fechas['month'] and $sc->year == $fechas['year'])<?php $sum3 = $sc->monto  ?>@else <?php $sum3 = 0;?> @endif @endforeach 
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Atrasado 61 a 90 dias' and $sc->month == $fechas['month'] and $sc->year == $fechas['year'])<?php $sum2 = $sc->monto + $sum3; ?>@else <?php $sum2 = 0;?> @endif @endforeach
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Atrasado 91 a 120 dias' and $sc->month == $fechas['month'] and $sc->year == $fechas['year'])<?php $sum_atrasado = $sc->monto + $sum2; ?>  {{{round($sum_atrasado,0)}}}, @endif @endforeach  
        ]
       },

        {
        name: 'Vencido',
       data: [@foreach($serie_cartera as $sc) @if($sc->nombre == 'Vencido 121 dias en delante' and $sc->month == $fechas['month3'] and $sc->year == $fechas['year']) {{{round($sc->monto,0)}}}, @endif 
                                            @if($sc->nombre == 'Vencido 121 dias en delante' and $sc->month == $fechas['month2'] and $sc->year == $fechas['year']) {{{round($sc->monto,0)}}}, @endif
                                            @if($sc->nombre == 'Vencido 121 dias en delante' and $sc->month == $fechas['month'] and $sc->year == $fechas['year']) {{{round($sc->monto,0)}}}, @endif @endforeach]

    }, {
        name: 'Al corriente',   
        data: [@foreach($serie_cartera as $sc) @if($sc->nombre == 'Al corriente 1 a 30 dias' and $sc->month == $fechas['month3'] and $sc->year == $fechas['year'])<?php $sum2 = $sc->monto  ?>@else <?php $sum2 = 0;?> @endif @endforeach 
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Por vencer' and $sc->month == $fechas['month3'] and $sc->year == $fechas['year'])<?php $sum_alcorriente3 = $sc->monto + $sum2; ?> {{{round($sum_alcorriente3,0)}}},@endif @endforeach
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Al corriente 1 a 30 dias' and $sc->month == $fechas['month2'] and $sc->year == $fechas['year'])<?php $sum2 = $sc->monto  ?>@else <?php $sum2 = 0;?> @endif @endforeach 
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Por vencer' and $sc->month == $fechas['month2'] and $sc->year == $fechas['year'])<?php $sum_alcorriente2 = $sc->monto + $sum2; ?> {{{round($sum_alcorriente2,0)}}},@endif @endforeach
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Al corriente 1 a 30 dias' and $sc->month == $fechas['month'] and $sc->year == $fechas['year'])<?php $sum2 = $sc->monto  ?>@else <?php $sum2 = 0;?> @endif @endforeach 
               @foreach($serie_cartera as $sc) @if($sc->nombre == 'Por vencer' and $sc->month == $fechas['month'] and $sc->year == $fechas['year'])<?php $sum_alcorriente = $sc->monto + $sum2; ?> {{{round($sum_alcorriente,0)}}},@endif @endforeach
     ]


    }]
});
//termina grafica cartera acumulada /////////////////////////////////////////////////////////////////////
//empieza grafica distribucion de captura de mantenimientos
        

Highcharts.chart('Distribucion_mantenimiento', {
 chart: {
        type: 'bar'
    },
    title: {
     text: 'Distribución de capturas de mantenimiento {{{$mes}}} {{{$serie['name']}}}'
    },
     xAxis: {
            categories: [
            @foreach($asesores as $asesor)
                    '{{{$asesor->asesor}}}', 
            @endforeach
        ],
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [
        @foreach($tipos as $tipo)
        {
        name:'{{{$tipo->nombre}}}',
        data:[@foreach($serie_distribucion as $sdist) @if($sdist->tipo == $tipo->nombre){{{$sdist->monto}}},@endif 
                 @endforeach 
                 ]

        },
  @endforeach]
});
//termina distribuccion de captura de mantenimientos

//EMPIEZAN GRAFICAS DE GASTOS 
//grafrica sueldo nomina

Highcharts.chart('Sueldos_nomina', {
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
                labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
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
            @foreach($categories_sueldos as $cat_s)
            {name:'{{{$cat_s->nombre}}}', 
            data:[@foreach($gastos as $g) @if($g->id == $cat_s->id and $g->sueldo_impuesto = 1 and $g->year == $fechas['year']){{{$g->total}}},@endif @endforeach 
                 ]
            },
            @endforeach
            ]

});
//termina grafica sueldo nomina


//empieza grafica gastos administracion
Highcharts.chart('Gastos_admon', {
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
                labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
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
            @foreach($categories_gadmon as $cat_a)
            {name:'{{{$cat_a->nombre}}}', 
            data:[@foreach($gastos as $g) @if($g->id == $cat_a->id and $g->gasto_admon = 1 and $g->year == $fechas['year']){{{$g->total}}},@endif  @endforeach 
                 ]
            },
            @endforeach
            ]

});
//termina gastos administracion
//empieza grafica gastos aperacion
Highcharts.chart('Gastos_operacion', {
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
                labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
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
            @foreach($categories_goperacion as $cat)
            {name:'{{{$cat->nombre}}}', 
            data:[@foreach($gastos as $g) @if($g->id == $cat->id and $g->gasto_operacion = 1 and $g->year == $fechas['year']){{{$g->total}}},@endif @endforeach 
                 ]
            },
            @endforeach
            ]

});

//termina grafica gastos aperacion
//empieza grafica gastos mtto capilla
Highcharts.chart('Gastos_mtto_capilla', {
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
                labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
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
            @foreach($categories_mtto_cap as $cat_c)
            {name:'{{{$cat_c->nombre}}}', 
            data:[@foreach($gastos as $g) @if($g->id == $cat_c->id and $g->gasto_mtto_capilla = 1 and $g->year == $fechas['year']){{{$g->total}}},@endif @endforeach 
                 ]
            },
            @endforeach
            ]


});

//termina grafica gastos mtto capilla
//empieza grafica gastos contruccion capilla
Highcharts.chart('Gastos_const_capilla', {
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
                labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
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
            @foreach($categories_const_cap as $cat_c)
            {name:'{{{$cat_c->nombre}}}', 
            data:[@foreach($gastos as $g) @if($g->id == $cat_c->id and $g->gasto_constr_capilla = 1 and $g->year == $fechas['year']){{{$g->total}}},@endif @endforeach 
                 ]
            },
            @endforeach
            ]


});

//termina grafica gastos construccion capilla


//empieza grafica gasto corporativo
Highcharts.chart('Cargo_corporativo', {
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
        categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
  
    },
    yAxis: {
        
        title: {
            text: ''
        },
                labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
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
   

        @foreach($categories_corp as $corp)
        {
        name:'{{{$corp->nombre}}}',
        data:[@foreach($gastos as $g) @if($g->id == $corp->id and $g->cargo_corporativo = 1  and $g->year == $fechas['year']){{{$g->total}}},@endif  @endforeach ]
        },
  @endforeach


    ]
});

//termina grafica cprporativo

</script>
<script >
//empieza grafica gastos totales
Highcharts.chart('Gasto_total', {
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
                labels: {
        formatter: function() {
            return '$'+ Highcharts.numberFormat(this.value, 0, ',')  ;

        },
    },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            },
            formatter: function() {   
                        return 'Total: $'+  Highcharts.numberFormat(this.total, 0, ',')  ;                                
                    }
        }
    },
    legend: {
        itemDistance: 2,
        align: 'right',
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
            
            {  
                 name:'Sueldo e impuestos de nomina',   
            data:[@foreach($totales['sueldo_impuesto'] as $g){{{$g->total}}}, @endforeach]
            },

            {  
                 name:'Gastos administracion',   
            data:[@foreach($totales['gasto_admon'] as $g){{{$g->total}}}, @endforeach]
            },
            {  
                 name:'Gastos de operacion',   
            data:[@foreach($totales['gasto_operacion'] as $g){{{$g->total}}}, @endforeach]
            },
            {  
                 name:'Gastos de mantenimiento capilla',   
            data:[@foreach($totales['gasto_mtto_capilla'] as $g){{{$g->total}}}, @endforeach]
            },
            {  
                 name:'Gastos de contruccion capilla',   
            data:[@foreach($totales['gasto_constr_capilla'] as $g){{{$g->total}}}, @endforeach]
            },
            {  
                 name:'Cargos del corporativo',   
            data:[@foreach($totales['gasto_corp'] as $g){{{$g->total}}}, @endforeach]
            },


            ]


});

//termina grafica gastos totales
</script>

@stop()

@section('module')

     <!-- Empieza Vendedores  -->
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
            
<div class="col-md-6">
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
            
            <th class="text-right" class="col-md-3">{{{$cat->nombre}}}</th>
           @foreach($acumulado_apilada as $ac) 
                 
                
                @if($ac->id == $cat->id)<td class="text-left">${{{number_format($ac->total, 0, '.', ',')}}} </td>@endif 
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
  <!-- Empieza ventas totales mes febrero  -->
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Venta total {{{$mes}}} de {{{$serie3['name']}}}, {{{$serie2['name']}}}, {{{$serie1['name']}}} y {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="VentasTotal"></div>

                 <!-- Content goes here -->
                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>
            </div>  
              <!-- Empieza Vendedores  -->
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Vendedores {{{$mes}}} {{{$year}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                
            <div id="vendedores" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

                 <!-- Content goes here -->
                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>
            </div>  
              <!-- Empieza Promotorias  -->
                     <div class="widget">
    <div class="widget-head">
        <div class="pull-left">Promotorias {{{$year}}}</div>
        <div class="pull-right">
       <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>  
       </div>  
        <div class="clearfix"></div>
    </div>
    
    <div class="widget-content">
        <div class="padd">
      

        <div id="promotorias" style="min-width: 310px; height: 480px; margin: 0 auto"></div>

  <table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
           
        </tr>
    </thead>
    <tbody>


@foreach($promotor as $pro)
        <tr>
            
            <th class="text-right" class="col-md-3">{{{$pro->promotor}}}</th>
           @foreach($serie_promotoria as $sep) 
                 
                
                @if($sep->promotor == $pro->promotor)<td class="text-left">${{{number_format($sep->total, 0, '.', ',')}}} </td>@endif 
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
    <!-- Empieza extras -->
<div class="widget">
              <div class="widget-head">
                <div class="pull-left">Extras {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Extras" ></div>

                 <!-- Content goes here -->
                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>
            </div>  
     <!-- grafica cartera clientes Modificado  -->
<div class="widget">
              <div class="widget-head">
                <div class="pull-left">Cartera cliente {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Cartera" ></div>

                 <!-- Content goes here -->
                  <table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
           
        </tr>
    </thead>
    <tbody>
          <th class="text-center" class="col-md-3"></th>
          <th class="text-center" class="col-md-3">{{{$fechas['mes3']}}}</th>
          <th class="text-center" class="col-md-3">{{{$fechas['mes2']}}}</th>
          <th class="text-center" class="col-md-3">{{{$fechas['mes']}}}</th>
 <!-- Content goes here -->
@foreach($categories_cartera as $cat)
        <tr>
            
            <th class="text-center" class="col-md-3">{{{$cat->nombre}}}</th>
             @foreach($serie_cartera as $scats)

               @if($cat->nombre == $scats->nombre and $scats->month == $fechas['month3'])<td class="text-center">${{{number_format($scats->monto, 0, '.', ',')}}} </td>@endif 
                @if($cat->nombre == $scats->nombre and $scats->month == $fechas['month2'])<td class="text-center">${{{number_format($scats->monto, 0, '.', ',')}}} </td>@endif 
                @if($cat->nombre == $scats->nombre and $scats->month == $fechas['month'])<td class="text-center">${{{number_format($scats->monto, 0, '.', ',')}}} </td>@endif 
            @endforeach

        </tr>@endforeach
       
        
       
    </tbody>
    <tfoot>
         
</table>
                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>

            </div>  
             <!--cierre de MODIFICADO -->
 <!-- Empieza cartera pastel -->
<div class="widget">
              <div class="widget-head">
                <div class="pull-left">Cartera clientes {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Cartera_pastel" ></div>

                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>

            </div>  
<!-- Empieza cartera acumulados -->
<div class="widget">
              <div class="widget-head">
                <div class="pull-left">Cartera clientes {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Cartera_acumulado" ></div>

     
                 <!-- Content goes here -->
                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>

            </div>
<!-- Empieza distribucion de mantenimientos-->
<div class="widget">
              <div class="widget-head">
                <div class="pull-left">Distribución de captura de mantenimientos {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Distribucion_mantenimiento" ></div>


<table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
           
        </tr>
    </thead>
    <tbody>

            
 <th class="text-left" class="col-md-3"></th>
 <th class="text-left" class="col-md-3">Nuevo</th>
 <th class="text-left" class="col-md-3">Renovado</th>
 <th class="text-left" class="col-md-3">Cobranza</th>
@foreach($asesores as $asesor)
        <tr>
            
            <th class="text-center" class="col-md-3">{{{$asesor->asesor}}}</th>

           @foreach($serie_distribucion as $sdist)

                @if($asesor->asesor == $sdist->asesor)<td class="text-left">{{{$sdist->monto}}} </td>@endif 
            @endforeach

        </tr>@endforeach
       
        
       
    </tbody>
    <tfoot>
         
</table>
                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>

            </div>

            <!-- Empieza graficas Gastos nomina -->
<div class="widget">
              <div class="widget-head">
                <div class="pull-left">Sueldo e impuestos de nomina {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Sueldos_nomina" ></div>
   <!-- Content goes here -->
                  <table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
           
        </tr>
    </thead>
    <tbody>

 <!-- Content goes here -->
@foreach($categories_sueldos as $cat)
        <tr>
            
            <th class="text-left" class="col-md-3">{{{$cat->nombre}}}</th>
             @foreach($gastos as $g)

               @if($cat->id == $g->id and $g->year == $fechas['year'])<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endif 

            @endforeach

        </tr>@endforeach
       
        
       
    </tbody>
    <tfoot>
         
</table>

                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>

            </div>
             <!-- termina gastos nomina-->
<!-- Gastos administración -->
            <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Gastos de administración {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Gastos_admon" ></div>
                <br>               

     
      
                <div id="Gastos_admon_gastos" ></div>

 <!-- Content goes here -->
                  <table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
           
        </tr>
    </thead>
    <tbody>

 <!-- Content goes here -->
@foreach($categories_gadmon as $cat)
        <tr>
            
            <th class="text-left" class="col-md-3">{{{$cat->nombre}}}</th>
             @foreach($gastos as $g)

               @if($cat->id == $g->id and $g->year == $fechas['year'])<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endif 

            @endforeach

        </tr>@endforeach
       
        
       
    </tbody>
    <tfoot>
         
</table>
                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>
            </div>


     <!-- termina gastos administracion -->
     <!-- empieza grafica gasto de operacion -->
       <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Gastos de operación {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Gastos_operacion" ></div>
                               <table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
           
        </tr>
    </thead>
    <tbody>

 <!-- Content goes here -->
@foreach($categories_goperacion as $cat)
        <tr>
            
            <th class="text-left" class="col-md-3">{{{$cat->nombre}}}</th>
             @foreach($gastos as $g)

               @if($cat->id == $g->id and $g->year == $fechas['year'])<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endif 

            @endforeach

        </tr>@endforeach
       
        
         
</table>


                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>
            </div>
             <!-- termina grafica gasto de operacion -->
                 <!-- Empieza graficas Gastos mtto capilla -->
<div class="widget">
              <div class="widget-head">
                <div class="pull-left">Gastos mantenimiento de capilla {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Gastos_mtto_capilla" ></div>


                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                   <!-- Content goes here -->
                  <table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
           
        </tr>
    </thead>
    <tbody>

 <!-- Content goes here -->
@foreach($categories_mtto_cap as $cat)
        <tr>
            
            <th class="text-left" class="col-md-3">{{{$cat->nombre}}}</th>
             @foreach($gastos as $g)

               @if($cat->id == $g->id and $g->year == $fechas['year'])<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endif 

            @endforeach

        </tr>@endforeach
       
        
       
    </tbody>
    <tfoot>
         
</table>
                </div>
              </div>

            </div>
             <!-- termina gastos mtto capilla-->
               <!-- Empieza graficas Gastos construccion capilla -->
<div class="widget">
              <div class="widget-head">
                <div class="pull-left">Gastos contrucción de capilla {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Gastos_const_capilla" ></div>


                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                   <!-- Content goes here -->
                  <table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
           
        </tr>
    </thead>
    <tbody>

 <!-- Content goes here -->
@foreach($categories_const_cap as $cat)
        <tr>
            
            <th class="text-left" class="col-md-3">{{{$cat->nombre}}}</th>
             @foreach($gastos as $g)

               @if($cat->id == $g->id and $g->year == $fechas['year'])<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endif 

            @endforeach

        </tr>@endforeach
       
        
       
    </tbody>
    <tfoot>
         
</table>
                </div>
              </div>

            </div>
             <!-- termina gastos construccion capilla-->
 
       
    </tbody>
    <tfoot>
              <!-- empieza grafica gasto corporativo -->
       <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Cargos corporativo {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Cargo_corporativo" ></div>
                  <table class="table table-condensed">
    <thead>
        <tr> 
            <th></th>
           
        </tr>
    </thead>
    <tbody>

 <!-- Content goes here -->
@foreach($categories_corp as $cat)
        <tr>
            
            <th class="text-left" class="col-md-3">{{{$cat->nombre}}}</th>
             @foreach($gastos as $g)

               @if($cat->id == $g->id and $g->year == $fechas['year'])<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endif 

            @endforeach

        </tr>@endforeach
       
        
       
    </tbody>
    <tfoot>
         
</table>

                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>
            </div>
             <!-- termina grafica gasto corporativo -->
            <!-- empieza grafica gasto totales -->
       <div class="widget">
              <div class="widget-head">
                <div class="pull-left">Gastos totales {{{$mes}}} {{{$serie['name']}}}</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>  
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">
                 
      
                <div id="Gasto_total" ></div>

                  <table class="table table-condensed">
    <thead>
        <tr> 
          
           <th></th>
        </tr>
    </thead>
    <tbody>

 <!-- Content goes here -->

        <tr>
              <th class="text-left" class="col-md-3">Sueldo e impuestos de nomina</th>
             @foreach($totales['sueldo_impuesto'] as $g)<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endforeach
             
        </tr>     
        <tr>
              <th class="text-left" class="col-md-3">Gastos de administración</th>
             @foreach($totales['gasto_admon'] as $g)<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endforeach
             
        </tr>
         <tr>
              <th class="text-left" class="col-md-3">Gastos de operación</th>
             @foreach($totales['gasto_operacion'] as $g)<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endforeach
             
        </tr>
         <tr>
              <th class="text-left" class="col-md-3">Gastos de mantenimiento capilla</th>
             @foreach($totales['gasto_mtto_capilla'] as $g)<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endforeach
             
        </tr>
         <tr>
              <th class="text-left" class="col-md-3">Gastos de construcción capilla</th>
             @foreach($totales['gasto_constr_capilla'] as $g)<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endforeach
             
        </tr>    
        <tr>
              <th class="text-left" class="col-md-3">Otros cargos corporativo</th>
             @foreach($totales['gasto_corp'] as $g)<td class="text-center">${{{number_format($g->total, 0, '.', ',')}}} </td>@endforeach
             
        </tr> 
    </tbody>
    <tfoot>
         
</table>
                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>
            </div>
             <!-- termina grafica gastos totales -->
@stop