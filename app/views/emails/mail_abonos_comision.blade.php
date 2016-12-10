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
  font: 14px/1.4 Georgia, Serif; 
  
  background-position: top, left;
 
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
                  <h2  class="box-title text-center">Detalles de comisiones Parque Funeral Guadalupe </h2><br>
                  <h3 class="text-center">Comisiones del {{{ date('d/m/Y', strtotime($periodo->fecha_inicio)) }}} al {{{ date('d/m/Y', strtotime($periodo->fecha_fin)) }}} <div align="right" class="total">Folio <u><strong>  {{{$periodo->folio}}}  </strong></h3></u></div>
                  <h4>Cuando el flujo de efectivo sea aprobado en Dirección General, se le notificará para que acuda a la oficina y le sea entregado su pago, gracias por su comprensión.</h4>
                </div><!-- /.box-header -->
                
                
                  

        
          <div><h3>Promoria {{{$promotor}}} </h3></div>
          <h2 align="right" >Total por pagar: <strong class="total">$ {{{number_format($total, 2, ".", ",")}}}</strong></h2>         
          <table>
            <thead>
              <tr>
                           
               <th class="text-center">Folio</th>
                <th class="text-center col-md-3"> Cliente</th>
                <th class="text-center col-md-3"> Vendedor</th>
                <th class="text-center col-md-2">Monto</th>
                <th class="text-center col-md-3">estatus</th>

               

              </tr>
            </thead>
            <tbody>
              @foreach($abonos as $abono)
              
              <tr>
               
               <td class="text-center">{{{$abono->folio_solicitud}}}-{{{$abono->nombre_corto}}}</td>
                <td> {{{$abono->cliente}}}</td>
                <td>{{{$abono->abono_asesor}}}</td>
                <td class="text-right">$ {{{number_format($abono->monto_abono, 2, ".", ",")}}}</td>                
                <td>
                {{{round(($abono->pagado * $abono->numero_pagos)/$abono->total_comisionable)}}} de {{{$abono->numero_pagos}}}
                </td>
              </tr>       

              
              @endforeach
                
            </tbody>
          </table>
        

                <div class="box-footer clearfix">
                  
                </div>
            

              
            </div>
  

	
</body>
</html>


