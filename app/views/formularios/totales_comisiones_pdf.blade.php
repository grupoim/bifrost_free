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
  font: 13px/1.4 ; 
  
  background-position: top, left;
  
  background-repeat: no-repeat;
  background-size: 25px 50px;
  background-image: url(data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/virgen.png'))) }});
  
}
#page-wrap {
  margin: 25px;

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
span {
  page-break-after: always;
  border: 0;
  margin: 0;
  padding: 0;
}


</style>
	  
</head>
<body>

<div class="col-md-12" id="page-wrap">
              
               
                
                <div align="center">
                  <h2  class="box-title text-center">Totales por vendedor </h2><br>
                  <h3 class="text-center">Comisiones del {{{ date('d/m/Y', strtotime($periodo->fecha_inicio)) }}} al {{{ date('d/m/Y', strtotime($periodo->fecha_fin)) }}} <div align="right" class="total">Folio <u><strong>  {{{$periodo->folio}}}  </strong></h3></u></div>
                  
                </div><!-- /.box-header -->
                
                  

          @foreach($promotorias as $promotor)
          
          <div><h3>Promoria {{{$promotor->promotor}}} </h3></div>          
          <table >
            <thead>
              <tr>
                            
                <th> Asesor</th>
                <th align="left">Subtotal</th>
                <th align="left">Anticipos</th>
                <th align="left">Total</th>
                <th>Firma</th>                              

              </tr>
            </thead>
            <tbody HEIGHT ="500">
              @foreach($totales_vendedores as $abono)
              
              @if($abono->promotor == $promotor->promotor)
              <tr> 
                <td width=200 height="20" > {{{$abono->asesor}}}</td>              
               
                <td width=100  height="20" align="left" >$ {{{number_format($abono->subtotal, 2, ".", ",")}}} </td>
               
             <td width=100  height="20" align="left" class="total"> 

             @forelse($anticipos_vendedor as $anticipo)
              @if($anticipo->asesor_id == $abono->abono_asesor_id)
              
                -$ {{{number_format($anticipo->total_anticipo, 2, ".", ",")}}}
                
              @else
              
               @endif
               @empty
              
               @endforelse
              </td>

              <td width=100  height="20" align="left">
              
              <strong>$ {{{number_format($abono->total, 2, ".", ",")}}}</strong>
                
             
              </td>
            
                <td width=200 height="20" ><hr></td>               
              </tr>      
              @endif
              
              @endforeach
                
            </tbody>
          </table> 
        

          <div class="promotoria"><h3>Promotoria <strong  class= "total">
          
        $ {{{number_format($promotor->total, 2, ".", ",")}}}         
         </strong></h3></div>
          <hr>
          
          
          @endforeach

<h2 align="right" >Total por pagar: <strong class="total">$ {{{number_format($total_s_anticipos, 2, ".", ",")}}}</strong></h2>
              
                <div class="box-footer clearfix">
                  
                </div>
            

              
            </div>
            <span></span>
            <div class="col-md-12" id="page-wrap">
              
                  <div align="center">
                  <h2  class="box-title text-center">Detalles de comisiones </h2><br>
                  <h3 class="text-center">Comisiones del {{{ date('d/m/Y', strtotime($periodo->fecha_inicio)) }}} al {{{ date('d/m/Y', strtotime($periodo->fecha_fin)) }}} <div align="right" class="total">Folio <u><strong>  {{{$periodo->folio}}}  </strong></h3></u></div>
                </div><!-- /.box-header -->
                
                
                  

          @foreach($promotoria_total as $promotor)
          <div><h3>Promoria {{{$promotor->promotor}}} </h3></div>         
          <table class="tabla-11">
            <thead>
              <tr>
                {{--<th class="text-center">ID</th>--}}             
                <th class="text-center col-md-3"> Cliente</th>
                <th align="center">Folio</th>
               {{-- <th>Producto</th>--}}
                <th> Venta</th>                
                <th class="text-center col-md-2"> Monto</th>
                <th align="left"> %</th>
                <th class="text-center col-md-3"> Vendedor</th>                
                <th align="left"> Estatus</th>               

              </tr>
            </thead>
            <tbody>
              @foreach($abonos as $abono)
              @if($abono->promotor == $promotor->promotor)
              <tr>
                <td> {{{$abono->cliente}}}</td>
                {{--<td class="text-center">{{{$abono->id}}}</td>--}}
                <td align="left"><strong>{{{ $abono->folio_solicitud }}}- <strong class= "total">{{{$abono->nombre_corto}}}</strong></strong></td>
                {{--<td>{{{$abono->producto}}}</td>--}}
                <td align="rigth" >$ {{{number_format($abono->venta_total, 0, ".", ",")}}}</td>
                <td align="left">$ {{{number_format($abono->monto_abono, 2, ".", ",")}}}</td>                 
                <td align="left">{{{$abono->porcentaje}}}</td>
                {{--<td><strong>{{{ $abono->folio }}}</strong></td>--}}                
                <td>{{{$abono->abono_asesor}}} @if($abono->vendedor <> $abono->abono_asesor) <span class="label label-warning" ><i  class="fa fa-exclamation-triangle" aria-hidden="true"></i> No pertenece al vendedor</span> @endif </td>
               
                <td align="left">

                {{{round(($abono->pagado * $abono->numero_pagos)/$abono->total_comisionable)}}} de {{{$abono->numero_pagos}}}
                @if ($abono->fecha_venta >= $periodo->fecha_inicio)
                  <strong>*</strong>
                 @endif                 
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
           <h2 align="right" >Total: <strong class="total">$ {{{number_format($total, 2, ".", ",")}}}</strong></h2>

              
                <div class="box-footer clearfix">
                  
                </div>
            

              
            </div>
  

	
</body>
</html>


