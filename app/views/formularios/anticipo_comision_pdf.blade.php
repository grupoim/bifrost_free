<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Anticipo Comision</title>
<style>
* { 
  margin: 0; 
  padding: 0; 
}
body { 
  font: 16px/1.4 Georgia, Serif; 
  
  background-position: top, left;
  
  background-repeat: no-repeat;
  background-size: 25px 50px;
  /*background-image: url(data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/virgen.png'))) }});*/
  
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
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 3px solid #8C8C8C; -webkit-border-radius: 15px; -moz-border-radius: 15px; border-radius: 15px; }.datagrid table td, .datagrid table th { padding: 6px 8px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8C8C8C), color-stop(1, #000000) );background:-moz-linear-gradient( center top, #8C8C8C 5%, #000000 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8C8C8C', endColorstr='#000000');background-color:#8C8C8C; color:#FFFFFF; font-size: 14px; font-weight: bold; border-left: 1px solid #A8A8A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #000000; border-left: 1px solid #DBDBDB;font-size: 14px;font-weight: normal; }.datagrid table tbody .alt td { background: #EBEBEB; color: #000000; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }


</style>
	  
</head>
<body>

<div class="col-md-12" id="page-wrap">
              
               <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/virgen.png'))) }}" class="img-responsive" alt="Image">
                
                <div align="center">
                  <div align="right" class="total">Folio <u><strong>{{{$detalle_anticipo->folio}}}    </strong></h3></u></div>
                  <h1  class="box-title ">Anticipo de comisión </h1><br>
                 <hr> 
                   
                  <br>
                 
                  
                </div> <div >
                  Por medio de la presente solicito al departamento de Administración que se realice el siguiente pago de comisión al asesor(ra) de ventas
                  <strong><u>{{{$detalle_anticipo->vendedor}}}</strong> perteneciente a la promotoría <u><strong>{{{$detalle_anticipo->promotor}}}</strong></u> por el concepto de <strong>{{{$detalle_anticipo->motivos}}} </strong>
                  de la venta realizada el <u><strong>{{{ date('d/m/Y', strtotime($detalle_anticipo->fecha)) }}} </strong></u>
                  <br>
                 
                  </div><!-- /.box-header -->
                
          <div class="promotoria"></div>
          
         <br> 
      <h3 align="center">***Detalles***</h3>
         
  <br>
      <div class="datagrid"><table>
<thead></thead>
<tbody>
<tr><td><h3>Folio de venta </h3></td><td><h3>{{{$detalle_anticipo->folio_solicitud}}}</h3></td></tr>
<tr class="alt"> <td><h3> Cliente <h3></td><td><h3>{{{$detalle_anticipo->cliente}}}</h3></td></tr>
<tr><td><h3>Producto </h3></td><td><h3>{{{$detalle_anticipo->producto}}}</h3></td></tr>
<tr class="alt"> <td><h3> Precio de venta <h3></td><td><h3>$ {{{number_format($detalle_anticipo->total, 2, ".", ",")}}}</h3></td></tr>
<tr ><td><h3>Monto total Comisionado </h3></td><td><h3>$ {{{number_format($detalle_anticipo->total_comisionable, 2, ".", ",")}}}</h3></td></tr>
<tr class="alt"><td><h3>Monto entregado </h3></td><td><h3>$ {{{number_format($detalle_anticipo->monto, 2, ".", ",")}}}</h3></td></tr>
<tr ><td><h3>Pendiente por pagar </h3></td><td><h3>$ {{{number_format($detalle_anticipo->total_comisionable - $pagado, 2, ".", ",")}}}</h3></td></tr>
<tr class="alt" > <td><h3> Porcentaje de comision <h3></td><td><h3>{{{$detalle_anticipo->porcentaje}}}%</h3></td></tr>

</tbody>
</table></div>
        
<br>

              
                <div class="box-footer clearfix">
                  
                </div>
            

              
            <div >
        Se entrega copia de comprobante de pago y folio de venta para su verificación y aprobación, el pago será recibido y firmado
        de conformidad por el Promotor en caso de que el asesor <strong>{{{$detalle_anticipo->vendedor}}}</strong> pertenezca a dicha promotoria,
        en caso de ser vendedor <strong> Independiente</strong>, podrá ser firmado por dicho asesor
        <br>
       
        </div><!-- /.box-header --> 

       <h2 align="right" >Total a pagar: <strong class="total">$ {{{number_format($detalle_anticipo->monto, 2, ".", ",")}}}</strong></h2>
        <br>
<br><br>
        
        <div align="center">
        <hr  align="center" width="40%">
        <strong> Aprobación Dirección General </strong>
        <br><br><br><br>
         <hr  align="center" width="40%">
         <strong>Revisión Sistemas</strong>
        <br><br><br><br>
        <hr  align="center" width="40%">
        <strong> Conformidad Asesor/Promotor</strong>

  </div>
        </div>
 
          

           
	
</body>
</html>


