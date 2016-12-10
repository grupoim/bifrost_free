<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Pagos de comisiones</title>
<style>
* { 
  margin: 0; 
  padding: 0; 
}
body { 
  font: 13px/1.4 Georgia, Serif; 
}
#page-wrap {
  margin: 50px;
}
p {
  margin: 20px 0; 
}

  /* 
  Generic Styling, for Desktops/Laptops 
  */
  table { 
    width: 100%; 
    border-collapse: collapse;     
  }
  /* Zebra striping */
  tr:nth-of-type(odd) { 
    
  }
  th { 
    background: #333; 
    color: white; 
    font-weight: bold; 
  }
  td, th { 
    padding: 6px; 
     
    text-align: left; 
  }
  .total{
    color: #610f22;
  }

  .promotoria{
    text-align: right;
  }

  hr {
  background-color: black;
}
</style>
	  
</head>
<body>

<div class="col-md-12" id="page-wrap">
              
                <div class="box-header with-border">
                  <h3 class="box-title">Detalles de comisiones </h3><br>
                  <h4>Cuando el flujo de efectivo sea aprobado en Dirección General, se le notificará para que acuda a la oficina y le sea entregado su pago, gracias por su comprensión</h4>
                </div><!-- /.box-header -->
                
                  

          @foreach($promotorias as $promotor)
          <div><h3>Promoria {{{$promotor->promotor}}} </h3></div>         
          <table>
            <thead>
              <tr>
                {{--<th class="text-center">ID</th>--}}             
                <th class="text-center col-md-3"> Cliente</th>
                <th align="center">Folio</th>
                <th> Venta</th>                
                <th class="text-center col-md-2"> Monto</th>
                <th align="left"> %</th>
                <th class="text-center col-md-3"> Vendedor</th>                
                <th align="center"> Estatus</th>               

              </tr>
            </thead>
            <tbody>
              @foreach($abonos as $abono)
              @if($abono->promotor == $promotor->promotor)
              <tr>
                <td> {{{$abono->cliente}}}</td>
                {{--<td class="text-center">{{{$abono->id}}}</td>--}}
                <td align="left"><strong>{{{ $abono->folio_solicitud }}}- <strong class= "total">{{{$abono->nombre_corto}}}</strong></strong></td>
                <td align="rigth" >$ {{{number_format($abono->venta_total, 0, ".", ",")}}}</td>
                 <td align="left">$ {{{number_format($abono->monto_abono, 2, ".", ",")}}}</td>                 
                <td align="left">{{{$abono->porcentaje}}}</td>
                {{--<td><strong>{{{ $abono->folio }}}</strong></td>--}}                
                <td>{{{$abono->abono_asesor}}} @if($abono->vendedor <> $abono->abono_asesor) <span class="label label-warning" ><i  class="fa fa-exclamation-triangle" aria-hidden="true"></i> No pertenece al vendedor</span> @endif </td>
               
                <td align="right">
                  
                {{{round(($abono->pagado * $abono->numero_pagos)/$abono->total_comisionable)}}} de {{{$abono->numero_pagos}}}
               @if ($abono->fecha_venta > $periodo->fecha_inicio)
                  <strong>*</strong>
                 @endif
                 {{{$abono->fecha_venta}}}
                </td>              
              </tr>       
              @endif
              @endforeach
                
            </tbody>
          </table> 
        

          <div class="promotoria"><h3>Total <strong  class= "total">$ {{{number_format($promotor->total_promotoria, 2, ".", ",")}}}</strong></h3></div>
          <hr>
          <br>
          @endforeach


              
                <div class="box-footer clearfix">
                  
                </div>
            

              
            </div>
	
</body>
</html>


