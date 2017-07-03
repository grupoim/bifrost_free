<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Orden de compra</title>
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

/* Curso CSS estilos aprenderaprogramar.com*/
body {font-family: Arial, Helvetica, sans-serif;}

table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 13px;    margin: 45px;     width: 100%; text-align: left;    border-collapse: collapse; }

th {     font-size: 12px;     font-weight: normal;     padding: 8px;     background: #ddd;
    border-top: 1px solid #ddd;    border-bottom: 1px solid #fff; color: #111; }

td {    padding: 8px;     background: #fff;     border-bottom: 1px solid #ddd;
    color: #222;    border-top: 1px solid transparent; }


</style>
    

</head>
<body>

<div class="col-md-12" id="page-wrap">
              
               <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/virgen.png'))) }}" class="img-responsive" alt="Image">
                
                <div align="center">
                  <div align="right" ><h3>Folio de orden <u class="total"><strong>{{{$producto_proveedores->orden_folio}}}</strong></h3></u></div>
                  <h1  class="box-title ">Orden de compra </h1><br>
       <hr>
                  <br>
                 
                  
                </div> <div >
                <h4>Responsable de pedido : <u class="total">{{{$usuario->pnombre}}} {{{$usuario->p_paterno}}} {{{$usuario->p_materno}}}</u></h4><br>
                <h4>Fecha de pedido : <u class="total">{{{ date('d/m/Y', strtotime($producto_proveedores->fecha))}}}</u></h4><br>
                <h4>Proveedor : <u class="total">{{{$producto_proveedores->proveedor}}}</u></h4>                 
                  </div><br><!-- /.box-header -->
<div align="center"><h3>***Pedido***</h3></div>
  <br>
      <div>
<table>
<thead>
  <tr>
  <th><h3>Producto</h3></th>
  <th><h3>Cantidad a encargar</h3></th>
  <th><h3>Codigo de barras</h3></th>
</tr>
</thead>
<tbody>

@foreach($productos as $producto) 
<tr>
  <td align="center">{{{$producto->producto}}}</td>
  <td align="center">{{{$producto->cantidad_orden}}}</td>
  <td align="center"><img width="120" src="{{{$producto->src}}}" alt=""></td>
  @endforeach
 </tr> 
</tbody>
</table>
</div>       
<br>        
                <div class="box-footer clearfix">
                </div>
            

              
        <div>
        Se entrega copia de comprobante de orden de compra para su verificación y aprobación, los productos seran recibidos por la persona responsable, la orden de compra será firmada
        de que todo este completo. 
        <br>
       
        </div><!-- /.box-header --> 
          <br>
          <br>
          <br>
          <br>
          <br>

        
        <div align="center">
        <hr  align="center" width="30%">
        <strong> Aprobación finanzas </strong>
        <br><br>
        <br>
                </div>
         <div align="right">
        <hr  align="right" width="25%">
        <strong> Responsable de pedido</strong>
        </div>
        <div align="left">
         <hr align="left" width="25%">
         <strong>  Revisión Sistemas</strong>        
        </div>

</body>
</html>

